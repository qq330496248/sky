<?php
/**
 * @desc 进度条类
 * @author Weixun Luo
 * @date 2015-02-16
 */
class CProgress {
	private static $progressTTL = 15;	// 进度条达到100%后的生存时间，15秒
	private static $keyPrefix = 'ck1_api_import_task_progress_';	// 缓存key前缀

	/**
	 * @desc 开始某个进度条
	 * @param string $pKey 进度信息的唯一标识
	 * @param int $total 任务总长度
	 * @return bool 操作执行是否成功
	 * @author Weixun Luo
	 * @date 2015-02-16
	 */
	public static function go($pKey, $total){
		if(empty($pKey)){
			return false;
		}
		$hashName = CProgress::$keyPrefix.$pKey;
		$redis = CRedisHelper::getInstance();
		if($redis->exists($hashName)){
			// 去除旧的进度缓存的过期时间，防止对新数据的造成影响
			$redis->persist($hashName);
		}
		return $redis->hmSet($hashName, array('total' => intval($total), 'seed' => 0, 'usable' => true));
	}

	/**
	 * @desc 根据key获取进度条信息
	 * @param string $pKey 进度信息的唯一标识
	 * @return array 进度数据数组
	 * @author Weixun Luo
	 * @date 2015-02-16
	 */
	public static function get($pKey){
		$hashName = CProgress::$keyPrefix.$pKey;
		$redis = CRedisHelper::getInstance();
		$progressInfo = $redis->hGet($hashName);
		return $progressInfo ?: array('total' => 0, 'seed' => 0, 'usable' => false);
	}

	/**
	 * @desc 增加完成度
	 * @param string $pKey 进度信息的唯一标识
	 * @param int $seed 新增的任务长度
	 * @return bool 操作执行是否成功
	 * @author Weixun Luo
	 * @date 2015-02-16
	 */
	public static function up($pKey, $seed){
		$hashName = CProgress::$keyPrefix.$pKey;
		$redis = CRedisHelper::getInstance();
		$progressInfo = $redis->hGet($hashName);
		if($progressInfo){
			$nowSeed = $progressInfo['seed'] + intval($seed);
			if($nowSeed >= $progressInfo['total']){
				// 进度结束，设置缓存时间15秒后删除缓存信息
				$redis->setTimeout($hashName, CProgress::$progressTTL);
			}
			return $redis->hSet($hashName, 'seed', $nowSeed);
		}
		return false;
	}

	/**
	 * @desc 回滚进度
	 * @param string $pKey 进度信息的唯一标识
	 * @param int $seed 回滚任务长度
	 * @return bool 操作执行是否成功
	 * @author Weixun Luo
	 * @date 2015-02-16
	 */
	public static function rollback($pKey, $seed){
		$hashName = CProgress::$keyPrefix.$pKey;
		$redis = CRedisHelper::getInstance();
		$progressInfo = $redis->hGet($hashName);
		if($progressInfo){
			return $redis->hSet($hashName, 'seed', ($progressInfo['seed'] - intval($seed)) ?: 0);
		}
		return false;
	}

	/**
	 * @desc 更新当前进度
	 * @param string $pKey 进度信息的唯一标识
	 * @param int $curr 任务当前完成长度
	 * @return bool 操作执行是否成功
	 * @author Weixun Luo
	 * @date 2015-02-16
	 */
	public static function update($pKey, $curr){
		$hashName = CProgress::$keyPrefix.$pKey;
		$redis = CRedisHelper::getInstance();
		$progressInfo = $redis->hGet($hashName);
		if($progressInfo){
			// 设置进程数据缓存时间15秒后丢弃
			$curr = intval($curr);
			if($curr >= $progressInfo['total']){
				$redis->setTimeout($hashName, CProgress::$progressTTL);
			}
			return $redis->hSet($hashName, 'seed', $curr);
		}
		return false;
	}

	/**
	 * @desc 进度重置归零
	 * @param string $pKey 进度信息的唯一标识
	 * @return bool 操作执行是否成功
	 * @author Weixun Luo
	 * @date 2015-02-16
	 */
	public static function zero($pKey){
		$hashName = CProgress::$keyPrefix.$pKey;
		$redis = CRedisHelper::getInstance();
		if($redis->exists($hashName)){
			$redis->hSet($hashName, 'seed', 0);
		}
		return false;
	}

	/**
	 * @desc 删除进度缓存
	 * @param string $pKey 进度信息的唯一标识
	 * @return bool 操作执行是否成功
	 * @author Weixun Luo
	 * @date 2015-03-04
	 */
	public static function clear($pKey){
		$hashName = CProgress::$keyPrefix.$pKey;
		return CRedisHelper::getInstance()->del($hashName);
	}
}