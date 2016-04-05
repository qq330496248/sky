<?php
/**
 * @desc 类型转换
 * @author ChenLuoyong
 * @date 2014年9月17日
 */
class CInputFilter
{
	/**
	 * @desc 根据指导类型过滤数据
	 * @param mixed	$source 要过滤的数值
	 * @param string $type 参数类型
	 * @return mixed
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @modify 2014-10-10 Weixun Luo 修改对传递参数为空的情况的判断，修复参数为空时出错的bug
	 */
	private static function clean($source, $type = 'none')
	{
		$type = strtoupper($type);
		switch ($type)
		{
			case 'STRING':
				$result = get_magic_quotes_gpc() ? trim((string)$source) : addslashes(trim((string)$source));
				break;
			case 'INT':
				preg_match('/-?[0-9]+/', (string)$source, $match);
				$result = @(int)$match[0];
				break;
			case 'FLOAT':
				preg_match('/-?[0-9]+(\.[0-9]+)?/', (string) $source, $match);
				$result = @(float)$match[0];
				break;
			case 'BOOL':
				$result = @(bool)filter_var($source, FILTER_VALIDATE_BOOLEAN);
				break;
			case 'WORD':
				$result = (string) preg_replace('/[^A-Z_]/i', '', $source);
				break;
			case 'ALNUM':
				$result = (string) preg_replace('/[^A-Z0-9_]/i', '', $source);
				break;
			default:
				$result = addslashes((string)$source);
				break;
		}
		return $result;
	}

	/**
	 * @desc 获取过滤的Input数据
	 * @param string $name 要获取的参数名
	 * @param mixed	$default 该参数的默认值
	 * @param string $type 参数类型
	 * @return mixed
	 * @author ChenLuoyong
	 * @modify Guanghua Chen  增加判断$_GET和$_POST 2015-6-18
	 * @date 2014-9-17
	 */
	private static function getClean($name, $default = null, $type = 'none')
	{
		if(isset($_GET[$name])){
			$source = $_GET[$name];
			$result = self::clean($source, $type);
		} else if(isset($_POST[$name])) {
			$source = $_POST[$name];
			$result = self::clean($source, $type);
		} else if(isset($_REQUEST[$name])) {
			$source = $_REQUEST[$name];
			$result = self::clean($source, $type);
		} else {
			$result = $default;
		}		
		return $result;
	}
	/**
	 * @desc 过滤整型的参数
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @param string $name 要获取的参数名
	 * @param mixed	$default 该参数的默认值
	 * @param string $method 请求方式
	 * @return	int
	 */
	public static function getInt($name, $default = 0)
	{
		return self::getClean($name, $default, 'int');
	}

	/**
	 * @desc 过滤浮点型的参数
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @param string $name 要获取的参数名
	 * @param mixed $default 该参数的默认值
	 * @param string $method 请求方式
	 * @return float
	 */
	public static function getFloat($name, $default = 0.0)
	{
		return self::getClean($name, $default, 'float');
	}

	/**
	 * @desc 过滤布尔型的参数
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @param string $name 要获取的参数名
	 * @param mixed	$default 该参数的默认值
	 * @param string $method 请求方式
	 * @return	bool
	 */
	public static function getBool($name, $default = false)
	{
		return self::getVar($name, $default, 'bool');
	}

	/**
	 * @desc 过滤只允许字母、下划线不区分大小写的字符串参数
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @param	string	$name		要获取的参数名
	 * @param	mixed	$default	该参数的默认值
	 * @param	string	$method		请求方式
	 * @return	string
	 */
	public static function getWord($name, $default = '')
	{
		return self::getClean($name, $default, 'word');
	}

	/**
	 * @desc 字符串中的单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）进行转义的参数
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @param string $name 要获取的参数名
	 * @param mixed	$default 该参数的默认值
	 * @param string $method 请求方式
	 * @return string
	 */
	public static function getString($name, $default = '')
	{
		return self::getClean($name, $default, 'string');
	}

	/**
	 * @desc 过滤Input获取的数组里的每一个元素
	 * @param string $name 要获取的数组参数名
	 * @param mixed $filters 过滤规则或规则
	 * @param mixed	$default 该参数的默认值或默认值数组(当每个值使用单独过滤类型时生效)
	 * @return array $result 过滤后的结果数据
	 * @author Weixun Luo
	 * @date 2014-12-05
	 */
	public static function getArray($name, $filters, $default = '')
	{
		$result = $default;
		if(isset($_REQUEST[$name])){
			$source = $_REQUEST[$name];
			$result = self::cleanArray($source, $filters, $default);
		}
		return $result;
	}

	/**
	 * @desc 过滤数组里的每一个元素
	 * @param string $name 要获取的数组参数名
	 * @param mixed $filters 过滤规则或规则
	 * @param mixed	$default 该参数的默认值或默认值数组(当每个值使用单独过滤类型时生效)
	 * @return array $result 过滤后的结果数据
	 * @author Weixun Luo
	 * @date 2014-12-13
	 */
	public static function cleanArray($source, $filters, $default = '')
	{
		$result = array();
		if(!is_array($source)){
			return self::clean($result, $filters);
		}
		if(is_array($filters)){
			// 指定了每一个值的具体过滤类型
			foreach ($filters as $paramaName => $filterType) {
				if(isset($default[$paramaName])){
					$result[$paramaName] = $default[$paramaName];	// 默认值
				}
				if(isset($source[$paramaName])){
					if(is_array($source[$paramaName])){
						// 递归下去过滤
						$result[$paramaName] = self::cleanArray($source[$paramaName],
							$filterType[$paramaName], Utility::getArrayValue($default, $paramaName, ''));
					} else {
						$result[$paramaName] = self::clean($source[$paramaName], $filterType);
					}
				}
			}
		}
		if(is_string($filters)){
			// 全部值用一种过滤类型
			foreach ($source as $paramaName => $value) {
				if(is_array($value)){
					// 递归下去过滤
					$result[$paramaName] = self::cleanArray($value, $filters);
				} else {
					$result[$paramaName] = self::clean($value, $filters);
				}
			}
		}
		return $result;
	}

	/**
	 * @desc 过滤字母、数字、下划线字符串,不区分大小写
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @param	string	$name		要获取的参数名
	 * @param	mixed	$default	该参数的默认值
	 * @param	string	$method		请求方式
	 * @return	string
	 */
	public static function getAlnum ($name, $default = '')
	{
		return self::getClean($name, $default, 'alnum');
	}

	/**
	 * @desc 使用反斜线引用数组中的每一个元素
	 * @author ChenLuoyong
	 * @date 2014年9月17日
	 * @param array $source
	 * @return array|false
	 */
	public function addslashesDeep ($source)
	{
		if(empty($source)){
			return false;
		}
		$source = is_array( $source ) ? array_map( array( this, 'addslashesDeep' ), $source ) : addslashes($source );
		return $source;
	}

	/**
	 * @desc 去除数组中每个元素的转义反斜线字符
	 * @author ChenLuoyong
	 * @date 2014-9-17
	 * @param array $source
	 * @return array|false
	 */
	public function stripslashesDeep ($source)
	{
		$source = is_array( $source ) ? array_map( array( this, 'stripslashesDeep' ), $source ) : stripslashes($source );
		return $source;
	}

	/**
	 * @desc 转义一个字符串用于 mysql_query
	 * @date 2014年9月17日
	 * @author ChenLuoyong
	 * @param string $string
	 * @return string 过滤后的字符串
	 */
	public static function mysqlEscapeString($string)
	{
		$pattern = '/([\x00-\x1f\x7f]+)/';
		$string = preg_replace($pattern, '', $string);
		if (function_exists('mysql_escape_string')){
			return mysql_escape_string($string);
		}
		return addslashes($string);
	}

    /**
     * @desc 搜索关键词过滤
     * @author ChenLuoyong
     * @date 2014-9-17
     * @param string $string
     * @return string
    */
    public static function keywordsFilter($string)
    {
        $keywords = preg_replace('/[\&\'\~\"\*\%\/\$\^\!\|\(\)]+/', ' ',$string);
        $keywords = trim($keywords);
        return $keywords;
    }
}