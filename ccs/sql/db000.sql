/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : db000

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-04-01 18:12:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for advertset
-- ----------------------------
DROP TABLE IF EXISTS `advertset`;
CREATE TABLE `advertset` (
  `advertid` varchar(10) DEFAULT '' COMMENT '广告ID',
  `adverttext` varchar(50) DEFAULT NULL COMMENT '广告内容',
  `advertdate` date DEFAULT '1990-01-01' COMMENT '广告日期',
  `adverttime` time DEFAULT '23:59:59' COMMENT '广告播放时间',
  `duration` varchar(10) DEFAULT '' COMMENT '广告持续时间',
  `cost` varchar(10) DEFAULT '' COMMENT '广告费用',
  `adverttype` varchar(10) DEFAULT '' COMMENT '广告类型（意向）',
  `setter` varchar(50) DEFAULT '' COMMENT '操作人',
  `submittime` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '添加时间（提交时间）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of advertset
-- ----------------------------
INSERT INTO `advertset` VALUES ('GG15120001', '超级电视', '2015-12-15', '11:00:00', '1', '4221', '老人保健', 'dengshaocong', '2015-12-14 02:19:09');
INSERT INTO `advertset` VALUES ('GG15120002', '超级电视', '2015-12-16', '11:00:00', '1', '4221', '老人保健', 'dengshaocong', '2015-12-14 02:19:09');
INSERT INTO `advertset` VALUES ('GG15120003', '超级电视', '2015-12-15', '11:05:26', '1', '2013', '减肥', 'dengshaocong', '2015-12-14 04:10:18');
INSERT INTO `advertset` VALUES ('GG15120004', '超级电视', '2015-12-16', '11:05:26', '1', '2013', '减肥', 'dengshaocong', '2015-12-14 04:10:18');
INSERT INTO `advertset` VALUES ('GG15120005', '超级电视', '2015-12-17', '11:05:26', '1', '2013', '减肥', 'dengshaocong', '2015-12-14 04:10:18');
INSERT INTO `advertset` VALUES ('GG15120006', '超级网络', '2015-12-22', '00:00:00', '', '', '-', '管理员', '2015-12-22 09:59:37');

-- ----------------------------
-- Table structure for annset
-- ----------------------------
DROP TABLE IF EXISTS `annset`;
CREATE TABLE `annset` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(20) DEFAULT '' COMMENT '公告标题',
  `anntype` varchar(10) DEFAULT '' COMMENT '公告类型',
  `content` varchar(300) DEFAULT '' COMMENT '公告内容',
  `iftop` varchar(10) DEFAULT 'F' COMMENT '是否置顶',
  `anndate` date DEFAULT NULL COMMENT '发布时间',
  `ryid` int(10) DEFAULT '0' COMMENT '发布人ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of annset
-- ----------------------------
INSERT INTO `annset` VALUES ('11', '时间test', '接线', 'a ', 'T', '2015-11-14', '9');
INSERT INTO `annset` VALUES ('13', '时间test', '销售', 'as', 'F', '2015-11-16', '9');
INSERT INTO `annset` VALUES ('14', '时间test', '接线', 'sdf', 'T', '2015-11-16', '9');
INSERT INTO `annset` VALUES ('15', '测试是否重复', '接线', '呵呵', 'F', '2015-11-18', '10');
INSERT INTO `annset` VALUES ('16', '测试啊', '接线', '', 'F', '2015-11-23', '10');
INSERT INTO `annset` VALUES ('17', '测试123', '财务', '4123', 'T', '2015-11-24', '10');
INSERT INTO `annset` VALUES ('18', 'test123', '接线', '大打算打算', 'F', '2015-12-21', '9');

-- ----------------------------
-- Table structure for apparea
-- ----------------------------
DROP TABLE IF EXISTS `apparea`;
CREATE TABLE `apparea` (
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '区县ID',
  `aname` varchar(50) DEFAULT NULL COMMENT '区县名称',
  `cid` int(11) DEFAULT NULL COMMENT '城市ID',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of apparea
-- ----------------------------
INSERT INTO `apparea` VALUES ('110101', '东城区', '110100');
INSERT INTO `apparea` VALUES ('110102', '西城区', '110100');
INSERT INTO `apparea` VALUES ('110103', '崇文区', '110100');
INSERT INTO `apparea` VALUES ('110104', '宣武区', '110100');
INSERT INTO `apparea` VALUES ('110105', '朝阳区', '110100');
INSERT INTO `apparea` VALUES ('110106', '丰台区', '110100');
INSERT INTO `apparea` VALUES ('110107', '石景山区', '110100');
INSERT INTO `apparea` VALUES ('110108', '海淀区', '110100');
INSERT INTO `apparea` VALUES ('110109', '门头沟区', '110100');
INSERT INTO `apparea` VALUES ('110111', '房山区', '110100');
INSERT INTO `apparea` VALUES ('110112', '通州区', '110100');
INSERT INTO `apparea` VALUES ('110113', '顺义区', '110100');
INSERT INTO `apparea` VALUES ('110114', '昌平区', '110100');
INSERT INTO `apparea` VALUES ('110115', '大兴区', '110100');
INSERT INTO `apparea` VALUES ('110116', '怀柔区', '110100');
INSERT INTO `apparea` VALUES ('110117', '平谷区', '110100');
INSERT INTO `apparea` VALUES ('110228', '密云县', '110200');
INSERT INTO `apparea` VALUES ('110229', '延庆县', '110200');
INSERT INTO `apparea` VALUES ('120101', '和平区', '120100');
INSERT INTO `apparea` VALUES ('120102', '河东区', '120100');
INSERT INTO `apparea` VALUES ('120103', '河西区', '120100');
INSERT INTO `apparea` VALUES ('120104', '南开区', '120100');
INSERT INTO `apparea` VALUES ('120105', '河北区', '120100');
INSERT INTO `apparea` VALUES ('120106', '红桥区', '120100');
INSERT INTO `apparea` VALUES ('120107', '塘沽区', '120100');
INSERT INTO `apparea` VALUES ('120108', '汉沽区', '120100');
INSERT INTO `apparea` VALUES ('120109', '大港区', '120100');
INSERT INTO `apparea` VALUES ('120110', '东丽区', '120100');
INSERT INTO `apparea` VALUES ('120111', '西青区', '120100');
INSERT INTO `apparea` VALUES ('120112', '津南区', '120100');
INSERT INTO `apparea` VALUES ('120113', '北辰区', '120100');
INSERT INTO `apparea` VALUES ('120114', '武清区', '120100');
INSERT INTO `apparea` VALUES ('120115', '宝坻区', '120100');
INSERT INTO `apparea` VALUES ('120116', '宁河县', '120100');
INSERT INTO `apparea` VALUES ('120117', '静海县', '120100');
INSERT INTO `apparea` VALUES ('120118', '蓟县', '120100');
INSERT INTO `apparea` VALUES ('130102', '长安区', '130100');
INSERT INTO `apparea` VALUES ('130103', '桥东区', '130100');
INSERT INTO `apparea` VALUES ('130104', '桥西区', '130100');
INSERT INTO `apparea` VALUES ('130105', '新华区', '130100');
INSERT INTO `apparea` VALUES ('130107', '井陉矿区', '130100');
INSERT INTO `apparea` VALUES ('130108', '裕华区', '130100');
INSERT INTO `apparea` VALUES ('130121', '井陉县', '130100');
INSERT INTO `apparea` VALUES ('130123', '正定县', '130100');
INSERT INTO `apparea` VALUES ('130124', '栾城县', '130100');
INSERT INTO `apparea` VALUES ('130125', '行唐县', '130100');
INSERT INTO `apparea` VALUES ('130126', '灵寿县', '130100');
INSERT INTO `apparea` VALUES ('130127', '高邑县', '130100');
INSERT INTO `apparea` VALUES ('130128', '深泽县', '130100');
INSERT INTO `apparea` VALUES ('130129', '赞皇县', '130100');
INSERT INTO `apparea` VALUES ('130130', '无极县', '130100');
INSERT INTO `apparea` VALUES ('130131', '平山县', '130100');
INSERT INTO `apparea` VALUES ('130132', '元氏县', '130100');
INSERT INTO `apparea` VALUES ('130133', '赵　县', '130100');
INSERT INTO `apparea` VALUES ('130181', '辛集市', '130100');
INSERT INTO `apparea` VALUES ('130182', '藁城市', '130100');
INSERT INTO `apparea` VALUES ('130183', '晋州市', '130100');
INSERT INTO `apparea` VALUES ('130184', '新乐市', '130100');
INSERT INTO `apparea` VALUES ('130185', '鹿泉市', '130100');
INSERT INTO `apparea` VALUES ('130202', '路南区', '130200');
INSERT INTO `apparea` VALUES ('130203', '路北区', '130200');
INSERT INTO `apparea` VALUES ('130204', '古冶区', '130200');
INSERT INTO `apparea` VALUES ('130205', '开平区', '130200');
INSERT INTO `apparea` VALUES ('130207', '丰南区', '130200');
INSERT INTO `apparea` VALUES ('130208', '丰润区', '130200');
INSERT INTO `apparea` VALUES ('130223', '滦　县', '130200');
INSERT INTO `apparea` VALUES ('130224', '滦南县', '130200');
INSERT INTO `apparea` VALUES ('130225', '乐亭县', '130200');
INSERT INTO `apparea` VALUES ('130227', '迁西县', '130200');
INSERT INTO `apparea` VALUES ('130229', '玉田县', '130200');
INSERT INTO `apparea` VALUES ('130230', '唐海县', '130200');
INSERT INTO `apparea` VALUES ('130281', '遵化市', '130200');
INSERT INTO `apparea` VALUES ('130283', '迁安市', '130200');
INSERT INTO `apparea` VALUES ('130302', '海港区', '130300');
INSERT INTO `apparea` VALUES ('130303', '山海关区', '130300');
INSERT INTO `apparea` VALUES ('130304', '北戴河区', '130300');
INSERT INTO `apparea` VALUES ('130321', '青龙满族自治县', '130300');
INSERT INTO `apparea` VALUES ('130322', '昌黎县', '130300');
INSERT INTO `apparea` VALUES ('130323', '抚宁县', '130300');
INSERT INTO `apparea` VALUES ('130324', '卢龙县', '130300');
INSERT INTO `apparea` VALUES ('130402', '邯山区', '130400');
INSERT INTO `apparea` VALUES ('130403', '丛台区', '130400');
INSERT INTO `apparea` VALUES ('130404', '复兴区', '130400');
INSERT INTO `apparea` VALUES ('130406', '峰峰矿区', '130400');
INSERT INTO `apparea` VALUES ('130421', '邯郸县', '130400');
INSERT INTO `apparea` VALUES ('130423', '临漳县', '130400');
INSERT INTO `apparea` VALUES ('130424', '成安县', '130400');
INSERT INTO `apparea` VALUES ('130425', '大名县', '130400');
INSERT INTO `apparea` VALUES ('130426', '涉　县', '130400');
INSERT INTO `apparea` VALUES ('130427', '磁　县', '130400');
INSERT INTO `apparea` VALUES ('130428', '肥乡县', '130400');
INSERT INTO `apparea` VALUES ('130429', '永年县', '130400');
INSERT INTO `apparea` VALUES ('130430', '邱　县', '130400');
INSERT INTO `apparea` VALUES ('130431', '鸡泽县', '130400');
INSERT INTO `apparea` VALUES ('130432', '广平县', '130400');
INSERT INTO `apparea` VALUES ('130433', '馆陶县', '130400');
INSERT INTO `apparea` VALUES ('130434', '魏　县', '130400');
INSERT INTO `apparea` VALUES ('130435', '曲周县', '130400');
INSERT INTO `apparea` VALUES ('130481', '武安市', '130400');
INSERT INTO `apparea` VALUES ('130502', '桥东区', '130500');
INSERT INTO `apparea` VALUES ('130503', '桥西区', '130500');
INSERT INTO `apparea` VALUES ('130521', '邢台县', '130500');
INSERT INTO `apparea` VALUES ('130522', '临城县', '130500');
INSERT INTO `apparea` VALUES ('130523', '内丘县', '130500');
INSERT INTO `apparea` VALUES ('130524', '柏乡县', '130500');
INSERT INTO `apparea` VALUES ('130525', '隆尧县', '130500');
INSERT INTO `apparea` VALUES ('130526', '任　县', '130500');
INSERT INTO `apparea` VALUES ('130527', '南和县', '130500');
INSERT INTO `apparea` VALUES ('130528', '宁晋县', '130500');
INSERT INTO `apparea` VALUES ('130529', '巨鹿县', '130500');
INSERT INTO `apparea` VALUES ('130530', '新河县', '130500');
INSERT INTO `apparea` VALUES ('130531', '广宗县', '130500');
INSERT INTO `apparea` VALUES ('130532', '平乡县', '130500');
INSERT INTO `apparea` VALUES ('130533', '威　县', '130500');
INSERT INTO `apparea` VALUES ('130534', '清河县', '130500');
INSERT INTO `apparea` VALUES ('130535', '临西县', '130500');
INSERT INTO `apparea` VALUES ('130581', '南宫市', '130500');
INSERT INTO `apparea` VALUES ('130582', '沙河市', '130500');
INSERT INTO `apparea` VALUES ('130602', '新市区', '130600');
INSERT INTO `apparea` VALUES ('130603', '北市区', '130600');
INSERT INTO `apparea` VALUES ('130604', '南市区', '130600');
INSERT INTO `apparea` VALUES ('130621', '满城县', '130600');
INSERT INTO `apparea` VALUES ('130622', '清苑县', '130600');
INSERT INTO `apparea` VALUES ('130623', '涞水县', '130600');
INSERT INTO `apparea` VALUES ('130624', '阜平县', '130600');
INSERT INTO `apparea` VALUES ('130625', '徐水县', '130600');
INSERT INTO `apparea` VALUES ('130626', '定兴县', '130600');
INSERT INTO `apparea` VALUES ('130627', '唐　县', '130600');
INSERT INTO `apparea` VALUES ('130628', '高阳县', '130600');
INSERT INTO `apparea` VALUES ('130629', '容城县', '130600');
INSERT INTO `apparea` VALUES ('130630', '涞源县', '130600');
INSERT INTO `apparea` VALUES ('130631', '望都县', '130600');
INSERT INTO `apparea` VALUES ('130632', '安新县', '130600');
INSERT INTO `apparea` VALUES ('130633', '易　县', '130600');
INSERT INTO `apparea` VALUES ('130634', '曲阳县', '130600');
INSERT INTO `apparea` VALUES ('130635', '蠡　县', '130600');
INSERT INTO `apparea` VALUES ('130636', '顺平县', '130600');
INSERT INTO `apparea` VALUES ('130637', '博野县', '130600');
INSERT INTO `apparea` VALUES ('130638', '雄　县', '130600');
INSERT INTO `apparea` VALUES ('130681', '涿州市', '130600');
INSERT INTO `apparea` VALUES ('130682', '定州市', '130600');
INSERT INTO `apparea` VALUES ('130683', '安国市', '130600');
INSERT INTO `apparea` VALUES ('130684', '高碑店市', '130600');
INSERT INTO `apparea` VALUES ('130702', '桥东区', '130700');
INSERT INTO `apparea` VALUES ('130703', '桥西区', '130700');
INSERT INTO `apparea` VALUES ('130705', '宣化区', '130700');
INSERT INTO `apparea` VALUES ('130706', '下花园区', '130700');
INSERT INTO `apparea` VALUES ('130721', '宣化县', '130700');
INSERT INTO `apparea` VALUES ('130722', '张北县', '130700');
INSERT INTO `apparea` VALUES ('130723', '康保县', '130700');
INSERT INTO `apparea` VALUES ('130724', '沽源县', '130700');
INSERT INTO `apparea` VALUES ('130725', '尚义县', '130700');
INSERT INTO `apparea` VALUES ('130726', '蔚　县', '130700');
INSERT INTO `apparea` VALUES ('130727', '阳原县', '130700');
INSERT INTO `apparea` VALUES ('130728', '怀安县', '130700');
INSERT INTO `apparea` VALUES ('130729', '万全县', '130700');
INSERT INTO `apparea` VALUES ('130730', '怀来县', '130700');
INSERT INTO `apparea` VALUES ('130731', '涿鹿县', '130700');
INSERT INTO `apparea` VALUES ('130732', '赤城县', '130700');
INSERT INTO `apparea` VALUES ('130733', '崇礼县', '130700');
INSERT INTO `apparea` VALUES ('130802', '双桥区', '130800');
INSERT INTO `apparea` VALUES ('130803', '双滦区', '130800');
INSERT INTO `apparea` VALUES ('130804', '鹰手营子矿区', '130800');
INSERT INTO `apparea` VALUES ('130821', '承德县', '130800');
INSERT INTO `apparea` VALUES ('130822', '兴隆县', '130800');
INSERT INTO `apparea` VALUES ('130823', '平泉县', '130800');
INSERT INTO `apparea` VALUES ('130824', '滦平县', '130800');
INSERT INTO `apparea` VALUES ('130825', '隆化县', '130800');
INSERT INTO `apparea` VALUES ('130826', '丰宁满族自治县', '130800');
INSERT INTO `apparea` VALUES ('130827', '宽城满族自治县', '130800');
INSERT INTO `apparea` VALUES ('130828', '围场满族蒙古族自治县', '130800');
INSERT INTO `apparea` VALUES ('130902', '新华区', '130900');
INSERT INTO `apparea` VALUES ('130903', '运河区', '130900');
INSERT INTO `apparea` VALUES ('130921', '沧　县', '130900');
INSERT INTO `apparea` VALUES ('130922', '青　县', '130900');
INSERT INTO `apparea` VALUES ('130923', '东光县', '130900');
INSERT INTO `apparea` VALUES ('130924', '海兴县', '130900');
INSERT INTO `apparea` VALUES ('130925', '盐山县', '130900');
INSERT INTO `apparea` VALUES ('130926', '肃宁县', '130900');
INSERT INTO `apparea` VALUES ('130927', '南皮县', '130900');
INSERT INTO `apparea` VALUES ('130928', '吴桥县', '130900');
INSERT INTO `apparea` VALUES ('130929', '献　县', '130900');
INSERT INTO `apparea` VALUES ('130930', '孟村回族自治县', '130900');
INSERT INTO `apparea` VALUES ('130981', '泊头市', '130900');
INSERT INTO `apparea` VALUES ('130982', '任丘市', '130900');
INSERT INTO `apparea` VALUES ('130983', '黄骅市', '130900');
INSERT INTO `apparea` VALUES ('130984', '河间市', '130900');
INSERT INTO `apparea` VALUES ('131002', '安次区', '131000');
INSERT INTO `apparea` VALUES ('131003', '广阳区', '131000');
INSERT INTO `apparea` VALUES ('131022', '固安县', '131000');
INSERT INTO `apparea` VALUES ('131023', '永清县', '131000');
INSERT INTO `apparea` VALUES ('131024', '香河县', '131000');
INSERT INTO `apparea` VALUES ('131025', '大城县', '131000');
INSERT INTO `apparea` VALUES ('131026', '文安县', '131000');
INSERT INTO `apparea` VALUES ('131028', '大厂回族自治县', '131000');
INSERT INTO `apparea` VALUES ('131081', '霸州市', '131000');
INSERT INTO `apparea` VALUES ('131082', '三河市', '131000');
INSERT INTO `apparea` VALUES ('131102', '桃城区', '131100');
INSERT INTO `apparea` VALUES ('131121', '枣强县', '131100');
INSERT INTO `apparea` VALUES ('131122', '武邑县', '131100');
INSERT INTO `apparea` VALUES ('131123', '武强县', '131100');
INSERT INTO `apparea` VALUES ('131124', '饶阳县', '131100');
INSERT INTO `apparea` VALUES ('131125', '安平县', '131100');
INSERT INTO `apparea` VALUES ('131126', '故城县', '131100');
INSERT INTO `apparea` VALUES ('131127', '景　县', '131100');
INSERT INTO `apparea` VALUES ('131128', '阜城县', '131100');
INSERT INTO `apparea` VALUES ('131181', '冀州市', '131100');
INSERT INTO `apparea` VALUES ('131182', '深州市', '131100');
INSERT INTO `apparea` VALUES ('140105', '小店区', '140100');
INSERT INTO `apparea` VALUES ('140106', '迎泽区', '140100');
INSERT INTO `apparea` VALUES ('140107', '杏花岭区', '140100');
INSERT INTO `apparea` VALUES ('140108', '尖草坪区', '140100');
INSERT INTO `apparea` VALUES ('140109', '万柏林区', '140100');
INSERT INTO `apparea` VALUES ('140110', '晋源区', '140100');
INSERT INTO `apparea` VALUES ('140121', '清徐县', '140100');
INSERT INTO `apparea` VALUES ('140122', '阳曲县', '140100');
INSERT INTO `apparea` VALUES ('140123', '娄烦县', '140100');
INSERT INTO `apparea` VALUES ('140181', '古交市', '140100');
INSERT INTO `apparea` VALUES ('140202', '城　区', '140200');
INSERT INTO `apparea` VALUES ('140203', '矿　区', '140200');
INSERT INTO `apparea` VALUES ('140211', '南郊区', '140200');
INSERT INTO `apparea` VALUES ('140212', '新荣区', '140200');
INSERT INTO `apparea` VALUES ('140221', '阳高县', '140200');
INSERT INTO `apparea` VALUES ('140222', '天镇县', '140200');
INSERT INTO `apparea` VALUES ('140223', '广灵县', '140200');
INSERT INTO `apparea` VALUES ('140224', '灵丘县', '140200');
INSERT INTO `apparea` VALUES ('140225', '浑源县', '140200');
INSERT INTO `apparea` VALUES ('140226', '左云县', '140200');
INSERT INTO `apparea` VALUES ('140227', '大同县', '140200');
INSERT INTO `apparea` VALUES ('140302', '城　区', '140300');
INSERT INTO `apparea` VALUES ('140303', '矿　区', '140300');
INSERT INTO `apparea` VALUES ('140311', '郊　区', '140300');
INSERT INTO `apparea` VALUES ('140321', '平定县', '140300');
INSERT INTO `apparea` VALUES ('140322', '盂　县', '140300');
INSERT INTO `apparea` VALUES ('140402', '城　区', '140400');
INSERT INTO `apparea` VALUES ('140411', '郊　区', '140400');
INSERT INTO `apparea` VALUES ('140421', '长治县', '140400');
INSERT INTO `apparea` VALUES ('140423', '襄垣县', '140400');
INSERT INTO `apparea` VALUES ('140424', '屯留县', '140400');
INSERT INTO `apparea` VALUES ('140425', '平顺县', '140400');
INSERT INTO `apparea` VALUES ('140426', '黎城县', '140400');
INSERT INTO `apparea` VALUES ('140427', '壶关县', '140400');
INSERT INTO `apparea` VALUES ('140428', '长子县', '140400');
INSERT INTO `apparea` VALUES ('140429', '武乡县', '140400');
INSERT INTO `apparea` VALUES ('140430', '沁　县', '140400');
INSERT INTO `apparea` VALUES ('140431', '沁源县', '140400');
INSERT INTO `apparea` VALUES ('140481', '潞城市', '140400');
INSERT INTO `apparea` VALUES ('140502', '城　区', '140500');
INSERT INTO `apparea` VALUES ('140521', '沁水县', '140500');
INSERT INTO `apparea` VALUES ('140522', '阳城县', '140500');
INSERT INTO `apparea` VALUES ('140524', '陵川县', '140500');
INSERT INTO `apparea` VALUES ('140525', '泽州县', '140500');
INSERT INTO `apparea` VALUES ('140581', '高平市', '140500');
INSERT INTO `apparea` VALUES ('140602', '朔城区', '140600');
INSERT INTO `apparea` VALUES ('140603', '平鲁区', '140600');
INSERT INTO `apparea` VALUES ('140621', '山阴县', '140600');
INSERT INTO `apparea` VALUES ('140622', '应　县', '140600');
INSERT INTO `apparea` VALUES ('140623', '右玉县', '140600');
INSERT INTO `apparea` VALUES ('140624', '怀仁县', '140600');
INSERT INTO `apparea` VALUES ('140702', '榆次区', '140700');
INSERT INTO `apparea` VALUES ('140721', '榆社县', '140700');
INSERT INTO `apparea` VALUES ('140722', '左权县', '140700');
INSERT INTO `apparea` VALUES ('140723', '和顺县', '140700');
INSERT INTO `apparea` VALUES ('140724', '昔阳县', '140700');
INSERT INTO `apparea` VALUES ('140725', '寿阳县', '140700');
INSERT INTO `apparea` VALUES ('140726', '太谷县', '140700');
INSERT INTO `apparea` VALUES ('140727', '祁　县', '140700');
INSERT INTO `apparea` VALUES ('140728', '平遥县', '140700');
INSERT INTO `apparea` VALUES ('140729', '灵石县', '140700');
INSERT INTO `apparea` VALUES ('140781', '介休市', '140700');
INSERT INTO `apparea` VALUES ('140802', '盐湖区', '140800');
INSERT INTO `apparea` VALUES ('140821', '临猗县', '140800');
INSERT INTO `apparea` VALUES ('140822', '万荣县', '140800');
INSERT INTO `apparea` VALUES ('140823', '闻喜县', '140800');
INSERT INTO `apparea` VALUES ('140824', '稷山县', '140800');
INSERT INTO `apparea` VALUES ('140825', '新绛县', '140800');
INSERT INTO `apparea` VALUES ('140826', '绛　县', '140800');
INSERT INTO `apparea` VALUES ('140827', '垣曲县', '140800');
INSERT INTO `apparea` VALUES ('140828', '夏　县', '140800');
INSERT INTO `apparea` VALUES ('140829', '平陆县', '140800');
INSERT INTO `apparea` VALUES ('140830', '芮城县', '140800');
INSERT INTO `apparea` VALUES ('140881', '永济市', '140800');
INSERT INTO `apparea` VALUES ('140882', '河津市', '140800');
INSERT INTO `apparea` VALUES ('140902', '忻府区', '140900');
INSERT INTO `apparea` VALUES ('140921', '定襄县', '140900');
INSERT INTO `apparea` VALUES ('140922', '五台县', '140900');
INSERT INTO `apparea` VALUES ('140923', '代　县', '140900');
INSERT INTO `apparea` VALUES ('140924', '繁峙县', '140900');
INSERT INTO `apparea` VALUES ('140925', '宁武县', '140900');
INSERT INTO `apparea` VALUES ('140926', '静乐县', '140900');
INSERT INTO `apparea` VALUES ('140927', '神池县', '140900');
INSERT INTO `apparea` VALUES ('140928', '五寨县', '140900');
INSERT INTO `apparea` VALUES ('140929', '岢岚县', '140900');
INSERT INTO `apparea` VALUES ('140930', '河曲县', '140900');
INSERT INTO `apparea` VALUES ('140931', '保德县', '140900');
INSERT INTO `apparea` VALUES ('140932', '偏关县', '140900');
INSERT INTO `apparea` VALUES ('140981', '原平市', '140900');
INSERT INTO `apparea` VALUES ('141002', '尧都区', '141000');
INSERT INTO `apparea` VALUES ('141021', '曲沃县', '141000');
INSERT INTO `apparea` VALUES ('141022', '翼城县', '141000');
INSERT INTO `apparea` VALUES ('141023', '襄汾县', '141000');
INSERT INTO `apparea` VALUES ('141024', '洪洞县', '141000');
INSERT INTO `apparea` VALUES ('141025', '古　县', '141000');
INSERT INTO `apparea` VALUES ('141026', '安泽县', '141000');
INSERT INTO `apparea` VALUES ('141027', '浮山县', '141000');
INSERT INTO `apparea` VALUES ('141028', '吉　县', '141000');
INSERT INTO `apparea` VALUES ('141029', '乡宁县', '141000');
INSERT INTO `apparea` VALUES ('141030', '大宁县', '141000');
INSERT INTO `apparea` VALUES ('141031', '隰　县', '141000');
INSERT INTO `apparea` VALUES ('141032', '永和县', '141000');
INSERT INTO `apparea` VALUES ('141033', '蒲　县', '141000');
INSERT INTO `apparea` VALUES ('141034', '汾西县', '141000');
INSERT INTO `apparea` VALUES ('141081', '侯马市', '141000');
INSERT INTO `apparea` VALUES ('141082', '霍州市', '141000');
INSERT INTO `apparea` VALUES ('141102', '离石区', '141100');
INSERT INTO `apparea` VALUES ('141121', '文水县', '141100');
INSERT INTO `apparea` VALUES ('141122', '交城县', '141100');
INSERT INTO `apparea` VALUES ('141123', '兴　县', '141100');
INSERT INTO `apparea` VALUES ('141124', '临　县', '141100');
INSERT INTO `apparea` VALUES ('141125', '柳林县', '141100');
INSERT INTO `apparea` VALUES ('141126', '石楼县', '141100');
INSERT INTO `apparea` VALUES ('141127', '岚　县', '141100');
INSERT INTO `apparea` VALUES ('141128', '方山县', '141100');
INSERT INTO `apparea` VALUES ('141129', '中阳县', '141100');
INSERT INTO `apparea` VALUES ('141130', '交口县', '141100');
INSERT INTO `apparea` VALUES ('141181', '孝义市', '141100');
INSERT INTO `apparea` VALUES ('141182', '汾阳市', '141100');
INSERT INTO `apparea` VALUES ('150102', '新城区', '150100');
INSERT INTO `apparea` VALUES ('150103', '回民区', '150100');
INSERT INTO `apparea` VALUES ('150104', '玉泉区', '150100');
INSERT INTO `apparea` VALUES ('150105', '赛罕区', '150100');
INSERT INTO `apparea` VALUES ('150121', '土默特左旗', '150100');
INSERT INTO `apparea` VALUES ('150122', '托克托县', '150100');
INSERT INTO `apparea` VALUES ('150123', '和林格尔县', '150100');
INSERT INTO `apparea` VALUES ('150124', '清水河县', '150100');
INSERT INTO `apparea` VALUES ('150125', '武川县', '150100');
INSERT INTO `apparea` VALUES ('150202', '东河区', '150200');
INSERT INTO `apparea` VALUES ('150203', '昆都仑区', '150200');
INSERT INTO `apparea` VALUES ('150204', '青山区', '150200');
INSERT INTO `apparea` VALUES ('150205', '石拐区', '150200');
INSERT INTO `apparea` VALUES ('150206', '白云矿区', '150200');
INSERT INTO `apparea` VALUES ('150207', '九原区', '150200');
INSERT INTO `apparea` VALUES ('150221', '土默特右旗', '150200');
INSERT INTO `apparea` VALUES ('150222', '固阳县', '150200');
INSERT INTO `apparea` VALUES ('150223', '达尔罕茂明安联合旗', '150200');
INSERT INTO `apparea` VALUES ('150302', '海勃湾区', '150300');
INSERT INTO `apparea` VALUES ('150303', '海南区', '150300');
INSERT INTO `apparea` VALUES ('150304', '乌达区', '150300');
INSERT INTO `apparea` VALUES ('150402', '红山区', '150400');
INSERT INTO `apparea` VALUES ('150403', '元宝山区', '150400');
INSERT INTO `apparea` VALUES ('150404', '松山区', '150400');
INSERT INTO `apparea` VALUES ('150421', '阿鲁科尔沁旗', '150400');
INSERT INTO `apparea` VALUES ('150422', '巴林左旗', '150400');
INSERT INTO `apparea` VALUES ('150423', '巴林右旗', '150400');
INSERT INTO `apparea` VALUES ('150424', '林西县', '150400');
INSERT INTO `apparea` VALUES ('150425', '克什克腾旗', '150400');
INSERT INTO `apparea` VALUES ('150426', '翁牛特旗', '150400');
INSERT INTO `apparea` VALUES ('150428', '喀喇沁旗', '150400');
INSERT INTO `apparea` VALUES ('150429', '宁城县', '150400');
INSERT INTO `apparea` VALUES ('150430', '敖汉旗', '150400');
INSERT INTO `apparea` VALUES ('150502', '科尔沁区', '150500');
INSERT INTO `apparea` VALUES ('150521', '科尔沁左翼中旗', '150500');
INSERT INTO `apparea` VALUES ('150522', '科尔沁左翼后旗', '150500');
INSERT INTO `apparea` VALUES ('150523', '开鲁县', '150500');
INSERT INTO `apparea` VALUES ('150524', '库伦旗', '150500');
INSERT INTO `apparea` VALUES ('150525', '奈曼旗', '150500');
INSERT INTO `apparea` VALUES ('150526', '扎鲁特旗', '150500');
INSERT INTO `apparea` VALUES ('150581', '霍林郭勒市', '150500');
INSERT INTO `apparea` VALUES ('150602', '东胜区', '150600');
INSERT INTO `apparea` VALUES ('150621', '达拉特旗', '150600');
INSERT INTO `apparea` VALUES ('150622', '准格尔旗', '150600');
INSERT INTO `apparea` VALUES ('150623', '鄂托克前旗', '150600');
INSERT INTO `apparea` VALUES ('150624', '鄂托克旗', '150600');
INSERT INTO `apparea` VALUES ('150625', '杭锦旗', '150600');
INSERT INTO `apparea` VALUES ('150626', '乌审旗', '150600');
INSERT INTO `apparea` VALUES ('150627', '伊金霍洛旗', '150600');
INSERT INTO `apparea` VALUES ('150702', '海拉尔区', '150700');
INSERT INTO `apparea` VALUES ('150721', '阿荣旗', '150700');
INSERT INTO `apparea` VALUES ('150722', '莫力达瓦达斡尔族自治旗', '150700');
INSERT INTO `apparea` VALUES ('150723', '鄂伦春自治旗', '150700');
INSERT INTO `apparea` VALUES ('150724', '鄂温克族自治旗', '150700');
INSERT INTO `apparea` VALUES ('150725', '陈巴尔虎旗', '150700');
INSERT INTO `apparea` VALUES ('150726', '新巴尔虎左旗', '150700');
INSERT INTO `apparea` VALUES ('150727', '新巴尔虎右旗', '150700');
INSERT INTO `apparea` VALUES ('150781', '满洲里市', '150700');
INSERT INTO `apparea` VALUES ('150782', '牙克石市', '150700');
INSERT INTO `apparea` VALUES ('150783', '扎兰屯市', '150700');
INSERT INTO `apparea` VALUES ('150784', '额尔古纳市', '150700');
INSERT INTO `apparea` VALUES ('150785', '根河市', '150700');
INSERT INTO `apparea` VALUES ('150802', '临河区', '150800');
INSERT INTO `apparea` VALUES ('150821', '五原县', '150800');
INSERT INTO `apparea` VALUES ('150822', '磴口县', '150800');
INSERT INTO `apparea` VALUES ('150823', '乌拉特前旗', '150800');
INSERT INTO `apparea` VALUES ('150824', '乌拉特中旗', '150800');
INSERT INTO `apparea` VALUES ('150825', '乌拉特后旗', '150800');
INSERT INTO `apparea` VALUES ('150826', '杭锦后旗', '150800');
INSERT INTO `apparea` VALUES ('150902', '集宁区', '150900');
INSERT INTO `apparea` VALUES ('150921', '卓资县', '150900');
INSERT INTO `apparea` VALUES ('150922', '化德县', '150900');
INSERT INTO `apparea` VALUES ('150923', '商都县', '150900');
INSERT INTO `apparea` VALUES ('150924', '兴和县', '150900');
INSERT INTO `apparea` VALUES ('150925', '凉城县', '150900');
INSERT INTO `apparea` VALUES ('150926', '察哈尔右翼前旗', '150900');
INSERT INTO `apparea` VALUES ('150927', '察哈尔右翼中旗', '150900');
INSERT INTO `apparea` VALUES ('150928', '察哈尔右翼后旗', '150900');
INSERT INTO `apparea` VALUES ('150929', '四子王旗', '150900');
INSERT INTO `apparea` VALUES ('150981', '丰镇市', '150900');
INSERT INTO `apparea` VALUES ('152201', '乌兰浩特市', '152200');
INSERT INTO `apparea` VALUES ('152202', '阿尔山市', '152200');
INSERT INTO `apparea` VALUES ('152221', '科尔沁右翼前旗', '152200');
INSERT INTO `apparea` VALUES ('152222', '科尔沁右翼中旗', '152200');
INSERT INTO `apparea` VALUES ('152223', '扎赉特旗', '152200');
INSERT INTO `apparea` VALUES ('152224', '突泉县', '152200');
INSERT INTO `apparea` VALUES ('152501', '二连浩特市', '152500');
INSERT INTO `apparea` VALUES ('152502', '锡林浩特市', '152500');
INSERT INTO `apparea` VALUES ('152522', '阿巴嘎旗', '152500');
INSERT INTO `apparea` VALUES ('152523', '苏尼特左旗', '152500');
INSERT INTO `apparea` VALUES ('152524', '苏尼特右旗', '152500');
INSERT INTO `apparea` VALUES ('152526', '西乌珠穆沁旗', '152500');
INSERT INTO `apparea` VALUES ('152527', '太仆寺旗', '152500');
INSERT INTO `apparea` VALUES ('152528', '镶黄旗', '152500');
INSERT INTO `apparea` VALUES ('152529', '正镶白旗', '152500');
INSERT INTO `apparea` VALUES ('152530', '正蓝旗', '152500');
INSERT INTO `apparea` VALUES ('152531', '多伦县', '152500');
INSERT INTO `apparea` VALUES ('152921', '阿拉善左旗', '152900');
INSERT INTO `apparea` VALUES ('152922', '阿拉善右旗', '152900');
INSERT INTO `apparea` VALUES ('152923', '额济纳旗', '152900');
INSERT INTO `apparea` VALUES ('210102', '和平区', '210100');
INSERT INTO `apparea` VALUES ('210103', '沈河区', '210100');
INSERT INTO `apparea` VALUES ('210104', '大东区', '210100');
INSERT INTO `apparea` VALUES ('210105', '皇姑区', '210100');
INSERT INTO `apparea` VALUES ('210106', '铁西区', '210100');
INSERT INTO `apparea` VALUES ('210111', '苏家屯区', '210100');
INSERT INTO `apparea` VALUES ('210112', '东陵区', '210100');
INSERT INTO `apparea` VALUES ('210113', '新城子区', '210100');
INSERT INTO `apparea` VALUES ('210114', '于洪区', '210100');
INSERT INTO `apparea` VALUES ('210122', '辽中县', '210100');
INSERT INTO `apparea` VALUES ('210123', '康平县', '210100');
INSERT INTO `apparea` VALUES ('210124', '法库县', '210100');
INSERT INTO `apparea` VALUES ('210181', '新民市', '210100');
INSERT INTO `apparea` VALUES ('210202', '中山区', '210200');
INSERT INTO `apparea` VALUES ('210203', '西岗区', '210200');
INSERT INTO `apparea` VALUES ('210204', '沙河口区', '210200');
INSERT INTO `apparea` VALUES ('210211', '甘井子区', '210200');
INSERT INTO `apparea` VALUES ('210212', '旅顺口区', '210200');
INSERT INTO `apparea` VALUES ('210213', '金州区', '210200');
INSERT INTO `apparea` VALUES ('210224', '长海县', '210200');
INSERT INTO `apparea` VALUES ('210281', '瓦房店市', '210200');
INSERT INTO `apparea` VALUES ('210282', '普兰店市', '210200');
INSERT INTO `apparea` VALUES ('210283', '庄河市', '210200');
INSERT INTO `apparea` VALUES ('210302', '铁东区', '210300');
INSERT INTO `apparea` VALUES ('210303', '铁西区', '210300');
INSERT INTO `apparea` VALUES ('210304', '立山区', '210300');
INSERT INTO `apparea` VALUES ('210311', '千山区', '210300');
INSERT INTO `apparea` VALUES ('210321', '台安县', '210300');
INSERT INTO `apparea` VALUES ('210323', '岫岩满族自治县', '210300');
INSERT INTO `apparea` VALUES ('210381', '海城市', '210300');
INSERT INTO `apparea` VALUES ('210402', '新抚区', '210400');
INSERT INTO `apparea` VALUES ('210403', '东洲区', '210400');
INSERT INTO `apparea` VALUES ('210404', '望花区', '210400');
INSERT INTO `apparea` VALUES ('210411', '顺城区', '210400');
INSERT INTO `apparea` VALUES ('210421', '抚顺县', '210400');
INSERT INTO `apparea` VALUES ('210422', '新宾满族自治县', '210400');
INSERT INTO `apparea` VALUES ('210423', '清原满族自治县', '210400');
INSERT INTO `apparea` VALUES ('210502', '平山区', '210500');
INSERT INTO `apparea` VALUES ('210503', '溪湖区', '210500');
INSERT INTO `apparea` VALUES ('210504', '明山区', '210500');
INSERT INTO `apparea` VALUES ('210505', '南芬区', '210500');
INSERT INTO `apparea` VALUES ('210521', '本溪满族自治县', '210500');
INSERT INTO `apparea` VALUES ('210522', '桓仁满族自治县', '210500');
INSERT INTO `apparea` VALUES ('210602', '元宝区', '210600');
INSERT INTO `apparea` VALUES ('210603', '振兴区', '210600');
INSERT INTO `apparea` VALUES ('210604', '振安区', '210600');
INSERT INTO `apparea` VALUES ('210624', '宽甸满族自治县', '210600');
INSERT INTO `apparea` VALUES ('210681', '东港市', '210600');
INSERT INTO `apparea` VALUES ('210682', '凤城市', '210600');
INSERT INTO `apparea` VALUES ('210702', '古塔区', '210700');
INSERT INTO `apparea` VALUES ('210703', '凌河区', '210700');
INSERT INTO `apparea` VALUES ('210711', '太和区', '210700');
INSERT INTO `apparea` VALUES ('210726', '黑山县', '210700');
INSERT INTO `apparea` VALUES ('210727', '义　县', '210700');
INSERT INTO `apparea` VALUES ('210781', '凌海市', '210700');
INSERT INTO `apparea` VALUES ('210782', '北宁市', '210700');
INSERT INTO `apparea` VALUES ('210802', '站前区', '210800');
INSERT INTO `apparea` VALUES ('210803', '西市区', '210800');
INSERT INTO `apparea` VALUES ('210804', '鲅鱼圈区', '210800');
INSERT INTO `apparea` VALUES ('210811', '老边区', '210800');
INSERT INTO `apparea` VALUES ('210881', '盖州市', '210800');
INSERT INTO `apparea` VALUES ('210882', '大石桥市', '210800');
INSERT INTO `apparea` VALUES ('210902', '海州区', '210900');
INSERT INTO `apparea` VALUES ('210903', '新邱区', '210900');
INSERT INTO `apparea` VALUES ('210904', '太平区', '210900');
INSERT INTO `apparea` VALUES ('210905', '清河门区', '210900');
INSERT INTO `apparea` VALUES ('210911', '细河区', '210900');
INSERT INTO `apparea` VALUES ('210921', '阜新蒙古族自治县', '210900');
INSERT INTO `apparea` VALUES ('210922', '彰武县', '210900');
INSERT INTO `apparea` VALUES ('211002', '白塔区', '211000');
INSERT INTO `apparea` VALUES ('211003', '文圣区', '211000');
INSERT INTO `apparea` VALUES ('211004', '宏伟区', '211000');
INSERT INTO `apparea` VALUES ('211005', '弓长岭区', '211000');
INSERT INTO `apparea` VALUES ('211011', '太子河区', '211000');
INSERT INTO `apparea` VALUES ('211021', '辽阳县', '211000');
INSERT INTO `apparea` VALUES ('211081', '灯塔市', '211000');
INSERT INTO `apparea` VALUES ('211102', '双台子区', '211100');
INSERT INTO `apparea` VALUES ('211103', '兴隆台区', '211100');
INSERT INTO `apparea` VALUES ('211121', '大洼县', '211100');
INSERT INTO `apparea` VALUES ('211122', '盘山县', '211100');
INSERT INTO `apparea` VALUES ('211202', '银州区', '211200');
INSERT INTO `apparea` VALUES ('211204', '清河区', '211200');
INSERT INTO `apparea` VALUES ('211221', '铁岭县', '211200');
INSERT INTO `apparea` VALUES ('211223', '西丰县', '211200');
INSERT INTO `apparea` VALUES ('211224', '昌图县', '211200');
INSERT INTO `apparea` VALUES ('211281', '调兵山市', '211200');
INSERT INTO `apparea` VALUES ('211282', '开原市', '211200');
INSERT INTO `apparea` VALUES ('211302', '双塔区', '211300');
INSERT INTO `apparea` VALUES ('211303', '龙城区', '211300');
INSERT INTO `apparea` VALUES ('211321', '朝阳县', '211300');
INSERT INTO `apparea` VALUES ('211322', '建平县', '211300');
INSERT INTO `apparea` VALUES ('211324', '喀喇沁左翼蒙古族自治县', '211300');
INSERT INTO `apparea` VALUES ('211381', '北票市', '211300');
INSERT INTO `apparea` VALUES ('211382', '凌源市', '211300');
INSERT INTO `apparea` VALUES ('211402', '连山区', '211400');
INSERT INTO `apparea` VALUES ('211403', '龙港区', '211400');
INSERT INTO `apparea` VALUES ('211404', '南票区', '211400');
INSERT INTO `apparea` VALUES ('211421', '绥中县', '211400');
INSERT INTO `apparea` VALUES ('211422', '建昌县', '211400');
INSERT INTO `apparea` VALUES ('211481', '兴城市', '211400');
INSERT INTO `apparea` VALUES ('220102', '南关区', '220100');
INSERT INTO `apparea` VALUES ('220103', '宽城区', '220100');
INSERT INTO `apparea` VALUES ('220104', '朝阳区', '220100');
INSERT INTO `apparea` VALUES ('220105', '二道区', '220100');
INSERT INTO `apparea` VALUES ('220106', '绿园区', '220100');
INSERT INTO `apparea` VALUES ('220112', '双阳区', '220100');
INSERT INTO `apparea` VALUES ('220122', '农安县', '220100');
INSERT INTO `apparea` VALUES ('220181', '九台市', '220100');
INSERT INTO `apparea` VALUES ('220182', '榆树市', '220100');
INSERT INTO `apparea` VALUES ('220183', '德惠市', '220100');
INSERT INTO `apparea` VALUES ('220202', '昌邑区', '220200');
INSERT INTO `apparea` VALUES ('220203', '龙潭区', '220200');
INSERT INTO `apparea` VALUES ('220204', '船营区', '220200');
INSERT INTO `apparea` VALUES ('220211', '丰满区', '220200');
INSERT INTO `apparea` VALUES ('220221', '永吉县', '220200');
INSERT INTO `apparea` VALUES ('220281', '蛟河市', '220200');
INSERT INTO `apparea` VALUES ('220282', '桦甸市', '220200');
INSERT INTO `apparea` VALUES ('220283', '舒兰市', '220200');
INSERT INTO `apparea` VALUES ('220284', '磐石市', '220200');
INSERT INTO `apparea` VALUES ('220302', '铁西区', '220300');
INSERT INTO `apparea` VALUES ('220303', '铁东区', '220300');
INSERT INTO `apparea` VALUES ('220322', '梨树县', '220300');
INSERT INTO `apparea` VALUES ('220323', '伊通满族自治县', '220300');
INSERT INTO `apparea` VALUES ('220381', '公主岭市', '220300');
INSERT INTO `apparea` VALUES ('220382', '双辽市', '220300');
INSERT INTO `apparea` VALUES ('220402', '龙山区', '220400');
INSERT INTO `apparea` VALUES ('220403', '西安区', '220400');
INSERT INTO `apparea` VALUES ('220421', '东丰县', '220400');
INSERT INTO `apparea` VALUES ('220422', '东辽县', '220400');
INSERT INTO `apparea` VALUES ('220502', '东昌区', '220500');
INSERT INTO `apparea` VALUES ('220503', '二道江区', '220500');
INSERT INTO `apparea` VALUES ('220521', '通化县', '220500');
INSERT INTO `apparea` VALUES ('220523', '辉南县', '220500');
INSERT INTO `apparea` VALUES ('220524', '柳河县', '220500');
INSERT INTO `apparea` VALUES ('220581', '梅河口市', '220500');
INSERT INTO `apparea` VALUES ('220582', '集安市', '220500');
INSERT INTO `apparea` VALUES ('220602', '八道江区', '220600');
INSERT INTO `apparea` VALUES ('220621', '抚松县', '220600');
INSERT INTO `apparea` VALUES ('220622', '靖宇县', '220600');
INSERT INTO `apparea` VALUES ('220623', '长白朝鲜族自治县', '220600');
INSERT INTO `apparea` VALUES ('220625', '江源县', '220600');
INSERT INTO `apparea` VALUES ('220681', '临江市', '220600');
INSERT INTO `apparea` VALUES ('220702', '宁江区', '220700');
INSERT INTO `apparea` VALUES ('220721', '前郭尔罗斯蒙古族自治县', '220700');
INSERT INTO `apparea` VALUES ('220722', '长岭县', '220700');
INSERT INTO `apparea` VALUES ('220723', '乾安县', '220700');
INSERT INTO `apparea` VALUES ('220724', '扶余县', '220700');
INSERT INTO `apparea` VALUES ('220802', '洮北区', '220800');
INSERT INTO `apparea` VALUES ('220821', '镇赉县', '220800');
INSERT INTO `apparea` VALUES ('220822', '通榆县', '220800');
INSERT INTO `apparea` VALUES ('220881', '洮南市', '220800');
INSERT INTO `apparea` VALUES ('220882', '大安市', '220800');
INSERT INTO `apparea` VALUES ('222401', '延吉市', '222400');
INSERT INTO `apparea` VALUES ('222402', '图们市', '222400');
INSERT INTO `apparea` VALUES ('222403', '敦化市', '222400');
INSERT INTO `apparea` VALUES ('222404', '珲春市', '222400');
INSERT INTO `apparea` VALUES ('222405', '龙井市', '222400');
INSERT INTO `apparea` VALUES ('222406', '和龙市', '222400');
INSERT INTO `apparea` VALUES ('222424', '汪清县', '222400');
INSERT INTO `apparea` VALUES ('222426', '安图县', '222400');
INSERT INTO `apparea` VALUES ('230102', '道里区', '230100');
INSERT INTO `apparea` VALUES ('230103', '南岗区', '230100');
INSERT INTO `apparea` VALUES ('230104', '道外区', '230100');
INSERT INTO `apparea` VALUES ('230106', '香坊区', '230100');
INSERT INTO `apparea` VALUES ('230107', '动力区', '230100');
INSERT INTO `apparea` VALUES ('230108', '平房区', '230100');
INSERT INTO `apparea` VALUES ('230109', '松北区', '230100');
INSERT INTO `apparea` VALUES ('230111', '呼兰区', '230100');
INSERT INTO `apparea` VALUES ('230123', '依兰县', '230100');
INSERT INTO `apparea` VALUES ('230124', '方正县', '230100');
INSERT INTO `apparea` VALUES ('230125', '宾　县', '230100');
INSERT INTO `apparea` VALUES ('230126', '巴彦县', '230100');
INSERT INTO `apparea` VALUES ('230127', '木兰县', '230100');
INSERT INTO `apparea` VALUES ('230128', '通河县', '230100');
INSERT INTO `apparea` VALUES ('230129', '延寿县', '230100');
INSERT INTO `apparea` VALUES ('230181', '阿城市', '230100');
INSERT INTO `apparea` VALUES ('230182', '双城市', '230100');
INSERT INTO `apparea` VALUES ('230183', '尚志市', '230100');
INSERT INTO `apparea` VALUES ('230184', '五常市', '230100');
INSERT INTO `apparea` VALUES ('230202', '龙沙区', '230200');
INSERT INTO `apparea` VALUES ('230203', '建华区', '230200');
INSERT INTO `apparea` VALUES ('230204', '铁锋区', '230200');
INSERT INTO `apparea` VALUES ('230205', '昂昂溪区', '230200');
INSERT INTO `apparea` VALUES ('230206', '富拉尔基区', '230200');
INSERT INTO `apparea` VALUES ('230207', '碾子山区', '230200');
INSERT INTO `apparea` VALUES ('230208', '梅里斯达斡尔族区', '230200');
INSERT INTO `apparea` VALUES ('230221', '龙江县', '230200');
INSERT INTO `apparea` VALUES ('230223', '依安县', '230200');
INSERT INTO `apparea` VALUES ('230224', '泰来县', '230200');
INSERT INTO `apparea` VALUES ('230225', '甘南县', '230200');
INSERT INTO `apparea` VALUES ('230227', '富裕县', '230200');
INSERT INTO `apparea` VALUES ('230229', '克山县', '230200');
INSERT INTO `apparea` VALUES ('230230', '克东县', '230200');
INSERT INTO `apparea` VALUES ('230231', '拜泉县', '230200');
INSERT INTO `apparea` VALUES ('230281', '讷河市', '230200');
INSERT INTO `apparea` VALUES ('230302', '鸡冠区', '230300');
INSERT INTO `apparea` VALUES ('230303', '恒山区', '230300');
INSERT INTO `apparea` VALUES ('230304', '滴道区', '230300');
INSERT INTO `apparea` VALUES ('230305', '梨树区', '230300');
INSERT INTO `apparea` VALUES ('230306', '城子河区', '230300');
INSERT INTO `apparea` VALUES ('230307', '麻山区', '230300');
INSERT INTO `apparea` VALUES ('230321', '鸡东县', '230300');
INSERT INTO `apparea` VALUES ('230381', '虎林市', '230300');
INSERT INTO `apparea` VALUES ('230382', '密山市', '230300');
INSERT INTO `apparea` VALUES ('230402', '向阳区', '230400');
INSERT INTO `apparea` VALUES ('230403', '工农区', '230400');
INSERT INTO `apparea` VALUES ('230404', '南山区', '230400');
INSERT INTO `apparea` VALUES ('230405', '兴安区', '230400');
INSERT INTO `apparea` VALUES ('230406', '东山区', '230400');
INSERT INTO `apparea` VALUES ('230407', '兴山区', '230400');
INSERT INTO `apparea` VALUES ('230421', '萝北县', '230400');
INSERT INTO `apparea` VALUES ('230422', '绥滨县', '230400');
INSERT INTO `apparea` VALUES ('230502', '尖山区', '230500');
INSERT INTO `apparea` VALUES ('230503', '岭东区', '230500');
INSERT INTO `apparea` VALUES ('230505', '四方台区', '230500');
INSERT INTO `apparea` VALUES ('230506', '宝山区', '230500');
INSERT INTO `apparea` VALUES ('230521', '集贤县', '230500');
INSERT INTO `apparea` VALUES ('230522', '友谊县', '230500');
INSERT INTO `apparea` VALUES ('230523', '宝清县', '230500');
INSERT INTO `apparea` VALUES ('230524', '饶河县', '230500');
INSERT INTO `apparea` VALUES ('230602', '萨尔图区', '230600');
INSERT INTO `apparea` VALUES ('230603', '龙凤区', '230600');
INSERT INTO `apparea` VALUES ('230604', '让胡路区', '230600');
INSERT INTO `apparea` VALUES ('230605', '红岗区', '230600');
INSERT INTO `apparea` VALUES ('230606', '大同区', '230600');
INSERT INTO `apparea` VALUES ('230621', '肇州县', '230600');
INSERT INTO `apparea` VALUES ('230622', '肇源县', '230600');
INSERT INTO `apparea` VALUES ('230623', '林甸县', '230600');
INSERT INTO `apparea` VALUES ('230624', '杜尔伯特蒙古族自治县', '230600');
INSERT INTO `apparea` VALUES ('230702', '伊春区', '230700');
INSERT INTO `apparea` VALUES ('230703', '南岔区', '230700');
INSERT INTO `apparea` VALUES ('230704', '友好区', '230700');
INSERT INTO `apparea` VALUES ('230705', '西林区', '230700');
INSERT INTO `apparea` VALUES ('230706', '翠峦区', '230700');
INSERT INTO `apparea` VALUES ('230707', '新青区', '230700');
INSERT INTO `apparea` VALUES ('230708', '美溪区', '230700');
INSERT INTO `apparea` VALUES ('230709', '金山屯区', '230700');
INSERT INTO `apparea` VALUES ('230710', '五营区', '230700');
INSERT INTO `apparea` VALUES ('230711', '乌马河区', '230700');
INSERT INTO `apparea` VALUES ('230712', '汤旺河区', '230700');
INSERT INTO `apparea` VALUES ('230713', '带岭区', '230700');
INSERT INTO `apparea` VALUES ('230714', '乌伊岭区', '230700');
INSERT INTO `apparea` VALUES ('230715', '红星区', '230700');
INSERT INTO `apparea` VALUES ('230716', '上甘岭区', '230700');
INSERT INTO `apparea` VALUES ('230722', '嘉荫县', '230700');
INSERT INTO `apparea` VALUES ('230781', '铁力市', '230700');
INSERT INTO `apparea` VALUES ('230802', '永红区', '230800');
INSERT INTO `apparea` VALUES ('230803', '向阳区', '230800');
INSERT INTO `apparea` VALUES ('230804', '前进区', '230800');
INSERT INTO `apparea` VALUES ('230805', '东风区', '230800');
INSERT INTO `apparea` VALUES ('230811', '郊　区', '230800');
INSERT INTO `apparea` VALUES ('230822', '桦南县', '230800');
INSERT INTO `apparea` VALUES ('230826', '桦川县', '230800');
INSERT INTO `apparea` VALUES ('230828', '汤原县', '230800');
INSERT INTO `apparea` VALUES ('230833', '抚远县', '230800');
INSERT INTO `apparea` VALUES ('230881', '同江市', '230800');
INSERT INTO `apparea` VALUES ('230882', '富锦市', '230800');
INSERT INTO `apparea` VALUES ('230902', '新兴区', '230900');
INSERT INTO `apparea` VALUES ('230903', '桃山区', '230900');
INSERT INTO `apparea` VALUES ('230904', '茄子河区', '230900');
INSERT INTO `apparea` VALUES ('230921', '勃利县', '230900');
INSERT INTO `apparea` VALUES ('231002', '东安区', '231000');
INSERT INTO `apparea` VALUES ('231003', '阳明区', '231000');
INSERT INTO `apparea` VALUES ('231004', '爱民区', '231000');
INSERT INTO `apparea` VALUES ('231005', '西安区', '231000');
INSERT INTO `apparea` VALUES ('231024', '东宁县', '231000');
INSERT INTO `apparea` VALUES ('231025', '林口县', '231000');
INSERT INTO `apparea` VALUES ('231081', '绥芬河市', '231000');
INSERT INTO `apparea` VALUES ('231083', '海林市', '231000');
INSERT INTO `apparea` VALUES ('231084', '宁安市', '231000');
INSERT INTO `apparea` VALUES ('231085', '穆棱市', '231000');
INSERT INTO `apparea` VALUES ('231102', '爱辉区', '231100');
INSERT INTO `apparea` VALUES ('231121', '嫩江县', '231100');
INSERT INTO `apparea` VALUES ('231123', '逊克县', '231100');
INSERT INTO `apparea` VALUES ('231124', '孙吴县', '231100');
INSERT INTO `apparea` VALUES ('231181', '北安市', '231100');
INSERT INTO `apparea` VALUES ('231182', '五大连池市', '231100');
INSERT INTO `apparea` VALUES ('231202', '北林区', '231200');
INSERT INTO `apparea` VALUES ('231221', '望奎县', '231200');
INSERT INTO `apparea` VALUES ('231222', '兰西县', '231200');
INSERT INTO `apparea` VALUES ('231223', '青冈县', '231200');
INSERT INTO `apparea` VALUES ('231224', '庆安县', '231200');
INSERT INTO `apparea` VALUES ('231225', '明水县', '231200');
INSERT INTO `apparea` VALUES ('231226', '绥棱县', '231200');
INSERT INTO `apparea` VALUES ('231281', '安达市', '231200');
INSERT INTO `apparea` VALUES ('231282', '肇东市', '231200');
INSERT INTO `apparea` VALUES ('231283', '海伦市', '231200');
INSERT INTO `apparea` VALUES ('232721', '呼玛县', '232700');
INSERT INTO `apparea` VALUES ('232722', '塔河县', '232700');
INSERT INTO `apparea` VALUES ('232723', '漠河县', '232700');
INSERT INTO `apparea` VALUES ('310101', '黄浦区', '310100');
INSERT INTO `apparea` VALUES ('310103', '卢湾区', '310100');
INSERT INTO `apparea` VALUES ('310104', '徐汇区', '310100');
INSERT INTO `apparea` VALUES ('310105', '长宁区', '310100');
INSERT INTO `apparea` VALUES ('310106', '静安区', '310100');
INSERT INTO `apparea` VALUES ('310107', '普陀区', '310100');
INSERT INTO `apparea` VALUES ('310108', '闸北区', '310100');
INSERT INTO `apparea` VALUES ('310109', '虹口区', '310100');
INSERT INTO `apparea` VALUES ('310110', '杨浦区', '310100');
INSERT INTO `apparea` VALUES ('310112', '闵行区', '310100');
INSERT INTO `apparea` VALUES ('310113', '宝山区', '310100');
INSERT INTO `apparea` VALUES ('310114', '嘉定区', '310100');
INSERT INTO `apparea` VALUES ('310115', '浦东新区', '310100');
INSERT INTO `apparea` VALUES ('310116', '金山区', '310100');
INSERT INTO `apparea` VALUES ('310117', '松江区', '310100');
INSERT INTO `apparea` VALUES ('310118', '青浦区', '310100');
INSERT INTO `apparea` VALUES ('310119', '南汇区', '310100');
INSERT INTO `apparea` VALUES ('310120', '奉贤区', '310100');
INSERT INTO `apparea` VALUES ('310230', '崇明县', '310200');
INSERT INTO `apparea` VALUES ('320102', '玄武区', '320100');
INSERT INTO `apparea` VALUES ('320103', '白下区', '320100');
INSERT INTO `apparea` VALUES ('320104', '秦淮区', '320100');
INSERT INTO `apparea` VALUES ('320105', '建邺区', '320100');
INSERT INTO `apparea` VALUES ('320106', '鼓楼区', '320100');
INSERT INTO `apparea` VALUES ('320107', '下关区', '320100');
INSERT INTO `apparea` VALUES ('320111', '浦口区', '320100');
INSERT INTO `apparea` VALUES ('320113', '栖霞区', '320100');
INSERT INTO `apparea` VALUES ('320114', '雨花台区', '320100');
INSERT INTO `apparea` VALUES ('320115', '江宁区', '320100');
INSERT INTO `apparea` VALUES ('320116', '六合区', '320100');
INSERT INTO `apparea` VALUES ('320124', '溧水县', '320100');
INSERT INTO `apparea` VALUES ('320125', '高淳县', '320100');
INSERT INTO `apparea` VALUES ('320202', '崇安区', '320200');
INSERT INTO `apparea` VALUES ('320203', '南长区', '320200');
INSERT INTO `apparea` VALUES ('320204', '北塘区', '320200');
INSERT INTO `apparea` VALUES ('320205', '锡山区', '320200');
INSERT INTO `apparea` VALUES ('320206', '惠山区', '320200');
INSERT INTO `apparea` VALUES ('320211', '滨湖区', '320200');
INSERT INTO `apparea` VALUES ('320281', '江阴市', '320200');
INSERT INTO `apparea` VALUES ('320282', '宜兴市', '320200');
INSERT INTO `apparea` VALUES ('320302', '鼓楼区', '320300');
INSERT INTO `apparea` VALUES ('320303', '云龙区', '320300');
INSERT INTO `apparea` VALUES ('320304', '九里区', '320300');
INSERT INTO `apparea` VALUES ('320305', '贾汪区', '320300');
INSERT INTO `apparea` VALUES ('320311', '泉山区', '320300');
INSERT INTO `apparea` VALUES ('320321', '丰　县', '320300');
INSERT INTO `apparea` VALUES ('320322', '沛　县', '320300');
INSERT INTO `apparea` VALUES ('320323', '铜山县', '320300');
INSERT INTO `apparea` VALUES ('320324', '睢宁县', '320300');
INSERT INTO `apparea` VALUES ('320381', '新沂市', '320300');
INSERT INTO `apparea` VALUES ('320382', '邳州市', '320300');
INSERT INTO `apparea` VALUES ('320402', '天宁区', '320400');
INSERT INTO `apparea` VALUES ('320404', '钟楼区', '320400');
INSERT INTO `apparea` VALUES ('320405', '戚墅堰区', '320400');
INSERT INTO `apparea` VALUES ('320411', '新北区', '320400');
INSERT INTO `apparea` VALUES ('320412', '武进区', '320400');
INSERT INTO `apparea` VALUES ('320481', '溧阳市', '320400');
INSERT INTO `apparea` VALUES ('320482', '金坛市', '320400');
INSERT INTO `apparea` VALUES ('320502', '沧浪区', '320500');
INSERT INTO `apparea` VALUES ('320503', '平江区', '320500');
INSERT INTO `apparea` VALUES ('320504', '金阊区', '320500');
INSERT INTO `apparea` VALUES ('320505', '虎丘区', '320500');
INSERT INTO `apparea` VALUES ('320506', '吴中区', '320500');
INSERT INTO `apparea` VALUES ('320507', '相城区', '320500');
INSERT INTO `apparea` VALUES ('320581', '常熟市', '320500');
INSERT INTO `apparea` VALUES ('320582', '张家港市', '320500');
INSERT INTO `apparea` VALUES ('320583', '昆山市', '320500');
INSERT INTO `apparea` VALUES ('320584', '吴江市', '320500');
INSERT INTO `apparea` VALUES ('320585', '太仓市', '320500');
INSERT INTO `apparea` VALUES ('320602', '崇川区', '320600');
INSERT INTO `apparea` VALUES ('320611', '港闸区', '320600');
INSERT INTO `apparea` VALUES ('320621', '海安县', '320600');
INSERT INTO `apparea` VALUES ('320623', '如东县', '320600');
INSERT INTO `apparea` VALUES ('320681', '启东市', '320600');
INSERT INTO `apparea` VALUES ('320682', '如皋市', '320600');
INSERT INTO `apparea` VALUES ('320683', '通州市', '320600');
INSERT INTO `apparea` VALUES ('320684', '海门市', '320600');
INSERT INTO `apparea` VALUES ('320703', '连云区', '320700');
INSERT INTO `apparea` VALUES ('320705', '新浦区', '320700');
INSERT INTO `apparea` VALUES ('320706', '海州区', '320700');
INSERT INTO `apparea` VALUES ('320721', '赣榆县', '320700');
INSERT INTO `apparea` VALUES ('320722', '东海县', '320700');
INSERT INTO `apparea` VALUES ('320723', '灌云县', '320700');
INSERT INTO `apparea` VALUES ('320724', '灌南县', '320700');
INSERT INTO `apparea` VALUES ('320802', '清河区', '320800');
INSERT INTO `apparea` VALUES ('320803', '楚州区', '320800');
INSERT INTO `apparea` VALUES ('320804', '淮阴区', '320800');
INSERT INTO `apparea` VALUES ('320811', '清浦区', '320800');
INSERT INTO `apparea` VALUES ('320826', '涟水县', '320800');
INSERT INTO `apparea` VALUES ('320829', '洪泽县', '320800');
INSERT INTO `apparea` VALUES ('320830', '盱眙县', '320800');
INSERT INTO `apparea` VALUES ('320831', '金湖县', '320800');
INSERT INTO `apparea` VALUES ('320902', '亭湖区', '320900');
INSERT INTO `apparea` VALUES ('320903', '盐都区', '320900');
INSERT INTO `apparea` VALUES ('320921', '响水县', '320900');
INSERT INTO `apparea` VALUES ('320922', '滨海县', '320900');
INSERT INTO `apparea` VALUES ('320923', '阜宁县', '320900');
INSERT INTO `apparea` VALUES ('320924', '射阳县', '320900');
INSERT INTO `apparea` VALUES ('320925', '建湖县', '320900');
INSERT INTO `apparea` VALUES ('320981', '东台市', '320900');
INSERT INTO `apparea` VALUES ('320982', '大丰市', '320900');
INSERT INTO `apparea` VALUES ('321002', '广陵区', '321000');
INSERT INTO `apparea` VALUES ('321003', '邗江区', '321000');
INSERT INTO `apparea` VALUES ('321011', '郊　区', '321000');
INSERT INTO `apparea` VALUES ('321023', '宝应县', '321000');
INSERT INTO `apparea` VALUES ('321081', '仪征市', '321000');
INSERT INTO `apparea` VALUES ('321084', '高邮市', '321000');
INSERT INTO `apparea` VALUES ('321088', '江都市', '321000');
INSERT INTO `apparea` VALUES ('321102', '京口区', '321100');
INSERT INTO `apparea` VALUES ('321111', '润州区', '321100');
INSERT INTO `apparea` VALUES ('321112', '丹徒区', '321100');
INSERT INTO `apparea` VALUES ('321181', '丹阳市', '321100');
INSERT INTO `apparea` VALUES ('321182', '扬中市', '321100');
INSERT INTO `apparea` VALUES ('321183', '句容市', '321100');
INSERT INTO `apparea` VALUES ('321202', '海陵区', '321200');
INSERT INTO `apparea` VALUES ('321203', '高港区', '321200');
INSERT INTO `apparea` VALUES ('321281', '兴化市', '321200');
INSERT INTO `apparea` VALUES ('321282', '靖江市', '321200');
INSERT INTO `apparea` VALUES ('321283', '泰兴市', '321200');
INSERT INTO `apparea` VALUES ('321284', '姜堰市', '321200');
INSERT INTO `apparea` VALUES ('321302', '宿城区', '321300');
INSERT INTO `apparea` VALUES ('321311', '宿豫区', '321300');
INSERT INTO `apparea` VALUES ('321322', '沭阳县', '321300');
INSERT INTO `apparea` VALUES ('321323', '泗阳县', '321300');
INSERT INTO `apparea` VALUES ('321324', '泗洪县', '321300');
INSERT INTO `apparea` VALUES ('330102', '上城区', '330100');
INSERT INTO `apparea` VALUES ('330103', '下城区', '330100');
INSERT INTO `apparea` VALUES ('330104', '江干区', '330100');
INSERT INTO `apparea` VALUES ('330105', '拱墅区', '330100');
INSERT INTO `apparea` VALUES ('330106', '西湖区', '330100');
INSERT INTO `apparea` VALUES ('330108', '滨江区', '330100');
INSERT INTO `apparea` VALUES ('330109', '萧山区', '330100');
INSERT INTO `apparea` VALUES ('330110', '余杭区', '330100');
INSERT INTO `apparea` VALUES ('330122', '桐庐县', '330100');
INSERT INTO `apparea` VALUES ('330127', '淳安县', '330100');
INSERT INTO `apparea` VALUES ('330182', '建德市', '330100');
INSERT INTO `apparea` VALUES ('330183', '富阳市', '330100');
INSERT INTO `apparea` VALUES ('330185', '临安市', '330100');
INSERT INTO `apparea` VALUES ('330203', '海曙区', '330200');
INSERT INTO `apparea` VALUES ('330204', '江东区', '330200');
INSERT INTO `apparea` VALUES ('330205', '江北区', '330200');
INSERT INTO `apparea` VALUES ('330206', '北仑区', '330200');
INSERT INTO `apparea` VALUES ('330211', '镇海区', '330200');
INSERT INTO `apparea` VALUES ('330212', '鄞州区', '330200');
INSERT INTO `apparea` VALUES ('330225', '象山县', '330200');
INSERT INTO `apparea` VALUES ('330226', '宁海县', '330200');
INSERT INTO `apparea` VALUES ('330281', '余姚市', '330200');
INSERT INTO `apparea` VALUES ('330282', '慈溪市', '330200');
INSERT INTO `apparea` VALUES ('330283', '奉化市', '330200');
INSERT INTO `apparea` VALUES ('330302', '鹿城区', '330300');
INSERT INTO `apparea` VALUES ('330303', '龙湾区', '330300');
INSERT INTO `apparea` VALUES ('330304', '瓯海区', '330300');
INSERT INTO `apparea` VALUES ('330322', '洞头县', '330300');
INSERT INTO `apparea` VALUES ('330324', '永嘉县', '330300');
INSERT INTO `apparea` VALUES ('330326', '平阳县', '330300');
INSERT INTO `apparea` VALUES ('330327', '苍南县', '330300');
INSERT INTO `apparea` VALUES ('330328', '文成县', '330300');
INSERT INTO `apparea` VALUES ('330329', '泰顺县', '330300');
INSERT INTO `apparea` VALUES ('330381', '瑞安市', '330300');
INSERT INTO `apparea` VALUES ('330382', '乐清市', '330300');
INSERT INTO `apparea` VALUES ('330402', '秀城区', '330400');
INSERT INTO `apparea` VALUES ('330411', '秀洲区', '330400');
INSERT INTO `apparea` VALUES ('330421', '嘉善县', '330400');
INSERT INTO `apparea` VALUES ('330424', '海盐县', '330400');
INSERT INTO `apparea` VALUES ('330481', '海宁市', '330400');
INSERT INTO `apparea` VALUES ('330482', '平湖市', '330400');
INSERT INTO `apparea` VALUES ('330483', '桐乡市', '330400');
INSERT INTO `apparea` VALUES ('330502', '吴兴区', '330500');
INSERT INTO `apparea` VALUES ('330503', '南浔区', '330500');
INSERT INTO `apparea` VALUES ('330521', '德清县', '330500');
INSERT INTO `apparea` VALUES ('330522', '长兴县', '330500');
INSERT INTO `apparea` VALUES ('330523', '安吉县', '330500');
INSERT INTO `apparea` VALUES ('330602', '越城区', '330600');
INSERT INTO `apparea` VALUES ('330621', '绍兴县', '330600');
INSERT INTO `apparea` VALUES ('330624', '新昌县', '330600');
INSERT INTO `apparea` VALUES ('330681', '诸暨市', '330600');
INSERT INTO `apparea` VALUES ('330682', '上虞市', '330600');
INSERT INTO `apparea` VALUES ('330683', '嵊州市', '330600');
INSERT INTO `apparea` VALUES ('330702', '婺城区', '330700');
INSERT INTO `apparea` VALUES ('330703', '金东区', '330700');
INSERT INTO `apparea` VALUES ('330723', '武义县', '330700');
INSERT INTO `apparea` VALUES ('330726', '浦江县', '330700');
INSERT INTO `apparea` VALUES ('330727', '磐安县', '330700');
INSERT INTO `apparea` VALUES ('330781', '兰溪市', '330700');
INSERT INTO `apparea` VALUES ('330782', '义乌市', '330700');
INSERT INTO `apparea` VALUES ('330783', '东阳市', '330700');
INSERT INTO `apparea` VALUES ('330784', '永康市', '330700');
INSERT INTO `apparea` VALUES ('330802', '柯城区', '330800');
INSERT INTO `apparea` VALUES ('330803', '衢江区', '330800');
INSERT INTO `apparea` VALUES ('330822', '常山县', '330800');
INSERT INTO `apparea` VALUES ('330824', '开化县', '330800');
INSERT INTO `apparea` VALUES ('330825', '龙游县', '330800');
INSERT INTO `apparea` VALUES ('330881', '江山市', '330800');
INSERT INTO `apparea` VALUES ('330902', '定海区', '330900');
INSERT INTO `apparea` VALUES ('330903', '普陀区', '330900');
INSERT INTO `apparea` VALUES ('330921', '岱山县', '330900');
INSERT INTO `apparea` VALUES ('330922', '嵊泗县', '330900');
INSERT INTO `apparea` VALUES ('331002', '椒江区', '331000');
INSERT INTO `apparea` VALUES ('331003', '黄岩区', '331000');
INSERT INTO `apparea` VALUES ('331004', '路桥区', '331000');
INSERT INTO `apparea` VALUES ('331021', '玉环县', '331000');
INSERT INTO `apparea` VALUES ('331022', '三门县', '331000');
INSERT INTO `apparea` VALUES ('331023', '天台县', '331000');
INSERT INTO `apparea` VALUES ('331024', '仙居县', '331000');
INSERT INTO `apparea` VALUES ('331081', '温岭市', '331000');
INSERT INTO `apparea` VALUES ('331082', '临海市', '331000');
INSERT INTO `apparea` VALUES ('331102', '莲都区', '331100');
INSERT INTO `apparea` VALUES ('331121', '青田县', '331100');
INSERT INTO `apparea` VALUES ('331122', '缙云县', '331100');
INSERT INTO `apparea` VALUES ('331123', '遂昌县', '331100');
INSERT INTO `apparea` VALUES ('331124', '松阳县', '331100');
INSERT INTO `apparea` VALUES ('331125', '云和县', '331100');
INSERT INTO `apparea` VALUES ('331126', '庆元县', '331100');
INSERT INTO `apparea` VALUES ('331127', '景宁畲族自治县', '331100');
INSERT INTO `apparea` VALUES ('331181', '龙泉市', '331100');
INSERT INTO `apparea` VALUES ('340102', '瑶海区', '340100');
INSERT INTO `apparea` VALUES ('340103', '庐阳区', '340100');
INSERT INTO `apparea` VALUES ('340104', '蜀山区', '340100');
INSERT INTO `apparea` VALUES ('340111', '包河区', '340100');
INSERT INTO `apparea` VALUES ('340121', '长丰县', '340100');
INSERT INTO `apparea` VALUES ('340122', '肥东县', '340100');
INSERT INTO `apparea` VALUES ('340123', '肥西县', '340100');
INSERT INTO `apparea` VALUES ('340202', '镜湖区', '340200');
INSERT INTO `apparea` VALUES ('340203', '马塘区', '340200');
INSERT INTO `apparea` VALUES ('340204', '新芜区', '340200');
INSERT INTO `apparea` VALUES ('340207', '鸠江区', '340200');
INSERT INTO `apparea` VALUES ('340221', '芜湖县', '340200');
INSERT INTO `apparea` VALUES ('340222', '繁昌县', '340200');
INSERT INTO `apparea` VALUES ('340223', '南陵县', '340200');
INSERT INTO `apparea` VALUES ('340302', '龙子湖区', '340300');
INSERT INTO `apparea` VALUES ('340303', '蚌山区', '340300');
INSERT INTO `apparea` VALUES ('340304', '禹会区', '340300');
INSERT INTO `apparea` VALUES ('340311', '淮上区', '340300');
INSERT INTO `apparea` VALUES ('340321', '怀远县', '340300');
INSERT INTO `apparea` VALUES ('340322', '五河县', '340300');
INSERT INTO `apparea` VALUES ('340323', '固镇县', '340300');
INSERT INTO `apparea` VALUES ('340402', '大通区', '340400');
INSERT INTO `apparea` VALUES ('340403', '田家庵区', '340400');
INSERT INTO `apparea` VALUES ('340404', '谢家集区', '340400');
INSERT INTO `apparea` VALUES ('340405', '八公山区', '340400');
INSERT INTO `apparea` VALUES ('340406', '潘集区', '340400');
INSERT INTO `apparea` VALUES ('340421', '凤台县', '340400');
INSERT INTO `apparea` VALUES ('340502', '金家庄区', '340500');
INSERT INTO `apparea` VALUES ('340503', '花山区', '340500');
INSERT INTO `apparea` VALUES ('340504', '雨山区', '340500');
INSERT INTO `apparea` VALUES ('340521', '当涂县', '340500');
INSERT INTO `apparea` VALUES ('340602', '杜集区', '340600');
INSERT INTO `apparea` VALUES ('340603', '相山区', '340600');
INSERT INTO `apparea` VALUES ('340604', '烈山区', '340600');
INSERT INTO `apparea` VALUES ('340621', '濉溪县', '340600');
INSERT INTO `apparea` VALUES ('340702', '铜官山区', '340700');
INSERT INTO `apparea` VALUES ('340703', '狮子山区', '340700');
INSERT INTO `apparea` VALUES ('340711', '郊　区', '340700');
INSERT INTO `apparea` VALUES ('340721', '铜陵县', '340700');
INSERT INTO `apparea` VALUES ('340802', '迎江区', '340800');
INSERT INTO `apparea` VALUES ('340803', '大观区', '340800');
INSERT INTO `apparea` VALUES ('340811', '郊　区', '340800');
INSERT INTO `apparea` VALUES ('340822', '怀宁县', '340800');
INSERT INTO `apparea` VALUES ('340823', '枞阳县', '340800');
INSERT INTO `apparea` VALUES ('340824', '潜山县', '340800');
INSERT INTO `apparea` VALUES ('340825', '太湖县', '340800');
INSERT INTO `apparea` VALUES ('340826', '宿松县', '340800');
INSERT INTO `apparea` VALUES ('340827', '望江县', '340800');
INSERT INTO `apparea` VALUES ('340828', '岳西县', '340800');
INSERT INTO `apparea` VALUES ('340881', '桐城市', '340800');
INSERT INTO `apparea` VALUES ('341002', '屯溪区', '341000');
INSERT INTO `apparea` VALUES ('341003', '黄山区', '341000');
INSERT INTO `apparea` VALUES ('341004', '徽州区', '341000');
INSERT INTO `apparea` VALUES ('341021', '歙　县', '341000');
INSERT INTO `apparea` VALUES ('341022', '休宁县', '341000');
INSERT INTO `apparea` VALUES ('341023', '黟　县', '341000');
INSERT INTO `apparea` VALUES ('341024', '祁门县', '341000');
INSERT INTO `apparea` VALUES ('341102', '琅琊区', '341100');
INSERT INTO `apparea` VALUES ('341103', '南谯区', '341100');
INSERT INTO `apparea` VALUES ('341122', '来安县', '341100');
INSERT INTO `apparea` VALUES ('341124', '全椒县', '341100');
INSERT INTO `apparea` VALUES ('341125', '定远县', '341100');
INSERT INTO `apparea` VALUES ('341126', '凤阳县', '341100');
INSERT INTO `apparea` VALUES ('341181', '天长市', '341100');
INSERT INTO `apparea` VALUES ('341182', '明光市', '341100');
INSERT INTO `apparea` VALUES ('341202', '颍州区', '341200');
INSERT INTO `apparea` VALUES ('341203', '颍东区', '341200');
INSERT INTO `apparea` VALUES ('341204', '颍泉区', '341200');
INSERT INTO `apparea` VALUES ('341221', '临泉县', '341200');
INSERT INTO `apparea` VALUES ('341222', '太和县', '341200');
INSERT INTO `apparea` VALUES ('341225', '阜南县', '341200');
INSERT INTO `apparea` VALUES ('341226', '颍上县', '341200');
INSERT INTO `apparea` VALUES ('341282', '界首市', '341200');
INSERT INTO `apparea` VALUES ('341302', '墉桥区', '341300');
INSERT INTO `apparea` VALUES ('341321', '砀山县', '341300');
INSERT INTO `apparea` VALUES ('341322', '萧　县', '341300');
INSERT INTO `apparea` VALUES ('341323', '灵璧县', '341300');
INSERT INTO `apparea` VALUES ('341324', '泗　县', '341300');
INSERT INTO `apparea` VALUES ('341402', '居巢区', '341400');
INSERT INTO `apparea` VALUES ('341421', '庐江县', '341400');
INSERT INTO `apparea` VALUES ('341422', '无为县', '341400');
INSERT INTO `apparea` VALUES ('341423', '含山县', '341400');
INSERT INTO `apparea` VALUES ('341424', '和　县', '341400');
INSERT INTO `apparea` VALUES ('341502', '金安区', '341500');
INSERT INTO `apparea` VALUES ('341503', '裕安区', '341500');
INSERT INTO `apparea` VALUES ('341521', '寿　县', '341500');
INSERT INTO `apparea` VALUES ('341522', '霍邱县', '341500');
INSERT INTO `apparea` VALUES ('341523', '舒城县', '341500');
INSERT INTO `apparea` VALUES ('341524', '金寨县', '341500');
INSERT INTO `apparea` VALUES ('341525', '霍山县', '341500');
INSERT INTO `apparea` VALUES ('341602', '谯城区', '341600');
INSERT INTO `apparea` VALUES ('341621', '涡阳县', '341600');
INSERT INTO `apparea` VALUES ('341622', '蒙城县', '341600');
INSERT INTO `apparea` VALUES ('341623', '利辛县', '341600');
INSERT INTO `apparea` VALUES ('341702', '贵池区', '341700');
INSERT INTO `apparea` VALUES ('341721', '东至县', '341700');
INSERT INTO `apparea` VALUES ('341722', '石台县', '341700');
INSERT INTO `apparea` VALUES ('341723', '青阳县', '341700');
INSERT INTO `apparea` VALUES ('341802', '宣州区', '341800');
INSERT INTO `apparea` VALUES ('341821', '郎溪县', '341800');
INSERT INTO `apparea` VALUES ('341822', '广德县', '341800');
INSERT INTO `apparea` VALUES ('341823', '泾　县', '341800');
INSERT INTO `apparea` VALUES ('341824', '绩溪县', '341800');
INSERT INTO `apparea` VALUES ('341825', '旌德县', '341800');
INSERT INTO `apparea` VALUES ('341881', '宁国市', '341800');
INSERT INTO `apparea` VALUES ('350102', '鼓楼区', '350100');
INSERT INTO `apparea` VALUES ('350103', '台江区', '350100');
INSERT INTO `apparea` VALUES ('350104', '仓山区', '350100');
INSERT INTO `apparea` VALUES ('350105', '马尾区', '350100');
INSERT INTO `apparea` VALUES ('350111', '晋安区', '350100');
INSERT INTO `apparea` VALUES ('350121', '闽侯县', '350100');
INSERT INTO `apparea` VALUES ('350122', '连江县', '350100');
INSERT INTO `apparea` VALUES ('350123', '罗源县', '350100');
INSERT INTO `apparea` VALUES ('350124', '闽清县', '350100');
INSERT INTO `apparea` VALUES ('350125', '永泰县', '350100');
INSERT INTO `apparea` VALUES ('350128', '平潭县', '350100');
INSERT INTO `apparea` VALUES ('350181', '福清市', '350100');
INSERT INTO `apparea` VALUES ('350182', '长乐市', '350100');
INSERT INTO `apparea` VALUES ('350203', '思明区', '350200');
INSERT INTO `apparea` VALUES ('350205', '海沧区', '350200');
INSERT INTO `apparea` VALUES ('350206', '湖里区', '350200');
INSERT INTO `apparea` VALUES ('350211', '集美区', '350200');
INSERT INTO `apparea` VALUES ('350212', '同安区', '350200');
INSERT INTO `apparea` VALUES ('350213', '翔安区', '350200');
INSERT INTO `apparea` VALUES ('350302', '城厢区', '350300');
INSERT INTO `apparea` VALUES ('350303', '涵江区', '350300');
INSERT INTO `apparea` VALUES ('350304', '荔城区', '350300');
INSERT INTO `apparea` VALUES ('350305', '秀屿区', '350300');
INSERT INTO `apparea` VALUES ('350322', '仙游县', '350300');
INSERT INTO `apparea` VALUES ('350402', '梅列区', '350400');
INSERT INTO `apparea` VALUES ('350403', '三元区', '350400');
INSERT INTO `apparea` VALUES ('350421', '明溪县', '350400');
INSERT INTO `apparea` VALUES ('350423', '清流县', '350400');
INSERT INTO `apparea` VALUES ('350424', '宁化县', '350400');
INSERT INTO `apparea` VALUES ('350425', '大田县', '350400');
INSERT INTO `apparea` VALUES ('350426', '尤溪县', '350400');
INSERT INTO `apparea` VALUES ('350427', '沙　县', '350400');
INSERT INTO `apparea` VALUES ('350428', '将乐县', '350400');
INSERT INTO `apparea` VALUES ('350429', '泰宁县', '350400');
INSERT INTO `apparea` VALUES ('350430', '建宁县', '350400');
INSERT INTO `apparea` VALUES ('350481', '永安市', '350400');
INSERT INTO `apparea` VALUES ('350502', '鲤城区', '350500');
INSERT INTO `apparea` VALUES ('350503', '丰泽区', '350500');
INSERT INTO `apparea` VALUES ('350504', '洛江区', '350500');
INSERT INTO `apparea` VALUES ('350505', '泉港区', '350500');
INSERT INTO `apparea` VALUES ('350521', '惠安县', '350500');
INSERT INTO `apparea` VALUES ('350524', '安溪县', '350500');
INSERT INTO `apparea` VALUES ('350525', '永春县', '350500');
INSERT INTO `apparea` VALUES ('350526', '德化县', '350500');
INSERT INTO `apparea` VALUES ('350527', '金门县', '350500');
INSERT INTO `apparea` VALUES ('350581', '石狮市', '350500');
INSERT INTO `apparea` VALUES ('350582', '晋江市', '350500');
INSERT INTO `apparea` VALUES ('350583', '南安市', '350500');
INSERT INTO `apparea` VALUES ('350602', '芗城区', '350600');
INSERT INTO `apparea` VALUES ('350603', '龙文区', '350600');
INSERT INTO `apparea` VALUES ('350622', '云霄县', '350600');
INSERT INTO `apparea` VALUES ('350623', '漳浦县', '350600');
INSERT INTO `apparea` VALUES ('350624', '诏安县', '350600');
INSERT INTO `apparea` VALUES ('350625', '长泰县', '350600');
INSERT INTO `apparea` VALUES ('350626', '东山县', '350600');
INSERT INTO `apparea` VALUES ('350627', '南靖县', '350600');
INSERT INTO `apparea` VALUES ('350628', '平和县', '350600');
INSERT INTO `apparea` VALUES ('350629', '华安县', '350600');
INSERT INTO `apparea` VALUES ('350681', '龙海市', '350600');
INSERT INTO `apparea` VALUES ('350702', '延平区', '350700');
INSERT INTO `apparea` VALUES ('350721', '顺昌县', '350700');
INSERT INTO `apparea` VALUES ('350722', '浦城县', '350700');
INSERT INTO `apparea` VALUES ('350723', '光泽县', '350700');
INSERT INTO `apparea` VALUES ('350724', '松溪县', '350700');
INSERT INTO `apparea` VALUES ('350725', '政和县', '350700');
INSERT INTO `apparea` VALUES ('350781', '邵武市', '350700');
INSERT INTO `apparea` VALUES ('350782', '武夷山市', '350700');
INSERT INTO `apparea` VALUES ('350783', '建瓯市', '350700');
INSERT INTO `apparea` VALUES ('350784', '建阳市', '350700');
INSERT INTO `apparea` VALUES ('350802', '新罗区', '350800');
INSERT INTO `apparea` VALUES ('350821', '长汀县', '350800');
INSERT INTO `apparea` VALUES ('350822', '永定县', '350800');
INSERT INTO `apparea` VALUES ('350823', '上杭县', '350800');
INSERT INTO `apparea` VALUES ('350824', '武平县', '350800');
INSERT INTO `apparea` VALUES ('350825', '连城县', '350800');
INSERT INTO `apparea` VALUES ('350881', '漳平市', '350800');
INSERT INTO `apparea` VALUES ('350902', '蕉城区', '350900');
INSERT INTO `apparea` VALUES ('350921', '霞浦县', '350900');
INSERT INTO `apparea` VALUES ('350922', '古田县', '350900');
INSERT INTO `apparea` VALUES ('350923', '屏南县', '350900');
INSERT INTO `apparea` VALUES ('350924', '寿宁县', '350900');
INSERT INTO `apparea` VALUES ('350925', '周宁县', '350900');
INSERT INTO `apparea` VALUES ('350926', '柘荣县', '350900');
INSERT INTO `apparea` VALUES ('350981', '福安市', '350900');
INSERT INTO `apparea` VALUES ('350982', '福鼎市', '350900');
INSERT INTO `apparea` VALUES ('360102', '东湖区', '360100');
INSERT INTO `apparea` VALUES ('360103', '西湖区', '360100');
INSERT INTO `apparea` VALUES ('360104', '青云谱区', '360100');
INSERT INTO `apparea` VALUES ('360105', '湾里区', '360100');
INSERT INTO `apparea` VALUES ('360111', '青山湖区', '360100');
INSERT INTO `apparea` VALUES ('360121', '南昌县', '360100');
INSERT INTO `apparea` VALUES ('360122', '新建县', '360100');
INSERT INTO `apparea` VALUES ('360123', '安义县', '360100');
INSERT INTO `apparea` VALUES ('360124', '进贤县', '360100');
INSERT INTO `apparea` VALUES ('360202', '昌江区', '360200');
INSERT INTO `apparea` VALUES ('360203', '珠山区', '360200');
INSERT INTO `apparea` VALUES ('360222', '浮梁县', '360200');
INSERT INTO `apparea` VALUES ('360281', '乐平市', '360200');
INSERT INTO `apparea` VALUES ('360302', '安源区', '360300');
INSERT INTO `apparea` VALUES ('360313', '湘东区', '360300');
INSERT INTO `apparea` VALUES ('360321', '莲花县', '360300');
INSERT INTO `apparea` VALUES ('360322', '上栗县', '360300');
INSERT INTO `apparea` VALUES ('360323', '芦溪县', '360300');
INSERT INTO `apparea` VALUES ('360402', '庐山区', '360400');
INSERT INTO `apparea` VALUES ('360403', '浔阳区', '360400');
INSERT INTO `apparea` VALUES ('360421', '九江县', '360400');
INSERT INTO `apparea` VALUES ('360423', '武宁县', '360400');
INSERT INTO `apparea` VALUES ('360424', '修水县', '360400');
INSERT INTO `apparea` VALUES ('360425', '永修县', '360400');
INSERT INTO `apparea` VALUES ('360426', '德安县', '360400');
INSERT INTO `apparea` VALUES ('360427', '星子县', '360400');
INSERT INTO `apparea` VALUES ('360428', '都昌县', '360400');
INSERT INTO `apparea` VALUES ('360429', '湖口县', '360400');
INSERT INTO `apparea` VALUES ('360430', '彭泽县', '360400');
INSERT INTO `apparea` VALUES ('360481', '瑞昌市', '360400');
INSERT INTO `apparea` VALUES ('360502', '渝水区', '360500');
INSERT INTO `apparea` VALUES ('360521', '分宜县', '360500');
INSERT INTO `apparea` VALUES ('360602', '月湖区', '360600');
INSERT INTO `apparea` VALUES ('360622', '余江县', '360600');
INSERT INTO `apparea` VALUES ('360681', '贵溪市', '360600');
INSERT INTO `apparea` VALUES ('360702', '章贡区', '360700');
INSERT INTO `apparea` VALUES ('360721', '赣　县', '360700');
INSERT INTO `apparea` VALUES ('360722', '信丰县', '360700');
INSERT INTO `apparea` VALUES ('360723', '大余县', '360700');
INSERT INTO `apparea` VALUES ('360724', '上犹县', '360700');
INSERT INTO `apparea` VALUES ('360725', '崇义县', '360700');
INSERT INTO `apparea` VALUES ('360726', '安远县', '360700');
INSERT INTO `apparea` VALUES ('360727', '龙南县', '360700');
INSERT INTO `apparea` VALUES ('360728', '定南县', '360700');
INSERT INTO `apparea` VALUES ('360729', '全南县', '360700');
INSERT INTO `apparea` VALUES ('360730', '宁都县', '360700');
INSERT INTO `apparea` VALUES ('360731', '于都县', '360700');
INSERT INTO `apparea` VALUES ('360732', '兴国县', '360700');
INSERT INTO `apparea` VALUES ('360733', '会昌县', '360700');
INSERT INTO `apparea` VALUES ('360734', '寻乌县', '360700');
INSERT INTO `apparea` VALUES ('360735', '石城县', '360700');
INSERT INTO `apparea` VALUES ('360781', '瑞金市', '360700');
INSERT INTO `apparea` VALUES ('360782', '南康市', '360700');
INSERT INTO `apparea` VALUES ('360802', '吉州区', '360800');
INSERT INTO `apparea` VALUES ('360803', '青原区', '360800');
INSERT INTO `apparea` VALUES ('360821', '吉安县', '360800');
INSERT INTO `apparea` VALUES ('360822', '吉水县', '360800');
INSERT INTO `apparea` VALUES ('360823', '峡江县', '360800');
INSERT INTO `apparea` VALUES ('360824', '新干县', '360800');
INSERT INTO `apparea` VALUES ('360825', '永丰县', '360800');
INSERT INTO `apparea` VALUES ('360826', '泰和县', '360800');
INSERT INTO `apparea` VALUES ('360827', '遂川县', '360800');
INSERT INTO `apparea` VALUES ('360828', '万安县', '360800');
INSERT INTO `apparea` VALUES ('360829', '安福县', '360800');
INSERT INTO `apparea` VALUES ('360830', '永新县', '360800');
INSERT INTO `apparea` VALUES ('360881', '井冈山市', '360800');
INSERT INTO `apparea` VALUES ('360902', '袁州区', '360900');
INSERT INTO `apparea` VALUES ('360921', '奉新县', '360900');
INSERT INTO `apparea` VALUES ('360922', '万载县', '360900');
INSERT INTO `apparea` VALUES ('360923', '上高县', '360900');
INSERT INTO `apparea` VALUES ('360924', '宜丰县', '360900');
INSERT INTO `apparea` VALUES ('360925', '靖安县', '360900');
INSERT INTO `apparea` VALUES ('360926', '铜鼓县', '360900');
INSERT INTO `apparea` VALUES ('360981', '丰城市', '360900');
INSERT INTO `apparea` VALUES ('360982', '樟树市', '360900');
INSERT INTO `apparea` VALUES ('360983', '高安市', '360900');
INSERT INTO `apparea` VALUES ('361002', '临川区', '361000');
INSERT INTO `apparea` VALUES ('361021', '南城县', '361000');
INSERT INTO `apparea` VALUES ('361022', '黎川县', '361000');
INSERT INTO `apparea` VALUES ('361023', '南丰县', '361000');
INSERT INTO `apparea` VALUES ('361024', '崇仁县', '361000');
INSERT INTO `apparea` VALUES ('361025', '乐安县', '361000');
INSERT INTO `apparea` VALUES ('361026', '宜黄县', '361000');
INSERT INTO `apparea` VALUES ('361027', '金溪县', '361000');
INSERT INTO `apparea` VALUES ('361028', '资溪县', '361000');
INSERT INTO `apparea` VALUES ('361029', '东乡县', '361000');
INSERT INTO `apparea` VALUES ('361030', '广昌县', '361000');
INSERT INTO `apparea` VALUES ('361102', '信州区', '361100');
INSERT INTO `apparea` VALUES ('361121', '上饶县', '361100');
INSERT INTO `apparea` VALUES ('361122', '广丰县', '361100');
INSERT INTO `apparea` VALUES ('361123', '玉山县', '361100');
INSERT INTO `apparea` VALUES ('361124', '铅山县', '361100');
INSERT INTO `apparea` VALUES ('361125', '横峰县', '361100');
INSERT INTO `apparea` VALUES ('361126', '弋阳县', '361100');
INSERT INTO `apparea` VALUES ('361127', '余干县', '361100');
INSERT INTO `apparea` VALUES ('361128', '鄱阳县', '361100');
INSERT INTO `apparea` VALUES ('361129', '万年县', '361100');
INSERT INTO `apparea` VALUES ('361130', '婺源县', '361100');
INSERT INTO `apparea` VALUES ('361181', '德兴市', '361100');
INSERT INTO `apparea` VALUES ('370102', '历下区', '370100');
INSERT INTO `apparea` VALUES ('370103', '市中区', '370100');
INSERT INTO `apparea` VALUES ('370104', '槐荫区', '370100');
INSERT INTO `apparea` VALUES ('370105', '天桥区', '370100');
INSERT INTO `apparea` VALUES ('370112', '历城区', '370100');
INSERT INTO `apparea` VALUES ('370113', '长清区', '370100');
INSERT INTO `apparea` VALUES ('370124', '平阴县', '370100');
INSERT INTO `apparea` VALUES ('370125', '济阳县', '370100');
INSERT INTO `apparea` VALUES ('370126', '商河县', '370100');
INSERT INTO `apparea` VALUES ('370181', '章丘市', '370100');
INSERT INTO `apparea` VALUES ('370202', '市南区', '370200');
INSERT INTO `apparea` VALUES ('370203', '市北区', '370200');
INSERT INTO `apparea` VALUES ('370205', '四方区', '370200');
INSERT INTO `apparea` VALUES ('370211', '黄岛区', '370200');
INSERT INTO `apparea` VALUES ('370212', '崂山区', '370200');
INSERT INTO `apparea` VALUES ('370213', '李沧区', '370200');
INSERT INTO `apparea` VALUES ('370214', '城阳区', '370200');
INSERT INTO `apparea` VALUES ('370281', '胶州市', '370200');
INSERT INTO `apparea` VALUES ('370282', '即墨市', '370200');
INSERT INTO `apparea` VALUES ('370283', '平度市', '370200');
INSERT INTO `apparea` VALUES ('370284', '胶南市', '370200');
INSERT INTO `apparea` VALUES ('370285', '莱西市', '370200');
INSERT INTO `apparea` VALUES ('370302', '淄川区', '370300');
INSERT INTO `apparea` VALUES ('370303', '张店区', '370300');
INSERT INTO `apparea` VALUES ('370304', '博山区', '370300');
INSERT INTO `apparea` VALUES ('370305', '临淄区', '370300');
INSERT INTO `apparea` VALUES ('370306', '周村区', '370300');
INSERT INTO `apparea` VALUES ('370321', '桓台县', '370300');
INSERT INTO `apparea` VALUES ('370322', '高青县', '370300');
INSERT INTO `apparea` VALUES ('370323', '沂源县', '370300');
INSERT INTO `apparea` VALUES ('370402', '市中区', '370400');
INSERT INTO `apparea` VALUES ('370403', '薛城区', '370400');
INSERT INTO `apparea` VALUES ('370404', '峄城区', '370400');
INSERT INTO `apparea` VALUES ('370405', '台儿庄区', '370400');
INSERT INTO `apparea` VALUES ('370406', '山亭区', '370400');
INSERT INTO `apparea` VALUES ('370481', '滕州市', '370400');
INSERT INTO `apparea` VALUES ('370502', '东营区', '370500');
INSERT INTO `apparea` VALUES ('370503', '河口区', '370500');
INSERT INTO `apparea` VALUES ('370521', '垦利县', '370500');
INSERT INTO `apparea` VALUES ('370522', '利津县', '370500');
INSERT INTO `apparea` VALUES ('370523', '广饶县', '370500');
INSERT INTO `apparea` VALUES ('370602', '芝罘区', '370600');
INSERT INTO `apparea` VALUES ('370611', '福山区', '370600');
INSERT INTO `apparea` VALUES ('370612', '牟平区', '370600');
INSERT INTO `apparea` VALUES ('370613', '莱山区', '370600');
INSERT INTO `apparea` VALUES ('370634', '长岛县', '370600');
INSERT INTO `apparea` VALUES ('370681', '龙口市', '370600');
INSERT INTO `apparea` VALUES ('370682', '莱阳市', '370600');
INSERT INTO `apparea` VALUES ('370683', '莱州市', '370600');
INSERT INTO `apparea` VALUES ('370684', '蓬莱市', '370600');
INSERT INTO `apparea` VALUES ('370685', '招远市', '370600');
INSERT INTO `apparea` VALUES ('370686', '栖霞市', '370600');
INSERT INTO `apparea` VALUES ('370687', '海阳市', '370600');
INSERT INTO `apparea` VALUES ('370702', '潍城区', '370700');
INSERT INTO `apparea` VALUES ('370703', '寒亭区', '370700');
INSERT INTO `apparea` VALUES ('370704', '坊子区', '370700');
INSERT INTO `apparea` VALUES ('370705', '奎文区', '370700');
INSERT INTO `apparea` VALUES ('370724', '临朐县', '370700');
INSERT INTO `apparea` VALUES ('370725', '昌乐县', '370700');
INSERT INTO `apparea` VALUES ('370781', '青州市', '370700');
INSERT INTO `apparea` VALUES ('370782', '诸城市', '370700');
INSERT INTO `apparea` VALUES ('370783', '寿光市', '370700');
INSERT INTO `apparea` VALUES ('370784', '安丘市', '370700');
INSERT INTO `apparea` VALUES ('370785', '高密市', '370700');
INSERT INTO `apparea` VALUES ('370786', '昌邑市', '370700');
INSERT INTO `apparea` VALUES ('370802', '市中区', '370800');
INSERT INTO `apparea` VALUES ('370811', '任城区', '370800');
INSERT INTO `apparea` VALUES ('370826', '微山县', '370800');
INSERT INTO `apparea` VALUES ('370827', '鱼台县', '370800');
INSERT INTO `apparea` VALUES ('370828', '金乡县', '370800');
INSERT INTO `apparea` VALUES ('370829', '嘉祥县', '370800');
INSERT INTO `apparea` VALUES ('370830', '汶上县', '370800');
INSERT INTO `apparea` VALUES ('370831', '泗水县', '370800');
INSERT INTO `apparea` VALUES ('370832', '梁山县', '370800');
INSERT INTO `apparea` VALUES ('370881', '曲阜市', '370800');
INSERT INTO `apparea` VALUES ('370882', '兖州市', '370800');
INSERT INTO `apparea` VALUES ('370883', '邹城市', '370800');
INSERT INTO `apparea` VALUES ('370902', '泰山区', '370900');
INSERT INTO `apparea` VALUES ('370903', '岱岳区', '370900');
INSERT INTO `apparea` VALUES ('370921', '宁阳县', '370900');
INSERT INTO `apparea` VALUES ('370923', '东平县', '370900');
INSERT INTO `apparea` VALUES ('370982', '新泰市', '370900');
INSERT INTO `apparea` VALUES ('370983', '肥城市', '370900');
INSERT INTO `apparea` VALUES ('371002', '环翠区', '371000');
INSERT INTO `apparea` VALUES ('371081', '文登市', '371000');
INSERT INTO `apparea` VALUES ('371082', '荣成市', '371000');
INSERT INTO `apparea` VALUES ('371083', '乳山市', '371000');
INSERT INTO `apparea` VALUES ('371102', '东港区', '371100');
INSERT INTO `apparea` VALUES ('371103', '岚山区', '371100');
INSERT INTO `apparea` VALUES ('371121', '五莲县', '371100');
INSERT INTO `apparea` VALUES ('371122', '莒　县', '371100');
INSERT INTO `apparea` VALUES ('371202', '莱城区', '371200');
INSERT INTO `apparea` VALUES ('371203', '钢城区', '371200');
INSERT INTO `apparea` VALUES ('371302', '兰山区', '371300');
INSERT INTO `apparea` VALUES ('371311', '罗庄区', '371300');
INSERT INTO `apparea` VALUES ('371312', '河东区', '371300');
INSERT INTO `apparea` VALUES ('371321', '沂南县', '371300');
INSERT INTO `apparea` VALUES ('371322', '郯城县', '371300');
INSERT INTO `apparea` VALUES ('371323', '沂水县', '371300');
INSERT INTO `apparea` VALUES ('371324', '苍山县', '371300');
INSERT INTO `apparea` VALUES ('371325', '费　县', '371300');
INSERT INTO `apparea` VALUES ('371326', '平邑县', '371300');
INSERT INTO `apparea` VALUES ('371327', '莒南县', '371300');
INSERT INTO `apparea` VALUES ('371328', '蒙阴县', '371300');
INSERT INTO `apparea` VALUES ('371329', '临沭县', '371300');
INSERT INTO `apparea` VALUES ('371402', '德城区', '371400');
INSERT INTO `apparea` VALUES ('371421', '陵　县', '371400');
INSERT INTO `apparea` VALUES ('371422', '宁津县', '371400');
INSERT INTO `apparea` VALUES ('371423', '庆云县', '371400');
INSERT INTO `apparea` VALUES ('371424', '临邑县', '371400');
INSERT INTO `apparea` VALUES ('371425', '齐河县', '371400');
INSERT INTO `apparea` VALUES ('371426', '平原县', '371400');
INSERT INTO `apparea` VALUES ('371427', '夏津县', '371400');
INSERT INTO `apparea` VALUES ('371428', '武城县', '371400');
INSERT INTO `apparea` VALUES ('371481', '乐陵市', '371400');
INSERT INTO `apparea` VALUES ('371482', '禹城市', '371400');
INSERT INTO `apparea` VALUES ('371502', '东昌府区', '371500');
INSERT INTO `apparea` VALUES ('371521', '阳谷县', '371500');
INSERT INTO `apparea` VALUES ('371522', '莘　县', '371500');
INSERT INTO `apparea` VALUES ('371523', '茌平县', '371500');
INSERT INTO `apparea` VALUES ('371524', '东阿县', '371500');
INSERT INTO `apparea` VALUES ('371525', '冠　县', '371500');
INSERT INTO `apparea` VALUES ('371526', '高唐县', '371500');
INSERT INTO `apparea` VALUES ('371581', '临清市', '371500');
INSERT INTO `apparea` VALUES ('371602', '滨城区', '371600');
INSERT INTO `apparea` VALUES ('371621', '惠民县', '371600');
INSERT INTO `apparea` VALUES ('371622', '阳信县', '371600');
INSERT INTO `apparea` VALUES ('371623', '无棣县', '371600');
INSERT INTO `apparea` VALUES ('371624', '沾化县', '371600');
INSERT INTO `apparea` VALUES ('371625', '博兴县', '371600');
INSERT INTO `apparea` VALUES ('371626', '邹平县', '371600');
INSERT INTO `apparea` VALUES ('371702', '牡丹区', '371700');
INSERT INTO `apparea` VALUES ('371721', '曹　县', '371700');
INSERT INTO `apparea` VALUES ('371722', '单　县', '371700');
INSERT INTO `apparea` VALUES ('371723', '成武县', '371700');
INSERT INTO `apparea` VALUES ('371724', '巨野县', '371700');
INSERT INTO `apparea` VALUES ('371725', '郓城县', '371700');
INSERT INTO `apparea` VALUES ('371726', '鄄城县', '371700');
INSERT INTO `apparea` VALUES ('371727', '定陶县', '371700');
INSERT INTO `apparea` VALUES ('371728', '东明县', '371700');
INSERT INTO `apparea` VALUES ('410102', '中原区', '410100');
INSERT INTO `apparea` VALUES ('410103', '二七区', '410100');
INSERT INTO `apparea` VALUES ('410104', '管城回族区', '410100');
INSERT INTO `apparea` VALUES ('410105', '金水区', '410100');
INSERT INTO `apparea` VALUES ('410106', '上街区', '410100');
INSERT INTO `apparea` VALUES ('410108', '邙山区', '410100');
INSERT INTO `apparea` VALUES ('410122', '中牟县', '410100');
INSERT INTO `apparea` VALUES ('410181', '巩义市', '410100');
INSERT INTO `apparea` VALUES ('410182', '荥阳市', '410100');
INSERT INTO `apparea` VALUES ('410183', '新密市', '410100');
INSERT INTO `apparea` VALUES ('410184', '新郑市', '410100');
INSERT INTO `apparea` VALUES ('410185', '登封市', '410100');
INSERT INTO `apparea` VALUES ('410202', '龙亭区', '410200');
INSERT INTO `apparea` VALUES ('410203', '顺河回族区', '410200');
INSERT INTO `apparea` VALUES ('410204', '鼓楼区', '410200');
INSERT INTO `apparea` VALUES ('410205', '南关区', '410200');
INSERT INTO `apparea` VALUES ('410211', '郊　区', '410200');
INSERT INTO `apparea` VALUES ('410221', '杞　县', '410200');
INSERT INTO `apparea` VALUES ('410222', '通许县', '410200');
INSERT INTO `apparea` VALUES ('410223', '尉氏县', '410200');
INSERT INTO `apparea` VALUES ('410224', '开封县', '410200');
INSERT INTO `apparea` VALUES ('410225', '兰考县', '410200');
INSERT INTO `apparea` VALUES ('410302', '老城区', '410300');
INSERT INTO `apparea` VALUES ('410303', '西工区', '410300');
INSERT INTO `apparea` VALUES ('410304', '廛河回族区', '410300');
INSERT INTO `apparea` VALUES ('410305', '涧西区', '410300');
INSERT INTO `apparea` VALUES ('410306', '吉利区', '410300');
INSERT INTO `apparea` VALUES ('410307', '洛龙区', '410300');
INSERT INTO `apparea` VALUES ('410322', '孟津县', '410300');
INSERT INTO `apparea` VALUES ('410323', '新安县', '410300');
INSERT INTO `apparea` VALUES ('410324', '栾川县', '410300');
INSERT INTO `apparea` VALUES ('410325', '嵩　县', '410300');
INSERT INTO `apparea` VALUES ('410326', '汝阳县', '410300');
INSERT INTO `apparea` VALUES ('410327', '宜阳县', '410300');
INSERT INTO `apparea` VALUES ('410328', ';洛宁县', '410300');
INSERT INTO `apparea` VALUES ('410329', '伊川县', '410300');
INSERT INTO `apparea` VALUES ('410381', '偃师市', '410300');
INSERT INTO `apparea` VALUES ('410402', '新华区', '410400');
INSERT INTO `apparea` VALUES ('410403', '卫东区', '410400');
INSERT INTO `apparea` VALUES ('410404', '石龙区', '410400');
INSERT INTO `apparea` VALUES ('410411', '湛河区', '410400');
INSERT INTO `apparea` VALUES ('410421', '宝丰县', '410400');
INSERT INTO `apparea` VALUES ('410422', '叶　县', '410400');
INSERT INTO `apparea` VALUES ('410423', '鲁山县', '410400');
INSERT INTO `apparea` VALUES ('410425', '郏　县', '410400');
INSERT INTO `apparea` VALUES ('410481', '舞钢市', '410400');
INSERT INTO `apparea` VALUES ('410482', '汝州市', '410400');
INSERT INTO `apparea` VALUES ('410502', '文峰区', '410500');
INSERT INTO `apparea` VALUES ('410503', '北关区', '410500');
INSERT INTO `apparea` VALUES ('410505', '殷都区', '410500');
INSERT INTO `apparea` VALUES ('410506', '龙安区', '410500');
INSERT INTO `apparea` VALUES ('410522', '安阳县', '410500');
INSERT INTO `apparea` VALUES ('410523', '汤阴县', '410500');
INSERT INTO `apparea` VALUES ('410526', '滑　县', '410500');
INSERT INTO `apparea` VALUES ('410527', '内黄县', '410500');
INSERT INTO `apparea` VALUES ('410581', '林州市', '410500');
INSERT INTO `apparea` VALUES ('410602', '鹤山区', '410600');
INSERT INTO `apparea` VALUES ('410603', '山城区', '410600');
INSERT INTO `apparea` VALUES ('410611', '淇滨区', '410600');
INSERT INTO `apparea` VALUES ('410621', '浚　县', '410600');
INSERT INTO `apparea` VALUES ('410622', '淇　县', '410600');
INSERT INTO `apparea` VALUES ('410702', '红旗区', '410700');
INSERT INTO `apparea` VALUES ('410703', '卫滨区', '410700');
INSERT INTO `apparea` VALUES ('410704', '凤泉区', '410700');
INSERT INTO `apparea` VALUES ('410711', '牧野区', '410700');
INSERT INTO `apparea` VALUES ('410721', '新乡县', '410700');
INSERT INTO `apparea` VALUES ('410724', '获嘉县', '410700');
INSERT INTO `apparea` VALUES ('410725', '原阳县', '410700');
INSERT INTO `apparea` VALUES ('410726', '延津县', '410700');
INSERT INTO `apparea` VALUES ('410727', '封丘县', '410700');
INSERT INTO `apparea` VALUES ('410728', '长垣县', '410700');
INSERT INTO `apparea` VALUES ('410781', '卫辉市', '410700');
INSERT INTO `apparea` VALUES ('410782', '辉县市', '410700');
INSERT INTO `apparea` VALUES ('410802', '解放区', '410800');
INSERT INTO `apparea` VALUES ('410803', '中站区', '410800');
INSERT INTO `apparea` VALUES ('410804', '马村区', '410800');
INSERT INTO `apparea` VALUES ('410811', '山阳区', '410800');
INSERT INTO `apparea` VALUES ('410821', '修武县', '410800');
INSERT INTO `apparea` VALUES ('410822', '博爱县', '410800');
INSERT INTO `apparea` VALUES ('410823', '武陟县', '410800');
INSERT INTO `apparea` VALUES ('410825', '温　县', '410800');
INSERT INTO `apparea` VALUES ('410881', '济源市', '410800');
INSERT INTO `apparea` VALUES ('410882', '沁阳市', '410800');
INSERT INTO `apparea` VALUES ('410883', '孟州市', '410800');
INSERT INTO `apparea` VALUES ('410902', '华龙区', '410900');
INSERT INTO `apparea` VALUES ('410922', '清丰县', '410900');
INSERT INTO `apparea` VALUES ('410923', '南乐县', '410900');
INSERT INTO `apparea` VALUES ('410926', '范　县', '410900');
INSERT INTO `apparea` VALUES ('410927', '台前县', '410900');
INSERT INTO `apparea` VALUES ('410928', '濮阳县', '410900');
INSERT INTO `apparea` VALUES ('411002', '魏都区', '411000');
INSERT INTO `apparea` VALUES ('411023', '许昌县', '411000');
INSERT INTO `apparea` VALUES ('411024', '鄢陵县', '411000');
INSERT INTO `apparea` VALUES ('411025', '襄城县', '411000');
INSERT INTO `apparea` VALUES ('411081', '禹州市', '411000');
INSERT INTO `apparea` VALUES ('411082', '长葛市', '411000');
INSERT INTO `apparea` VALUES ('411102', '源汇区', '411100');
INSERT INTO `apparea` VALUES ('411103', '郾城区', '411100');
INSERT INTO `apparea` VALUES ('411104', '召陵区', '411100');
INSERT INTO `apparea` VALUES ('411121', '舞阳县', '411100');
INSERT INTO `apparea` VALUES ('411122', '临颍县', '411100');
INSERT INTO `apparea` VALUES ('411202', '湖滨区', '411200');
INSERT INTO `apparea` VALUES ('411221', '渑池县', '411200');
INSERT INTO `apparea` VALUES ('411222', '陕　县', '411200');
INSERT INTO `apparea` VALUES ('411224', '卢氏县', '411200');
INSERT INTO `apparea` VALUES ('411281', '义马市', '411200');
INSERT INTO `apparea` VALUES ('411282', '灵宝市', '411200');
INSERT INTO `apparea` VALUES ('411302', '宛城区', '411300');
INSERT INTO `apparea` VALUES ('411303', '卧龙区', '411300');
INSERT INTO `apparea` VALUES ('411321', '南召县', '411300');
INSERT INTO `apparea` VALUES ('411322', '方城县', '411300');
INSERT INTO `apparea` VALUES ('411323', '西峡县', '411300');
INSERT INTO `apparea` VALUES ('411324', '镇平县', '411300');
INSERT INTO `apparea` VALUES ('411325', '内乡县', '411300');
INSERT INTO `apparea` VALUES ('411326', '淅川县', '411300');
INSERT INTO `apparea` VALUES ('411327', '社旗县', '411300');
INSERT INTO `apparea` VALUES ('411328', '唐河县', '411300');
INSERT INTO `apparea` VALUES ('411329', '新野县', '411300');
INSERT INTO `apparea` VALUES ('411330', '桐柏县', '411300');
INSERT INTO `apparea` VALUES ('411381', '邓州市', '411300');
INSERT INTO `apparea` VALUES ('411402', '梁园区', '411400');
INSERT INTO `apparea` VALUES ('411403', '睢阳区', '411400');
INSERT INTO `apparea` VALUES ('411421', '民权县', '411400');
INSERT INTO `apparea` VALUES ('411422', '睢　县', '411400');
INSERT INTO `apparea` VALUES ('411423', '宁陵县', '411400');
INSERT INTO `apparea` VALUES ('411424', '柘城县', '411400');
INSERT INTO `apparea` VALUES ('411425', '虞城县', '411400');
INSERT INTO `apparea` VALUES ('411426', '夏邑县', '411400');
INSERT INTO `apparea` VALUES ('411481', '永城市', '411400');
INSERT INTO `apparea` VALUES ('411502', '师河区', '411500');
INSERT INTO `apparea` VALUES ('411503', '平桥区', '411500');
INSERT INTO `apparea` VALUES ('411521', '罗山县', '411500');
INSERT INTO `apparea` VALUES ('411522', '光山县', '411500');
INSERT INTO `apparea` VALUES ('411523', '新　县', '411500');
INSERT INTO `apparea` VALUES ('411524', '商城县', '411500');
INSERT INTO `apparea` VALUES ('411525', '固始县', '411500');
INSERT INTO `apparea` VALUES ('411526', '潢川县', '411500');
INSERT INTO `apparea` VALUES ('411527', '淮滨县', '411500');
INSERT INTO `apparea` VALUES ('411528', '息　县', '411500');
INSERT INTO `apparea` VALUES ('411602', '川汇区', '411600');
INSERT INTO `apparea` VALUES ('411621', '扶沟县', '411600');
INSERT INTO `apparea` VALUES ('411622', '西华县', '411600');
INSERT INTO `apparea` VALUES ('411623', '商水县', '411600');
INSERT INTO `apparea` VALUES ('411624', '沈丘县', '411600');
INSERT INTO `apparea` VALUES ('411625', '郸城县', '411600');
INSERT INTO `apparea` VALUES ('411626', '淮阳县', '411600');
INSERT INTO `apparea` VALUES ('411627', '太康县', '411600');
INSERT INTO `apparea` VALUES ('411628', '鹿邑县', '411600');
INSERT INTO `apparea` VALUES ('411681', '项城市', '411600');
INSERT INTO `apparea` VALUES ('411702', '驿城区', '411700');
INSERT INTO `apparea` VALUES ('411721', '西平县', '411700');
INSERT INTO `apparea` VALUES ('411722', '上蔡县', '411700');
INSERT INTO `apparea` VALUES ('411723', '平舆县', '411700');
INSERT INTO `apparea` VALUES ('411724', '正阳县', '411700');
INSERT INTO `apparea` VALUES ('411725', '确山县', '411700');
INSERT INTO `apparea` VALUES ('411726', '泌阳县', '411700');
INSERT INTO `apparea` VALUES ('411727', '汝南县', '411700');
INSERT INTO `apparea` VALUES ('411728', '遂平县', '411700');
INSERT INTO `apparea` VALUES ('411729', '新蔡县', '411700');
INSERT INTO `apparea` VALUES ('420102', '江岸区', '420100');
INSERT INTO `apparea` VALUES ('420103', '江汉区', '420100');
INSERT INTO `apparea` VALUES ('420104', '乔口区', '420100');
INSERT INTO `apparea` VALUES ('420105', '汉阳区', '420100');
INSERT INTO `apparea` VALUES ('420106', '武昌区', '420100');
INSERT INTO `apparea` VALUES ('420107', '青山区', '420100');
INSERT INTO `apparea` VALUES ('420111', '洪山区', '420100');
INSERT INTO `apparea` VALUES ('420112', '东西湖区', '420100');
INSERT INTO `apparea` VALUES ('420113', '汉南区', '420100');
INSERT INTO `apparea` VALUES ('420114', '蔡甸区', '420100');
INSERT INTO `apparea` VALUES ('420115', '江夏区', '420100');
INSERT INTO `apparea` VALUES ('420116', '黄陂区', '420100');
INSERT INTO `apparea` VALUES ('420117', '新洲区', '420100');
INSERT INTO `apparea` VALUES ('420202', '黄石港区', '420200');
INSERT INTO `apparea` VALUES ('420203', '西塞山区', '420200');
INSERT INTO `apparea` VALUES ('420204', '下陆区', '420200');
INSERT INTO `apparea` VALUES ('420205', '铁山区', '420200');
INSERT INTO `apparea` VALUES ('420222', '阳新县', '420200');
INSERT INTO `apparea` VALUES ('420281', '大冶市', '420200');
INSERT INTO `apparea` VALUES ('420302', '茅箭区', '420300');
INSERT INTO `apparea` VALUES ('420303', '张湾区', '420300');
INSERT INTO `apparea` VALUES ('420321', '郧　县', '420300');
INSERT INTO `apparea` VALUES ('420322', '郧西县', '420300');
INSERT INTO `apparea` VALUES ('420323', '竹山县', '420300');
INSERT INTO `apparea` VALUES ('420324', '竹溪县', '420300');
INSERT INTO `apparea` VALUES ('420325', '房　县', '420300');
INSERT INTO `apparea` VALUES ('420381', '丹江口市', '420300');
INSERT INTO `apparea` VALUES ('420502', '西陵区', '420500');
INSERT INTO `apparea` VALUES ('420503', '伍家岗区', '420500');
INSERT INTO `apparea` VALUES ('420504', '点军区', '420500');
INSERT INTO `apparea` VALUES ('420505', '猇亭区', '420500');
INSERT INTO `apparea` VALUES ('420506', '夷陵区', '420500');
INSERT INTO `apparea` VALUES ('420525', '远安县', '420500');
INSERT INTO `apparea` VALUES ('420526', '兴山县', '420500');
INSERT INTO `apparea` VALUES ('420527', '秭归县', '420500');
INSERT INTO `apparea` VALUES ('420528', '长阳土家族自治县', '420500');
INSERT INTO `apparea` VALUES ('420529', '五峰土家族自治县', '420500');
INSERT INTO `apparea` VALUES ('420581', '宜都市', '420500');
INSERT INTO `apparea` VALUES ('420582', '当阳市', '420500');
INSERT INTO `apparea` VALUES ('420583', '枝江市', '420500');
INSERT INTO `apparea` VALUES ('420602', '襄城区', '420600');
INSERT INTO `apparea` VALUES ('420606', '樊城区', '420600');
INSERT INTO `apparea` VALUES ('420607', '襄阳区', '420600');
INSERT INTO `apparea` VALUES ('420624', '南漳县', '420600');
INSERT INTO `apparea` VALUES ('420625', '谷城县', '420600');
INSERT INTO `apparea` VALUES ('420626', '保康县', '420600');
INSERT INTO `apparea` VALUES ('420682', '老河口市', '420600');
INSERT INTO `apparea` VALUES ('420683', '枣阳市', '420600');
INSERT INTO `apparea` VALUES ('420684', '宜城市', '420600');
INSERT INTO `apparea` VALUES ('420702', '梁子湖区', '420700');
INSERT INTO `apparea` VALUES ('420703', '华容区', '420700');
INSERT INTO `apparea` VALUES ('420704', '鄂城区', '420700');
INSERT INTO `apparea` VALUES ('420802', '东宝区', '420800');
INSERT INTO `apparea` VALUES ('420804', '掇刀区', '420800');
INSERT INTO `apparea` VALUES ('420821', '京山县', '420800');
INSERT INTO `apparea` VALUES ('420822', '沙洋县', '420800');
INSERT INTO `apparea` VALUES ('420881', '钟祥市', '420800');
INSERT INTO `apparea` VALUES ('420902', '孝南区', '420900');
INSERT INTO `apparea` VALUES ('420921', '孝昌县', '420900');
INSERT INTO `apparea` VALUES ('420922', '大悟县', '420900');
INSERT INTO `apparea` VALUES ('420923', '云梦县', '420900');
INSERT INTO `apparea` VALUES ('420981', '应城市', '420900');
INSERT INTO `apparea` VALUES ('420982', '安陆市', '420900');
INSERT INTO `apparea` VALUES ('420984', '汉川市', '420900');
INSERT INTO `apparea` VALUES ('421002', '沙市区', '421000');
INSERT INTO `apparea` VALUES ('421003', '荆州区', '421000');
INSERT INTO `apparea` VALUES ('421022', '公安县', '421000');
INSERT INTO `apparea` VALUES ('421023', '监利县', '421000');
INSERT INTO `apparea` VALUES ('421024', '江陵县', '421000');
INSERT INTO `apparea` VALUES ('421081', '石首市', '421000');
INSERT INTO `apparea` VALUES ('421083', '洪湖市', '421000');
INSERT INTO `apparea` VALUES ('421087', '松滋市', '421000');
INSERT INTO `apparea` VALUES ('421102', '黄州区', '421100');
INSERT INTO `apparea` VALUES ('421121', '团风县', '421100');
INSERT INTO `apparea` VALUES ('421122', '红安县', '421100');
INSERT INTO `apparea` VALUES ('421123', '罗田县', '421100');
INSERT INTO `apparea` VALUES ('421124', '英山县', '421100');
INSERT INTO `apparea` VALUES ('421125', '浠水县', '421100');
INSERT INTO `apparea` VALUES ('421126', '蕲春县', '421100');
INSERT INTO `apparea` VALUES ('421127', '黄梅县', '421100');
INSERT INTO `apparea` VALUES ('421181', '麻城市', '421100');
INSERT INTO `apparea` VALUES ('421182', '武穴市', '421100');
INSERT INTO `apparea` VALUES ('421202', '咸安区', '421200');
INSERT INTO `apparea` VALUES ('421221', '嘉鱼县', '421200');
INSERT INTO `apparea` VALUES ('421222', '通城县', '421200');
INSERT INTO `apparea` VALUES ('421223', '崇阳县', '421200');
INSERT INTO `apparea` VALUES ('421224', '通山县', '421200');
INSERT INTO `apparea` VALUES ('421281', '赤壁市', '421200');
INSERT INTO `apparea` VALUES ('421302', '曾都区', '421300');
INSERT INTO `apparea` VALUES ('421381', '广水市', '421300');
INSERT INTO `apparea` VALUES ('422801', '恩施市', '422800');
INSERT INTO `apparea` VALUES ('422802', '利川市', '422800');
INSERT INTO `apparea` VALUES ('422822', '建始县', '422800');
INSERT INTO `apparea` VALUES ('422823', '巴东县', '422800');
INSERT INTO `apparea` VALUES ('422825', '宣恩县', '422800');
INSERT INTO `apparea` VALUES ('422826', '咸丰县', '422800');
INSERT INTO `apparea` VALUES ('422827', '来凤县', '422800');
INSERT INTO `apparea` VALUES ('422828', '鹤峰县', '422800');
INSERT INTO `apparea` VALUES ('429004', '仙桃市', '429000');
INSERT INTO `apparea` VALUES ('429005', '潜江市', '429000');
INSERT INTO `apparea` VALUES ('429006', '天门市', '429000');
INSERT INTO `apparea` VALUES ('429021', '神农架林区', '429000');
INSERT INTO `apparea` VALUES ('430102', '芙蓉区', '430100');
INSERT INTO `apparea` VALUES ('430103', '天心区', '430100');
INSERT INTO `apparea` VALUES ('430104', '岳麓区', '430100');
INSERT INTO `apparea` VALUES ('430105', '开福区', '430100');
INSERT INTO `apparea` VALUES ('430111', '雨花区', '430100');
INSERT INTO `apparea` VALUES ('430121', '长沙县', '430100');
INSERT INTO `apparea` VALUES ('430122', '望城县', '430100');
INSERT INTO `apparea` VALUES ('430124', '宁乡县', '430100');
INSERT INTO `apparea` VALUES ('430181', '浏阳市', '430100');
INSERT INTO `apparea` VALUES ('430202', '荷塘区', '430200');
INSERT INTO `apparea` VALUES ('430203', '芦淞区', '430200');
INSERT INTO `apparea` VALUES ('430204', '石峰区', '430200');
INSERT INTO `apparea` VALUES ('430211', '天元区', '430200');
INSERT INTO `apparea` VALUES ('430221', '株洲县', '430200');
INSERT INTO `apparea` VALUES ('430223', '攸　县', '430200');
INSERT INTO `apparea` VALUES ('430224', '茶陵县', '430200');
INSERT INTO `apparea` VALUES ('430225', '炎陵县', '430200');
INSERT INTO `apparea` VALUES ('430281', '醴陵市', '430200');
INSERT INTO `apparea` VALUES ('430302', '雨湖区', '430300');
INSERT INTO `apparea` VALUES ('430304', '岳塘区', '430300');
INSERT INTO `apparea` VALUES ('430321', '湘潭县', '430300');
INSERT INTO `apparea` VALUES ('430381', '湘乡市', '430300');
INSERT INTO `apparea` VALUES ('430382', '韶山市', '430300');
INSERT INTO `apparea` VALUES ('430405', '珠晖区', '430400');
INSERT INTO `apparea` VALUES ('430406', '雁峰区', '430400');
INSERT INTO `apparea` VALUES ('430407', '石鼓区', '430400');
INSERT INTO `apparea` VALUES ('430408', '蒸湘区', '430400');
INSERT INTO `apparea` VALUES ('430412', '南岳区', '430400');
INSERT INTO `apparea` VALUES ('430421', '衡阳县', '430400');
INSERT INTO `apparea` VALUES ('430422', '衡南县', '430400');
INSERT INTO `apparea` VALUES ('430423', '衡山县', '430400');
INSERT INTO `apparea` VALUES ('430424', '衡东县', '430400');
INSERT INTO `apparea` VALUES ('430426', '祁东县', '430400');
INSERT INTO `apparea` VALUES ('430481', '耒阳市', '430400');
INSERT INTO `apparea` VALUES ('430482', '常宁市', '430400');
INSERT INTO `apparea` VALUES ('430502', '双清区', '430500');
INSERT INTO `apparea` VALUES ('430503', '大祥区', '430500');
INSERT INTO `apparea` VALUES ('430511', '北塔区', '430500');
INSERT INTO `apparea` VALUES ('430521', '邵东县', '430500');
INSERT INTO `apparea` VALUES ('430522', '新邵县', '430500');
INSERT INTO `apparea` VALUES ('430523', '邵阳县', '430500');
INSERT INTO `apparea` VALUES ('430524', '隆回县', '430500');
INSERT INTO `apparea` VALUES ('430525', '洞口县', '430500');
INSERT INTO `apparea` VALUES ('430527', '绥宁县', '430500');
INSERT INTO `apparea` VALUES ('430528', '新宁县', '430500');
INSERT INTO `apparea` VALUES ('430529', '城步苗族自治县', '430500');
INSERT INTO `apparea` VALUES ('430581', '武冈市', '430500');
INSERT INTO `apparea` VALUES ('430602', '岳阳楼区', '430600');
INSERT INTO `apparea` VALUES ('430603', '云溪区', '430600');
INSERT INTO `apparea` VALUES ('430611', '君山区', '430600');
INSERT INTO `apparea` VALUES ('430621', '岳阳县', '430600');
INSERT INTO `apparea` VALUES ('430623', '华容县', '430600');
INSERT INTO `apparea` VALUES ('430624', '湘阴县', '430600');
INSERT INTO `apparea` VALUES ('430626', '平江县', '430600');
INSERT INTO `apparea` VALUES ('430681', '汨罗市', '430600');
INSERT INTO `apparea` VALUES ('430682', '临湘市', '430600');
INSERT INTO `apparea` VALUES ('430702', '武陵区', '430700');
INSERT INTO `apparea` VALUES ('430703', '鼎城区', '430700');
INSERT INTO `apparea` VALUES ('430721', '安乡县', '430700');
INSERT INTO `apparea` VALUES ('430722', '汉寿县', '430700');
INSERT INTO `apparea` VALUES ('430723', '澧　县', '430700');
INSERT INTO `apparea` VALUES ('430724', '临澧县', '430700');
INSERT INTO `apparea` VALUES ('430725', '桃源县', '430700');
INSERT INTO `apparea` VALUES ('430726', '石门县', '430700');
INSERT INTO `apparea` VALUES ('430781', '津市市', '430700');
INSERT INTO `apparea` VALUES ('430802', '永定区', '430800');
INSERT INTO `apparea` VALUES ('430811', '武陵源区', '430800');
INSERT INTO `apparea` VALUES ('430821', '慈利县', '430800');
INSERT INTO `apparea` VALUES ('430822', '桑植县', '430800');
INSERT INTO `apparea` VALUES ('430902', '资阳区', '430900');
INSERT INTO `apparea` VALUES ('430903', '赫山区', '430900');
INSERT INTO `apparea` VALUES ('430921', '南　县', '430900');
INSERT INTO `apparea` VALUES ('430922', '桃江县', '430900');
INSERT INTO `apparea` VALUES ('430923', '安化县', '430900');
INSERT INTO `apparea` VALUES ('430981', '沅江市', '430900');
INSERT INTO `apparea` VALUES ('431002', '北湖区', '431000');
INSERT INTO `apparea` VALUES ('431003', '苏仙区', '431000');
INSERT INTO `apparea` VALUES ('431021', '桂阳县', '431000');
INSERT INTO `apparea` VALUES ('431022', '宜章县', '431000');
INSERT INTO `apparea` VALUES ('431023', '永兴县', '431000');
INSERT INTO `apparea` VALUES ('431024', '嘉禾县', '431000');
INSERT INTO `apparea` VALUES ('431025', '临武县', '431000');
INSERT INTO `apparea` VALUES ('431026', '汝城县', '431000');
INSERT INTO `apparea` VALUES ('431027', '桂东县', '431000');
INSERT INTO `apparea` VALUES ('431028', '安仁县', '431000');
INSERT INTO `apparea` VALUES ('431081', '资兴市', '431000');
INSERT INTO `apparea` VALUES ('431102', '芝山区', '431100');
INSERT INTO `apparea` VALUES ('431103', '冷水滩区', '431100');
INSERT INTO `apparea` VALUES ('431121', '祁阳县', '431100');
INSERT INTO `apparea` VALUES ('431122', '东安县', '431100');
INSERT INTO `apparea` VALUES ('431123', '双牌县', '431100');
INSERT INTO `apparea` VALUES ('431124', '道　县', '431100');
INSERT INTO `apparea` VALUES ('431125', '江永县', '431100');
INSERT INTO `apparea` VALUES ('431126', '宁远县', '431100');
INSERT INTO `apparea` VALUES ('431127', '蓝山县', '431100');
INSERT INTO `apparea` VALUES ('431128', '新田县', '431100');
INSERT INTO `apparea` VALUES ('431129', '江华瑶族自治县', '431100');
INSERT INTO `apparea` VALUES ('431202', '鹤城区', '431200');
INSERT INTO `apparea` VALUES ('431221', '中方县', '431200');
INSERT INTO `apparea` VALUES ('431222', '沅陵县', '431200');
INSERT INTO `apparea` VALUES ('431223', '辰溪县', '431200');
INSERT INTO `apparea` VALUES ('431224', '溆浦县', '431200');
INSERT INTO `apparea` VALUES ('431225', '会同县', '431200');
INSERT INTO `apparea` VALUES ('431226', '麻阳苗族自治县', '431200');
INSERT INTO `apparea` VALUES ('431227', '新晃侗族自治县', '431200');
INSERT INTO `apparea` VALUES ('431228', '芷江侗族自治县', '431200');
INSERT INTO `apparea` VALUES ('431229', '靖州苗族侗族自治县', '431200');
INSERT INTO `apparea` VALUES ('431230', '通道侗族自治县', '431200');
INSERT INTO `apparea` VALUES ('431281', '洪江市', '431200');
INSERT INTO `apparea` VALUES ('431302', '娄星区', '431300');
INSERT INTO `apparea` VALUES ('431321', '双峰县', '431300');
INSERT INTO `apparea` VALUES ('431322', '新化县', '431300');
INSERT INTO `apparea` VALUES ('431381', '冷水江市', '431300');
INSERT INTO `apparea` VALUES ('431382', '涟源市', '431300');
INSERT INTO `apparea` VALUES ('433101', '吉首市', '433100');
INSERT INTO `apparea` VALUES ('433122', '泸溪县', '433100');
INSERT INTO `apparea` VALUES ('433123', '凤凰县', '433100');
INSERT INTO `apparea` VALUES ('433124', '花垣县', '433100');
INSERT INTO `apparea` VALUES ('433125', '保靖县', '433100');
INSERT INTO `apparea` VALUES ('433126', '古丈县', '433100');
INSERT INTO `apparea` VALUES ('433127', '永顺县', '433100');
INSERT INTO `apparea` VALUES ('433130', '龙山县', '433100');
INSERT INTO `apparea` VALUES ('440103', '荔湾区', '440100');
INSERT INTO `apparea` VALUES ('440104', '越秀区', '440100');
INSERT INTO `apparea` VALUES ('440105', '海珠区', '440100');
INSERT INTO `apparea` VALUES ('440106', '天河区', '440100');
INSERT INTO `apparea` VALUES ('440107', '萝岗区', '440100');
INSERT INTO `apparea` VALUES ('440111', '白云区', '440100');
INSERT INTO `apparea` VALUES ('440112', '黄埔区', '440100');
INSERT INTO `apparea` VALUES ('440113', '番禺区', '440100');
INSERT INTO `apparea` VALUES ('440114', '花都区', '440100');
INSERT INTO `apparea` VALUES ('440183', '增城区', '440100');
INSERT INTO `apparea` VALUES ('440184', '从化区', '440100');
INSERT INTO `apparea` VALUES ('440203', '武江区', '440200');
INSERT INTO `apparea` VALUES ('440204', '浈江区', '440200');
INSERT INTO `apparea` VALUES ('440205', '曲江区', '440200');
INSERT INTO `apparea` VALUES ('440222', '始兴县', '440200');
INSERT INTO `apparea` VALUES ('440224', '仁化县', '440200');
INSERT INTO `apparea` VALUES ('440229', '翁源县', '440200');
INSERT INTO `apparea` VALUES ('440232', '乳源瑶族自治县', '440200');
INSERT INTO `apparea` VALUES ('440233', '新丰县', '440200');
INSERT INTO `apparea` VALUES ('440281', '乐昌市', '440200');
INSERT INTO `apparea` VALUES ('440282', '南雄市', '440200');
INSERT INTO `apparea` VALUES ('440303', '罗湖区', '440300');
INSERT INTO `apparea` VALUES ('440304', '福田区', '440300');
INSERT INTO `apparea` VALUES ('440305', '南山区', '440300');
INSERT INTO `apparea` VALUES ('440306', '宝安区', '440300');
INSERT INTO `apparea` VALUES ('440307', '龙岗区', '440300');
INSERT INTO `apparea` VALUES ('440308', '盐田区', '440300');
INSERT INTO `apparea` VALUES ('440402', '香洲区', '440400');
INSERT INTO `apparea` VALUES ('440403', '斗门区', '440400');
INSERT INTO `apparea` VALUES ('440404', '金湾区', '440400');
INSERT INTO `apparea` VALUES ('440507', '龙湖区', '440500');
INSERT INTO `apparea` VALUES ('440511', '金平区', '440500');
INSERT INTO `apparea` VALUES ('440512', '濠江区', '440500');
INSERT INTO `apparea` VALUES ('440513', '潮阳区', '440500');
INSERT INTO `apparea` VALUES ('440514', '潮南区', '440500');
INSERT INTO `apparea` VALUES ('440515', '澄海区', '440500');
INSERT INTO `apparea` VALUES ('440523', '南澳县', '440500');
INSERT INTO `apparea` VALUES ('440604', '禅城区', '440600');
INSERT INTO `apparea` VALUES ('440605', '南海区', '440600');
INSERT INTO `apparea` VALUES ('440606', '顺德区', '440600');
INSERT INTO `apparea` VALUES ('440607', '三水区', '440600');
INSERT INTO `apparea` VALUES ('440608', '高明区', '440600');
INSERT INTO `apparea` VALUES ('440703', '蓬江区', '440700');
INSERT INTO `apparea` VALUES ('440704', '江海区', '440700');
INSERT INTO `apparea` VALUES ('440705', '新会区', '440700');
INSERT INTO `apparea` VALUES ('440781', '台山市', '440700');
INSERT INTO `apparea` VALUES ('440783', '开平市', '440700');
INSERT INTO `apparea` VALUES ('440784', '鹤山市', '440700');
INSERT INTO `apparea` VALUES ('440785', '恩平市', '440700');
INSERT INTO `apparea` VALUES ('440802', '赤坎区', '440800');
INSERT INTO `apparea` VALUES ('440803', '霞山区', '440800');
INSERT INTO `apparea` VALUES ('440804', '坡头区', '440800');
INSERT INTO `apparea` VALUES ('440811', '麻章区', '440800');
INSERT INTO `apparea` VALUES ('440823', '遂溪县', '440800');
INSERT INTO `apparea` VALUES ('440825', '徐闻县', '440800');
INSERT INTO `apparea` VALUES ('440881', '廉江市', '440800');
INSERT INTO `apparea` VALUES ('440882', '雷州市', '440800');
INSERT INTO `apparea` VALUES ('440883', '吴川市', '440800');
INSERT INTO `apparea` VALUES ('440902', '茂南区', '440900');
INSERT INTO `apparea` VALUES ('440903', '茂港区', '440900');
INSERT INTO `apparea` VALUES ('440923', '电白县', '440900');
INSERT INTO `apparea` VALUES ('440981', '高州市', '440900');
INSERT INTO `apparea` VALUES ('440982', '化州市', '440900');
INSERT INTO `apparea` VALUES ('440983', '信宜市', '440900');
INSERT INTO `apparea` VALUES ('441202', '端州区', '441200');
INSERT INTO `apparea` VALUES ('441203', '鼎湖区', '441200');
INSERT INTO `apparea` VALUES ('441223', '广宁县', '441200');
INSERT INTO `apparea` VALUES ('441224', '怀集县', '441200');
INSERT INTO `apparea` VALUES ('441225', '封开县', '441200');
INSERT INTO `apparea` VALUES ('441226', '德庆县', '441200');
INSERT INTO `apparea` VALUES ('441283', '高要市', '441200');
INSERT INTO `apparea` VALUES ('441284', '四会市', '441200');
INSERT INTO `apparea` VALUES ('441302', '惠城区', '441300');
INSERT INTO `apparea` VALUES ('441303', '惠阳区', '441300');
INSERT INTO `apparea` VALUES ('441322', '博罗县', '441300');
INSERT INTO `apparea` VALUES ('441323', '惠东县', '441300');
INSERT INTO `apparea` VALUES ('441324', '龙门县', '441300');
INSERT INTO `apparea` VALUES ('441402', '梅江区', '441400');
INSERT INTO `apparea` VALUES ('441421', '梅　县', '441400');
INSERT INTO `apparea` VALUES ('441422', '大埔县', '441400');
INSERT INTO `apparea` VALUES ('441423', '丰顺县', '441400');
INSERT INTO `apparea` VALUES ('441424', '五华县', '441400');
INSERT INTO `apparea` VALUES ('441426', '平远县', '441400');
INSERT INTO `apparea` VALUES ('441427', '蕉岭县', '441400');
INSERT INTO `apparea` VALUES ('441481', '兴宁市', '441400');
INSERT INTO `apparea` VALUES ('441502', '城　区', '441500');
INSERT INTO `apparea` VALUES ('441521', '海丰县', '441500');
INSERT INTO `apparea` VALUES ('441523', '陆河县', '441500');
INSERT INTO `apparea` VALUES ('441581', '陆丰市', '441500');
INSERT INTO `apparea` VALUES ('441602', '源城区', '441600');
INSERT INTO `apparea` VALUES ('441621', '紫金县', '441600');
INSERT INTO `apparea` VALUES ('441622', '龙川县', '441600');
INSERT INTO `apparea` VALUES ('441623', '连平县', '441600');
INSERT INTO `apparea` VALUES ('441624', '和平县', '441600');
INSERT INTO `apparea` VALUES ('441625', '东源县', '441600');
INSERT INTO `apparea` VALUES ('441702', '江城区', '441700');
INSERT INTO `apparea` VALUES ('441721', '阳西县', '441700');
INSERT INTO `apparea` VALUES ('441723', '阳东县', '441700');
INSERT INTO `apparea` VALUES ('441781', '阳春市', '441700');
INSERT INTO `apparea` VALUES ('441802', '清城区', '441800');
INSERT INTO `apparea` VALUES ('441821', '佛冈县', '441800');
INSERT INTO `apparea` VALUES ('441823', '阳山县', '441800');
INSERT INTO `apparea` VALUES ('441825', '连山壮族瑶族自治县', '441800');
INSERT INTO `apparea` VALUES ('441826', '连南瑶族自治县', '441800');
INSERT INTO `apparea` VALUES ('441827', '清新县', '441800');
INSERT INTO `apparea` VALUES ('441881', '英德市', '441800');
INSERT INTO `apparea` VALUES ('441882', '连州市', '441800');
INSERT INTO `apparea` VALUES ('441901', '南城区', '441900');
INSERT INTO `apparea` VALUES ('441902', '寮步镇', '441900');
INSERT INTO `apparea` VALUES ('441903', '东城区', '441900');
INSERT INTO `apparea` VALUES ('441904', '莞城', '441900');
INSERT INTO `apparea` VALUES ('441905', '万江', '441900');
INSERT INTO `apparea` VALUES ('441906', '石碣镇', '441900');
INSERT INTO `apparea` VALUES ('441907', '石龙镇', '441900');
INSERT INTO `apparea` VALUES ('441908', '茶山镇', '441900');
INSERT INTO `apparea` VALUES ('441909', '石排镇', '441900');
INSERT INTO `apparea` VALUES ('441910', '企石镇', '441900');
INSERT INTO `apparea` VALUES ('441911', '横沥镇', '441900');
INSERT INTO `apparea` VALUES ('441912', '桥头镇', '441900');
INSERT INTO `apparea` VALUES ('441913', '谢岗镇', '441900');
INSERT INTO `apparea` VALUES ('441914', '东坑镇', '441900');
INSERT INTO `apparea` VALUES ('441915', '常平镇', '441900');
INSERT INTO `apparea` VALUES ('441916', '大朗镇', '441900');
INSERT INTO `apparea` VALUES ('441917', '黄江镇', '441900');
INSERT INTO `apparea` VALUES ('441918', '清溪镇', '441900');
INSERT INTO `apparea` VALUES ('441919', '塘厦镇', '441900');
INSERT INTO `apparea` VALUES ('441920', '凤岗镇', '441900');
INSERT INTO `apparea` VALUES ('441921', '长安镇', '441900');
INSERT INTO `apparea` VALUES ('441922', '虎门镇', '441900');
INSERT INTO `apparea` VALUES ('441923', '厚街镇', '441900');
INSERT INTO `apparea` VALUES ('441924', '沙田镇', '441900');
INSERT INTO `apparea` VALUES ('441925', '道滘镇', '441900');
INSERT INTO `apparea` VALUES ('441926', '麻涌镇', '441900');
INSERT INTO `apparea` VALUES ('441927', '中堂镇', '441900');
INSERT INTO `apparea` VALUES ('441928', '高埗镇', '441900');
INSERT INTO `apparea` VALUES ('441929', '樟木头镇', '441900');
INSERT INTO `apparea` VALUES ('441930', '大岭山镇', '441900');
INSERT INTO `apparea` VALUES ('441931', '望牛墩镇', '441900');
INSERT INTO `apparea` VALUES ('441932', '红梅镇', '441900');
INSERT INTO `apparea` VALUES ('445102', '湘桥区', '445100');
INSERT INTO `apparea` VALUES ('445121', '潮安县', '445100');
INSERT INTO `apparea` VALUES ('445122', '饶平县', '445100');
INSERT INTO `apparea` VALUES ('445202', '榕城区', '445200');
INSERT INTO `apparea` VALUES ('445221', '揭东县', '445200');
INSERT INTO `apparea` VALUES ('445222', '揭西县', '445200');
INSERT INTO `apparea` VALUES ('445224', '惠来县', '445200');
INSERT INTO `apparea` VALUES ('445281', '普宁市', '445200');
INSERT INTO `apparea` VALUES ('445302', '云城区', '445300');
INSERT INTO `apparea` VALUES ('445321', '新兴县', '445300');
INSERT INTO `apparea` VALUES ('445322', '郁南县', '445300');
INSERT INTO `apparea` VALUES ('445323', '云安县', '445300');
INSERT INTO `apparea` VALUES ('445381', '罗定市', '445300');
INSERT INTO `apparea` VALUES ('450102', '兴宁区', '450100');
INSERT INTO `apparea` VALUES ('450103', '青秀区', '450100');
INSERT INTO `apparea` VALUES ('450105', '江南区', '450100');
INSERT INTO `apparea` VALUES ('450107', '西乡塘区', '450100');
INSERT INTO `apparea` VALUES ('450108', '良庆区', '450100');
INSERT INTO `apparea` VALUES ('450109', '邕宁区', '450100');
INSERT INTO `apparea` VALUES ('450122', '武鸣县', '450100');
INSERT INTO `apparea` VALUES ('450123', '隆安县', '450100');
INSERT INTO `apparea` VALUES ('450124', '马山县', '450100');
INSERT INTO `apparea` VALUES ('450125', '上林县', '450100');
INSERT INTO `apparea` VALUES ('450126', '宾阳县', '450100');
INSERT INTO `apparea` VALUES ('450127', '横　县', '450100');
INSERT INTO `apparea` VALUES ('450202', '城中区', '450200');
INSERT INTO `apparea` VALUES ('450203', '鱼峰区', '450200');
INSERT INTO `apparea` VALUES ('450204', '柳南区', '450200');
INSERT INTO `apparea` VALUES ('450205', '柳北区', '450200');
INSERT INTO `apparea` VALUES ('450221', '柳江县', '450200');
INSERT INTO `apparea` VALUES ('450222', '柳城县', '450200');
INSERT INTO `apparea` VALUES ('450223', '鹿寨县', '450200');
INSERT INTO `apparea` VALUES ('450224', '融安县', '450200');
INSERT INTO `apparea` VALUES ('450225', '融水苗族自治县', '450200');
INSERT INTO `apparea` VALUES ('450226', '三江侗族自治县', '450200');
INSERT INTO `apparea` VALUES ('450302', '秀峰区', '450300');
INSERT INTO `apparea` VALUES ('450303', '叠彩区', '450300');
INSERT INTO `apparea` VALUES ('450304', '象山区', '450300');
INSERT INTO `apparea` VALUES ('450305', '七星区', '450300');
INSERT INTO `apparea` VALUES ('450311', '雁山区', '450300');
INSERT INTO `apparea` VALUES ('450321', '阳朔县', '450300');
INSERT INTO `apparea` VALUES ('450322', '临桂县', '450300');
INSERT INTO `apparea` VALUES ('450323', '灵川县', '450300');
INSERT INTO `apparea` VALUES ('450324', '全州县', '450300');
INSERT INTO `apparea` VALUES ('450325', '兴安县', '450300');
INSERT INTO `apparea` VALUES ('450326', '永福县', '450300');
INSERT INTO `apparea` VALUES ('450327', '灌阳县', '450300');
INSERT INTO `apparea` VALUES ('450328', '龙胜各族自治县', '450300');
INSERT INTO `apparea` VALUES ('450329', '资源县', '450300');
INSERT INTO `apparea` VALUES ('450330', '平乐县', '450300');
INSERT INTO `apparea` VALUES ('450331', '荔蒲县', '450300');
INSERT INTO `apparea` VALUES ('450332', '恭城瑶族自治县', '450300');
INSERT INTO `apparea` VALUES ('450403', '万秀区', '450400');
INSERT INTO `apparea` VALUES ('450404', '蝶山区', '450400');
INSERT INTO `apparea` VALUES ('450405', '长洲区', '450400');
INSERT INTO `apparea` VALUES ('450421', '苍梧县', '450400');
INSERT INTO `apparea` VALUES ('450422', '藤　县', '450400');
INSERT INTO `apparea` VALUES ('450423', '蒙山县', '450400');
INSERT INTO `apparea` VALUES ('450481', '岑溪市', '450400');
INSERT INTO `apparea` VALUES ('450502', '海城区', '450500');
INSERT INTO `apparea` VALUES ('450503', '银海区', '450500');
INSERT INTO `apparea` VALUES ('450512', '铁山港区', '450500');
INSERT INTO `apparea` VALUES ('450521', '合浦县', '450500');
INSERT INTO `apparea` VALUES ('450602', '港口区', '450600');
INSERT INTO `apparea` VALUES ('450603', '防城区', '450600');
INSERT INTO `apparea` VALUES ('450621', '上思县', '450600');
INSERT INTO `apparea` VALUES ('450681', '东兴市', '450600');
INSERT INTO `apparea` VALUES ('450702', '钦南区', '450700');
INSERT INTO `apparea` VALUES ('450703', '钦北区', '450700');
INSERT INTO `apparea` VALUES ('450721', '灵山县', '450700');
INSERT INTO `apparea` VALUES ('450722', '浦北县', '450700');
INSERT INTO `apparea` VALUES ('450802', '港北区', '450800');
INSERT INTO `apparea` VALUES ('450803', '港南区', '450800');
INSERT INTO `apparea` VALUES ('450804', '覃塘区', '450800');
INSERT INTO `apparea` VALUES ('450821', '平南县', '450800');
INSERT INTO `apparea` VALUES ('450881', '桂平市', '450800');
INSERT INTO `apparea` VALUES ('450902', '玉州区', '450900');
INSERT INTO `apparea` VALUES ('450921', '容　县', '450900');
INSERT INTO `apparea` VALUES ('450922', '陆川县', '450900');
INSERT INTO `apparea` VALUES ('450923', '博白县', '450900');
INSERT INTO `apparea` VALUES ('450924', '兴业县', '450900');
INSERT INTO `apparea` VALUES ('450981', '北流市', '450900');
INSERT INTO `apparea` VALUES ('451002', '右江区', '451000');
INSERT INTO `apparea` VALUES ('451021', '田阳县', '451000');
INSERT INTO `apparea` VALUES ('451022', '田东县', '451000');
INSERT INTO `apparea` VALUES ('451023', '平果县', '451000');
INSERT INTO `apparea` VALUES ('451024', '德保县', '451000');
INSERT INTO `apparea` VALUES ('451025', '靖西县', '451000');
INSERT INTO `apparea` VALUES ('451026', '那坡县', '451000');
INSERT INTO `apparea` VALUES ('451027', '凌云县', '451000');
INSERT INTO `apparea` VALUES ('451028', '乐业县', '451000');
INSERT INTO `apparea` VALUES ('451029', '田林县', '451000');
INSERT INTO `apparea` VALUES ('451030', '西林县', '451000');
INSERT INTO `apparea` VALUES ('451031', '隆林各族自治县', '451000');
INSERT INTO `apparea` VALUES ('451102', '八步区', '451100');
INSERT INTO `apparea` VALUES ('451121', '昭平县', '451100');
INSERT INTO `apparea` VALUES ('451122', '钟山县', '451100');
INSERT INTO `apparea` VALUES ('451123', '富川瑶族自治县', '451100');
INSERT INTO `apparea` VALUES ('451202', '金城江区', '451200');
INSERT INTO `apparea` VALUES ('451221', '南丹县', '451200');
INSERT INTO `apparea` VALUES ('451222', '天峨县', '451200');
INSERT INTO `apparea` VALUES ('451223', '凤山县', '451200');
INSERT INTO `apparea` VALUES ('451224', '东兰县', '451200');
INSERT INTO `apparea` VALUES ('451225', '罗城仫佬族自治县', '451200');
INSERT INTO `apparea` VALUES ('451226', '环江毛南族自治县', '451200');
INSERT INTO `apparea` VALUES ('451227', '巴马瑶族自治县', '451200');
INSERT INTO `apparea` VALUES ('451228', '都安瑶族自治县', '451200');
INSERT INTO `apparea` VALUES ('451229', '大化瑶族自治县', '451200');
INSERT INTO `apparea` VALUES ('451281', '宜州市', '451200');
INSERT INTO `apparea` VALUES ('451302', '兴宾区', '451300');
INSERT INTO `apparea` VALUES ('451321', '忻城县', '451300');
INSERT INTO `apparea` VALUES ('451322', '象州县', '451300');
INSERT INTO `apparea` VALUES ('451323', '武宣县', '451300');
INSERT INTO `apparea` VALUES ('451324', '金秀瑶族自治县', '451300');
INSERT INTO `apparea` VALUES ('451381', '合山市', '451300');
INSERT INTO `apparea` VALUES ('451402', '江洲区', '451400');
INSERT INTO `apparea` VALUES ('451421', '扶绥县', '451400');
INSERT INTO `apparea` VALUES ('451422', '宁明县', '451400');
INSERT INTO `apparea` VALUES ('451423', '龙州县', '451400');
INSERT INTO `apparea` VALUES ('451424', '大新县', '451400');
INSERT INTO `apparea` VALUES ('451425', '天等县', '451400');
INSERT INTO `apparea` VALUES ('451481', '凭祥市', '451400');
INSERT INTO `apparea` VALUES ('460105', '秀英区', '460100');
INSERT INTO `apparea` VALUES ('460106', '龙华区', '460100');
INSERT INTO `apparea` VALUES ('460107', '琼山区', '460100');
INSERT INTO `apparea` VALUES ('460108', '美兰区', '460100');
INSERT INTO `apparea` VALUES ('469001', '五指山市', '469000');
INSERT INTO `apparea` VALUES ('469002', '琼海市', '469000');
INSERT INTO `apparea` VALUES ('469003', '儋州市', '469000');
INSERT INTO `apparea` VALUES ('469005', '文昌市', '469000');
INSERT INTO `apparea` VALUES ('469006', '万宁市', '469000');
INSERT INTO `apparea` VALUES ('469007', '东方市', '469000');
INSERT INTO `apparea` VALUES ('469025', '定安县', '469000');
INSERT INTO `apparea` VALUES ('469026', '屯昌县', '469000');
INSERT INTO `apparea` VALUES ('469027', '澄迈县', '469000');
INSERT INTO `apparea` VALUES ('469028', '临高县', '469000');
INSERT INTO `apparea` VALUES ('469030', '白沙黎族自治县', '469000');
INSERT INTO `apparea` VALUES ('469031', '昌江黎族自治县', '469000');
INSERT INTO `apparea` VALUES ('469033', '乐东黎族自治县', '469000');
INSERT INTO `apparea` VALUES ('469034', '陵水黎族自治县', '469000');
INSERT INTO `apparea` VALUES ('469035', '保亭黎族苗族自治县', '469000');
INSERT INTO `apparea` VALUES ('469036', '琼中黎族苗族自治县', '469000');
INSERT INTO `apparea` VALUES ('469037', '西沙群岛', '469000');
INSERT INTO `apparea` VALUES ('469038', '南沙群岛', '469000');
INSERT INTO `apparea` VALUES ('469039', '中沙群岛的岛礁及其海域', '469000');
INSERT INTO `apparea` VALUES ('500101', '万州区', '500100');
INSERT INTO `apparea` VALUES ('500102', '涪陵区', '500100');
INSERT INTO `apparea` VALUES ('500103', '渝中区', '500100');
INSERT INTO `apparea` VALUES ('500104', '大渡口区', '500100');
INSERT INTO `apparea` VALUES ('500105', '江北区', '500100');
INSERT INTO `apparea` VALUES ('500106', '沙坪坝区', '500100');
INSERT INTO `apparea` VALUES ('500107', '九龙坡区', '500100');
INSERT INTO `apparea` VALUES ('500108', '南岸区', '500100');
INSERT INTO `apparea` VALUES ('500109', '北碚区', '500100');
INSERT INTO `apparea` VALUES ('500110', '万盛区', '500100');
INSERT INTO `apparea` VALUES ('500111', '双桥区', '500100');
INSERT INTO `apparea` VALUES ('500112', '渝北区', '500100');
INSERT INTO `apparea` VALUES ('500113', '巴南区', '500100');
INSERT INTO `apparea` VALUES ('500114', '黔江区', '500100');
INSERT INTO `apparea` VALUES ('500115', '长寿区', '500100');
INSERT INTO `apparea` VALUES ('500222', '綦江县', '500200');
INSERT INTO `apparea` VALUES ('500223', '潼南县', '500200');
INSERT INTO `apparea` VALUES ('500224', '铜梁县', '500200');
INSERT INTO `apparea` VALUES ('500225', '大足县', '500200');
INSERT INTO `apparea` VALUES ('500226', '荣昌县', '500200');
INSERT INTO `apparea` VALUES ('500227', '璧山县', '500200');
INSERT INTO `apparea` VALUES ('500228', '梁平县', '500200');
INSERT INTO `apparea` VALUES ('500229', '城口县', '500200');
INSERT INTO `apparea` VALUES ('500230', '丰都县', '500200');
INSERT INTO `apparea` VALUES ('500231', '垫江县', '500200');
INSERT INTO `apparea` VALUES ('500232', '武隆县', '500200');
INSERT INTO `apparea` VALUES ('500233', '忠　县', '500200');
INSERT INTO `apparea` VALUES ('500234', '开　县', '500200');
INSERT INTO `apparea` VALUES ('500235', '云阳县', '500200');
INSERT INTO `apparea` VALUES ('500236', '奉节县', '500200');
INSERT INTO `apparea` VALUES ('500237', '巫山县', '500200');
INSERT INTO `apparea` VALUES ('500238', '巫溪县', '500200');
INSERT INTO `apparea` VALUES ('500240', '石柱土家族自治县', '500200');
INSERT INTO `apparea` VALUES ('500241', '秀山土家族苗族自治县', '500200');
INSERT INTO `apparea` VALUES ('500242', '酉阳土家族苗族自治县', '500200');
INSERT INTO `apparea` VALUES ('500243', '彭水苗族土家族自治县', '500200');
INSERT INTO `apparea` VALUES ('500381', '江津市', '500300');
INSERT INTO `apparea` VALUES ('500382', '合川市', '500300');
INSERT INTO `apparea` VALUES ('500383', '永川市', '500300');
INSERT INTO `apparea` VALUES ('500384', '南川市', '500300');
INSERT INTO `apparea` VALUES ('510104', '锦江区', '510100');
INSERT INTO `apparea` VALUES ('510105', '青羊区', '510100');
INSERT INTO `apparea` VALUES ('510106', '金牛区', '510100');
INSERT INTO `apparea` VALUES ('510107', '武侯区', '510100');
INSERT INTO `apparea` VALUES ('510108', '成华区', '510100');
INSERT INTO `apparea` VALUES ('510112', '龙泉驿区', '510100');
INSERT INTO `apparea` VALUES ('510113', '青白江区', '510100');
INSERT INTO `apparea` VALUES ('510114', '新都区', '510100');
INSERT INTO `apparea` VALUES ('510115', '温江区', '510100');
INSERT INTO `apparea` VALUES ('510121', '金堂县', '510100');
INSERT INTO `apparea` VALUES ('510122', '双流县', '510100');
INSERT INTO `apparea` VALUES ('510124', '郫　县', '510100');
INSERT INTO `apparea` VALUES ('510129', '大邑县', '510100');
INSERT INTO `apparea` VALUES ('510131', '蒲江县', '510100');
INSERT INTO `apparea` VALUES ('510132', '新津县', '510100');
INSERT INTO `apparea` VALUES ('510181', '都江堰市', '510100');
INSERT INTO `apparea` VALUES ('510182', '彭州市', '510100');
INSERT INTO `apparea` VALUES ('510183', '邛崃市', '510100');
INSERT INTO `apparea` VALUES ('510184', '崇州市', '510100');
INSERT INTO `apparea` VALUES ('510302', '自流井区', '510300');
INSERT INTO `apparea` VALUES ('510303', '贡井区', '510300');
INSERT INTO `apparea` VALUES ('510304', '大安区', '510300');
INSERT INTO `apparea` VALUES ('510311', '沿滩区', '510300');
INSERT INTO `apparea` VALUES ('510321', '荣　县', '510300');
INSERT INTO `apparea` VALUES ('510322', '富顺县', '510300');
INSERT INTO `apparea` VALUES ('510402', '东　区', '510400');
INSERT INTO `apparea` VALUES ('510403', '西　区', '510400');
INSERT INTO `apparea` VALUES ('510411', '仁和区', '510400');
INSERT INTO `apparea` VALUES ('510421', '米易县', '510400');
INSERT INTO `apparea` VALUES ('510422', '盐边县', '510400');
INSERT INTO `apparea` VALUES ('510502', '江阳区', '510500');
INSERT INTO `apparea` VALUES ('510503', '纳溪区', '510500');
INSERT INTO `apparea` VALUES ('510504', '龙马潭区', '510500');
INSERT INTO `apparea` VALUES ('510521', '泸　县', '510500');
INSERT INTO `apparea` VALUES ('510522', '合江县', '510500');
INSERT INTO `apparea` VALUES ('510524', '叙永县', '510500');
INSERT INTO `apparea` VALUES ('510525', '古蔺县', '510500');
INSERT INTO `apparea` VALUES ('510603', '旌阳区', '510600');
INSERT INTO `apparea` VALUES ('510623', '中江县', '510600');
INSERT INTO `apparea` VALUES ('510626', '罗江县', '510600');
INSERT INTO `apparea` VALUES ('510681', '广汉市', '510600');
INSERT INTO `apparea` VALUES ('510682', '什邡市', '510600');
INSERT INTO `apparea` VALUES ('510683', '绵竹市', '510600');
INSERT INTO `apparea` VALUES ('510703', '涪城区', '510700');
INSERT INTO `apparea` VALUES ('510704', '游仙区', '510700');
INSERT INTO `apparea` VALUES ('510722', '三台县', '510700');
INSERT INTO `apparea` VALUES ('510723', '盐亭县', '510700');
INSERT INTO `apparea` VALUES ('510724', '安　县', '510700');
INSERT INTO `apparea` VALUES ('510725', '梓潼县', '510700');
INSERT INTO `apparea` VALUES ('510726', '北川羌族自治县', '510700');
INSERT INTO `apparea` VALUES ('510727', '平武县', '510700');
INSERT INTO `apparea` VALUES ('510781', '江油市', '510700');
INSERT INTO `apparea` VALUES ('510802', '市中区', '510800');
INSERT INTO `apparea` VALUES ('510811', '元坝区', '510800');
INSERT INTO `apparea` VALUES ('510812', '朝天区', '510800');
INSERT INTO `apparea` VALUES ('510821', '旺苍县', '510800');
INSERT INTO `apparea` VALUES ('510822', '青川县', '510800');
INSERT INTO `apparea` VALUES ('510823', '剑阁县', '510800');
INSERT INTO `apparea` VALUES ('510824', '苍溪县', '510800');
INSERT INTO `apparea` VALUES ('510903', '船山区', '510900');
INSERT INTO `apparea` VALUES ('510904', '安居区', '510900');
INSERT INTO `apparea` VALUES ('510921', '蓬溪县', '510900');
INSERT INTO `apparea` VALUES ('510922', '射洪县', '510900');
INSERT INTO `apparea` VALUES ('510923', '大英县', '510900');
INSERT INTO `apparea` VALUES ('511002', '市中区', '511000');
INSERT INTO `apparea` VALUES ('511011', '东兴区', '511000');
INSERT INTO `apparea` VALUES ('511024', '威远县', '511000');
INSERT INTO `apparea` VALUES ('511025', '资中县', '511000');
INSERT INTO `apparea` VALUES ('511028', '隆昌县', '511000');
INSERT INTO `apparea` VALUES ('511102', '市中区', '511100');
INSERT INTO `apparea` VALUES ('511111', '沙湾区', '511100');
INSERT INTO `apparea` VALUES ('511112', '五通桥区', '511100');
INSERT INTO `apparea` VALUES ('511113', '金口河区', '511100');
INSERT INTO `apparea` VALUES ('511123', '犍为县', '511100');
INSERT INTO `apparea` VALUES ('511124', '井研县', '511100');
INSERT INTO `apparea` VALUES ('511126', '夹江县', '511100');
INSERT INTO `apparea` VALUES ('511129', '沐川县', '511100');
INSERT INTO `apparea` VALUES ('511132', '峨边彝族自治县', '511100');
INSERT INTO `apparea` VALUES ('511133', '马边彝族自治县', '511100');
INSERT INTO `apparea` VALUES ('513327', '炉霍县', '513300');
INSERT INTO `apparea` VALUES ('513328', '甘孜县', '513300');
INSERT INTO `apparea` VALUES ('513329', '新龙县', '513300');
INSERT INTO `apparea` VALUES ('513330', '德格县', '513300');
INSERT INTO `apparea` VALUES ('513331', '白玉县', '513300');
INSERT INTO `apparea` VALUES ('513332', '石渠县', '513300');
INSERT INTO `apparea` VALUES ('513333', '色达县', '513300');
INSERT INTO `apparea` VALUES ('513334', '理塘县', '513300');
INSERT INTO `apparea` VALUES ('513335', '巴塘县', '513300');
INSERT INTO `apparea` VALUES ('513336', '乡城县', '513300');
INSERT INTO `apparea` VALUES ('513337', '稻城县', '513300');
INSERT INTO `apparea` VALUES ('513338', '得荣县', '513300');
INSERT INTO `apparea` VALUES ('513401', '西昌市', '513400');
INSERT INTO `apparea` VALUES ('513422', '木里藏族自治县', '513400');
INSERT INTO `apparea` VALUES ('513423', '盐源县', '513400');
INSERT INTO `apparea` VALUES ('513424', '德昌县', '513400');
INSERT INTO `apparea` VALUES ('513425', '会理县', '513400');
INSERT INTO `apparea` VALUES ('513426', '会东县', '513400');
INSERT INTO `apparea` VALUES ('513427', '宁南县', '513400');
INSERT INTO `apparea` VALUES ('513428', '普格县', '513400');
INSERT INTO `apparea` VALUES ('513429', '布拖县', '513400');
INSERT INTO `apparea` VALUES ('513430', '金阳县', '513400');
INSERT INTO `apparea` VALUES ('513431', '昭觉县', '513400');
INSERT INTO `apparea` VALUES ('513432', '喜德县', '513400');
INSERT INTO `apparea` VALUES ('513433', '冕宁县', '513400');
INSERT INTO `apparea` VALUES ('513434', '越西县', '513400');
INSERT INTO `apparea` VALUES ('513435', '甘洛县', '513400');
INSERT INTO `apparea` VALUES ('513436', '美姑县', '513400');
INSERT INTO `apparea` VALUES ('513437', '雷波县', '513400');
INSERT INTO `apparea` VALUES ('520102', '南明区', '520100');
INSERT INTO `apparea` VALUES ('520103', '云岩区', '520100');
INSERT INTO `apparea` VALUES ('520111', '花溪区', '520100');
INSERT INTO `apparea` VALUES ('520112', '乌当区', '520100');
INSERT INTO `apparea` VALUES ('520113', '白云区', '520100');
INSERT INTO `apparea` VALUES ('520114', '小河区', '520100');
INSERT INTO `apparea` VALUES ('520121', '开阳县', '520100');
INSERT INTO `apparea` VALUES ('520122', '息烽县', '520100');
INSERT INTO `apparea` VALUES ('520123', '修文县', '520100');
INSERT INTO `apparea` VALUES ('520181', '清镇市', '520100');
INSERT INTO `apparea` VALUES ('520201', '钟山区', '520200');
INSERT INTO `apparea` VALUES ('520203', '六枝特区', '520200');
INSERT INTO `apparea` VALUES ('520221', '水城县', '520200');
INSERT INTO `apparea` VALUES ('520222', '盘　县', '520200');
INSERT INTO `apparea` VALUES ('520302', '红花岗区', '520300');
INSERT INTO `apparea` VALUES ('520303', '汇川区', '520300');
INSERT INTO `apparea` VALUES ('520321', '遵义县', '520300');
INSERT INTO `apparea` VALUES ('520322', '桐梓县', '520300');
INSERT INTO `apparea` VALUES ('520323', '绥阳县', '520300');
INSERT INTO `apparea` VALUES ('520324', '正安县', '520300');
INSERT INTO `apparea` VALUES ('520325', '道真仡佬族苗族自治县', '520300');
INSERT INTO `apparea` VALUES ('520326', '务川仡佬族苗族自治县', '520300');
INSERT INTO `apparea` VALUES ('520327', '凤冈县', '520300');
INSERT INTO `apparea` VALUES ('520328', '湄潭县', '520300');
INSERT INTO `apparea` VALUES ('520329', '余庆县', '520300');
INSERT INTO `apparea` VALUES ('520330', '习水县', '520300');
INSERT INTO `apparea` VALUES ('520381', '赤水市', '520300');
INSERT INTO `apparea` VALUES ('520382', '仁怀市', '520300');
INSERT INTO `apparea` VALUES ('520402', '西秀区', '520400');
INSERT INTO `apparea` VALUES ('520421', '平坝县', '520400');
INSERT INTO `apparea` VALUES ('520422', '普定县', '520400');
INSERT INTO `apparea` VALUES ('520423', '镇宁布依族苗族自治县', '520400');
INSERT INTO `apparea` VALUES ('520424', '关岭布依族苗族自治县', '520400');
INSERT INTO `apparea` VALUES ('520425', '紫云苗族布依族自治县', '520400');
INSERT INTO `apparea` VALUES ('522201', '铜仁市', '522200');
INSERT INTO `apparea` VALUES ('522222', '江口县', '522200');
INSERT INTO `apparea` VALUES ('522223', '玉屏侗族自治县', '522200');
INSERT INTO `apparea` VALUES ('522224', '石阡县', '522200');
INSERT INTO `apparea` VALUES ('522225', '思南县', '522200');
INSERT INTO `apparea` VALUES ('522226', '印江土家族苗族自治县', '522200');
INSERT INTO `apparea` VALUES ('522227', '德江县', '522200');
INSERT INTO `apparea` VALUES ('522228', '沿河土家族自治县', '522200');
INSERT INTO `apparea` VALUES ('522229', '松桃苗族自治县', '522200');
INSERT INTO `apparea` VALUES ('522230', '万山特区', '522200');
INSERT INTO `apparea` VALUES ('522301', '兴义市', '522300');
INSERT INTO `apparea` VALUES ('522322', '兴仁县', '522300');
INSERT INTO `apparea` VALUES ('522323', '普安县', '522300');
INSERT INTO `apparea` VALUES ('522324', '晴隆县', '522300');
INSERT INTO `apparea` VALUES ('522325', '贞丰县', '522300');
INSERT INTO `apparea` VALUES ('522326', '望谟县', '522300');
INSERT INTO `apparea` VALUES ('522327', '册亨县', '522300');
INSERT INTO `apparea` VALUES ('522328', '安龙县', '522300');
INSERT INTO `apparea` VALUES ('522401', '毕节市', '522400');
INSERT INTO `apparea` VALUES ('522422', '大方县', '522400');
INSERT INTO `apparea` VALUES ('522423', '黔西县', '522400');
INSERT INTO `apparea` VALUES ('522424', '金沙县', '522400');
INSERT INTO `apparea` VALUES ('522425', '织金县', '522400');
INSERT INTO `apparea` VALUES ('522426', '纳雍县', '522400');
INSERT INTO `apparea` VALUES ('522427', '威宁彝族回族苗族自治县', '522400');
INSERT INTO `apparea` VALUES ('522428', '赫章县', '522400');
INSERT INTO `apparea` VALUES ('522601', '凯里市', '522600');
INSERT INTO `apparea` VALUES ('522622', '黄平县', '522600');
INSERT INTO `apparea` VALUES ('522623', '施秉县', '522600');
INSERT INTO `apparea` VALUES ('522624', '三穗县', '522600');
INSERT INTO `apparea` VALUES ('522625', '镇远县', '522600');
INSERT INTO `apparea` VALUES ('522626', '岑巩县', '522600');
INSERT INTO `apparea` VALUES ('522627', '天柱县', '522600');
INSERT INTO `apparea` VALUES ('522628', '锦屏县', '522600');
INSERT INTO `apparea` VALUES ('522629', '剑河县', '522600');
INSERT INTO `apparea` VALUES ('522630', '台江县', '522600');
INSERT INTO `apparea` VALUES ('522631', '黎平县', '522600');
INSERT INTO `apparea` VALUES ('522632', '榕江县', '522600');
INSERT INTO `apparea` VALUES ('522633', '从江县', '522600');
INSERT INTO `apparea` VALUES ('522634', '雷山县', '522600');
INSERT INTO `apparea` VALUES ('522635', '麻江县', '522600');
INSERT INTO `apparea` VALUES ('522636', '丹寨县', '522600');
INSERT INTO `apparea` VALUES ('522701', '都匀市', '522700');
INSERT INTO `apparea` VALUES ('522702', '福泉市', '522700');
INSERT INTO `apparea` VALUES ('522722', '荔波县', '522700');
INSERT INTO `apparea` VALUES ('522723', '贵定县', '522700');
INSERT INTO `apparea` VALUES ('522725', '瓮安县', '522700');
INSERT INTO `apparea` VALUES ('522726', '独山县', '522700');
INSERT INTO `apparea` VALUES ('522727', '平塘县', '522700');
INSERT INTO `apparea` VALUES ('522728', '罗甸县', '522700');
INSERT INTO `apparea` VALUES ('522729', '长顺县', '522700');
INSERT INTO `apparea` VALUES ('522730', '龙里县', '522700');
INSERT INTO `apparea` VALUES ('522731', '惠水县', '522700');
INSERT INTO `apparea` VALUES ('522732', '三都水族自治县', '522700');
INSERT INTO `apparea` VALUES ('530102', '五华区', '530100');
INSERT INTO `apparea` VALUES ('530103', '盘龙区', '530100');
INSERT INTO `apparea` VALUES ('530111', '官渡区', '530100');
INSERT INTO `apparea` VALUES ('530112', '西山区', '530100');
INSERT INTO `apparea` VALUES ('530113', '东川区', '530100');
INSERT INTO `apparea` VALUES ('530121', '呈贡县', '530100');
INSERT INTO `apparea` VALUES ('530122', '晋宁县', '530100');
INSERT INTO `apparea` VALUES ('530124', '富民县', '530100');
INSERT INTO `apparea` VALUES ('530125', '宜良县', '530100');
INSERT INTO `apparea` VALUES ('530126', '石林彝族自治县', '530100');
INSERT INTO `apparea` VALUES ('530127', '嵩明县', '530100');
INSERT INTO `apparea` VALUES ('530128', '禄劝彝族苗族自治县', '530100');
INSERT INTO `apparea` VALUES ('530129', '寻甸回族彝族自治县', '530100');
INSERT INTO `apparea` VALUES ('530181', '安宁市', '530100');
INSERT INTO `apparea` VALUES ('530302', '麒麟区', '530300');
INSERT INTO `apparea` VALUES ('530321', '马龙县', '530300');
INSERT INTO `apparea` VALUES ('530322', '陆良县', '530300');
INSERT INTO `apparea` VALUES ('530323', '师宗县', '530300');
INSERT INTO `apparea` VALUES ('530324', '罗平县', '530300');
INSERT INTO `apparea` VALUES ('530325', '富源县', '530300');
INSERT INTO `apparea` VALUES ('530326', '会泽县', '530300');
INSERT INTO `apparea` VALUES ('530328', '沾益县', '530300');
INSERT INTO `apparea` VALUES ('530381', '宣威市', '530300');
INSERT INTO `apparea` VALUES ('530402', '红塔区', '530400');
INSERT INTO `apparea` VALUES ('530421', '江川县', '530400');
INSERT INTO `apparea` VALUES ('530422', '澄江县', '530400');
INSERT INTO `apparea` VALUES ('530423', '通海县', '530400');
INSERT INTO `apparea` VALUES ('530424', '华宁县', '530400');
INSERT INTO `apparea` VALUES ('530425', '易门县', '530400');
INSERT INTO `apparea` VALUES ('530426', '峨山彝族自治县', '530400');
INSERT INTO `apparea` VALUES ('530427', '新平彝族傣族自治县', '530400');
INSERT INTO `apparea` VALUES ('530428', '元江哈尼族彝族傣族自治县', '530400');
INSERT INTO `apparea` VALUES ('530502', '隆阳区', '530500');
INSERT INTO `apparea` VALUES ('530521', '施甸县', '530500');
INSERT INTO `apparea` VALUES ('530522', '腾冲县', '530500');
INSERT INTO `apparea` VALUES ('530523', '龙陵县', '530500');
INSERT INTO `apparea` VALUES ('530524', '昌宁县', '530500');
INSERT INTO `apparea` VALUES ('530602', '昭阳区', '530600');
INSERT INTO `apparea` VALUES ('530621', '鲁甸县', '530600');
INSERT INTO `apparea` VALUES ('530622', '巧家县', '530600');
INSERT INTO `apparea` VALUES ('530623', '盐津县', '530600');
INSERT INTO `apparea` VALUES ('530624', '大关县', '530600');
INSERT INTO `apparea` VALUES ('530625', '永善县', '530600');
INSERT INTO `apparea` VALUES ('530626', '绥江县', '530600');
INSERT INTO `apparea` VALUES ('530627', '镇雄县', '530600');
INSERT INTO `apparea` VALUES ('530628', '彝良县', '530600');
INSERT INTO `apparea` VALUES ('530629', '威信县', '530600');
INSERT INTO `apparea` VALUES ('530630', '水富县', '530600');
INSERT INTO `apparea` VALUES ('530702', '古城区', '530700');
INSERT INTO `apparea` VALUES ('530721', '玉龙纳西族自治县', '530700');
INSERT INTO `apparea` VALUES ('530722', '永胜县', '530700');
INSERT INTO `apparea` VALUES ('530723', '华坪县', '530700');
INSERT INTO `apparea` VALUES ('530724', '宁蒗彝族自治县', '530700');
INSERT INTO `apparea` VALUES ('530802', '翠云区', '530800');
INSERT INTO `apparea` VALUES ('530821', '普洱哈尼族彝族自治县', '530800');
INSERT INTO `apparea` VALUES ('530822', '墨江哈尼族自治县', '530800');
INSERT INTO `apparea` VALUES ('530823', '景东彝族自治县', '530800');
INSERT INTO `apparea` VALUES ('530824', '景谷傣族彝族自治县', '530800');
INSERT INTO `apparea` VALUES ('530825', '镇沅彝族哈尼族拉祜族自治县', '530800');
INSERT INTO `apparea` VALUES ('530826', '江城哈尼族彝族自治县', '530800');
INSERT INTO `apparea` VALUES ('530827', '孟连傣族拉祜族佤族自治县', '530800');
INSERT INTO `apparea` VALUES ('530828', '澜沧拉祜族自治县', '530800');
INSERT INTO `apparea` VALUES ('530829', '西盟佤族自治县', '530800');
INSERT INTO `apparea` VALUES ('530902', '临翔区', '530900');
INSERT INTO `apparea` VALUES ('530921', '凤庆县', '530900');
INSERT INTO `apparea` VALUES ('530922', '云　县', '530900');
INSERT INTO `apparea` VALUES ('530923', '永德县', '530900');
INSERT INTO `apparea` VALUES ('530924', '镇康县', '530900');
INSERT INTO `apparea` VALUES ('530925', '双江拉祜族佤族布朗族傣族自治县', '530900');
INSERT INTO `apparea` VALUES ('530926', '耿马傣族佤族自治县', '530900');
INSERT INTO `apparea` VALUES ('530927', '沧源佤族自治县', '530900');
INSERT INTO `apparea` VALUES ('532301', '楚雄市', '532300');
INSERT INTO `apparea` VALUES ('532322', '双柏县', '532300');
INSERT INTO `apparea` VALUES ('532323', '牟定县', '532300');
INSERT INTO `apparea` VALUES ('532324', '南华县', '532300');
INSERT INTO `apparea` VALUES ('532325', '姚安县', '532300');
INSERT INTO `apparea` VALUES ('532326', '大姚县', '532300');
INSERT INTO `apparea` VALUES ('532327', '永仁县', '532300');
INSERT INTO `apparea` VALUES ('532328', '元谋县', '532300');
INSERT INTO `apparea` VALUES ('532329', '武定县', '532300');
INSERT INTO `apparea` VALUES ('532331', '禄丰县', '532300');
INSERT INTO `apparea` VALUES ('532501', '个旧市', '532500');
INSERT INTO `apparea` VALUES ('532502', '开远市', '532500');
INSERT INTO `apparea` VALUES ('532522', '蒙自县', '532500');
INSERT INTO `apparea` VALUES ('532523', '屏边苗族自治县', '532500');
INSERT INTO `apparea` VALUES ('532524', '建水县', '532500');
INSERT INTO `apparea` VALUES ('532525', '石屏县', '532500');
INSERT INTO `apparea` VALUES ('532526', '弥勒县', '532500');
INSERT INTO `apparea` VALUES ('532527', '泸西县', '532500');
INSERT INTO `apparea` VALUES ('532528', '元阳县', '532500');
INSERT INTO `apparea` VALUES ('532529', '红河县', '532500');
INSERT INTO `apparea` VALUES ('532530', '金平苗族瑶族傣族自治县', '532500');
INSERT INTO `apparea` VALUES ('532531', '绿春县', '532500');
INSERT INTO `apparea` VALUES ('532532', '河口瑶族自治县', '532500');
INSERT INTO `apparea` VALUES ('532621', '文山县', '532600');
INSERT INTO `apparea` VALUES ('532622', '砚山县', '532600');
INSERT INTO `apparea` VALUES ('532623', '西畴县', '532600');
INSERT INTO `apparea` VALUES ('532624', '麻栗坡县', '532600');
INSERT INTO `apparea` VALUES ('532625', '马关县', '532600');
INSERT INTO `apparea` VALUES ('532626', '丘北县', '532600');
INSERT INTO `apparea` VALUES ('532627', '广南县', '532600');
INSERT INTO `apparea` VALUES ('532628', '富宁县', '532600');
INSERT INTO `apparea` VALUES ('532801', '景洪市', '532800');
INSERT INTO `apparea` VALUES ('532822', '勐海县', '532800');
INSERT INTO `apparea` VALUES ('532823', '勐腊县', '532800');
INSERT INTO `apparea` VALUES ('532901', '大理市', '532900');
INSERT INTO `apparea` VALUES ('532922', '漾濞彝族自治县', '532900');
INSERT INTO `apparea` VALUES ('532923', '祥云县', '532900');
INSERT INTO `apparea` VALUES ('532924', '宾川县', '532900');
INSERT INTO `apparea` VALUES ('532925', '弥渡县', '532900');
INSERT INTO `apparea` VALUES ('532926', '南涧彝族自治县', '532900');
INSERT INTO `apparea` VALUES ('532927', '巍山彝族回族自治县', '532900');
INSERT INTO `apparea` VALUES ('532928', '永平县', '532900');
INSERT INTO `apparea` VALUES ('532929', '云龙县', '532900');
INSERT INTO `apparea` VALUES ('532930', '洱源县', '532900');
INSERT INTO `apparea` VALUES ('532931', '剑川县', '532900');
INSERT INTO `apparea` VALUES ('532932', '鹤庆县', '532900');
INSERT INTO `apparea` VALUES ('533102', '瑞丽市', '533100');
INSERT INTO `apparea` VALUES ('533103', '潞西市', '533100');
INSERT INTO `apparea` VALUES ('533122', '梁河县', '533100');
INSERT INTO `apparea` VALUES ('533123', '盈江县', '533100');
INSERT INTO `apparea` VALUES ('533124', '陇川县', '533100');
INSERT INTO `apparea` VALUES ('533321', '泸水县', '533300');
INSERT INTO `apparea` VALUES ('533323', '福贡县', '533300');
INSERT INTO `apparea` VALUES ('533324', '贡山独龙族怒族自治县', '533300');
INSERT INTO `apparea` VALUES ('533325', '兰坪白族普米族自治县', '533300');
INSERT INTO `apparea` VALUES ('533421', '香格里拉县', '533400');
INSERT INTO `apparea` VALUES ('533422', '德钦县', '533400');
INSERT INTO `apparea` VALUES ('533423', '维西傈僳族自治县', '533400');
INSERT INTO `apparea` VALUES ('540102', '城关区', '540100');
INSERT INTO `apparea` VALUES ('540121', '林周县', '540100');
INSERT INTO `apparea` VALUES ('540122', '当雄县', '540100');
INSERT INTO `apparea` VALUES ('540123', '尼木县', '540100');
INSERT INTO `apparea` VALUES ('540124', '曲水县', '540100');
INSERT INTO `apparea` VALUES ('540125', '堆龙德庆县', '540100');
INSERT INTO `apparea` VALUES ('540126', '达孜县', '540100');
INSERT INTO `apparea` VALUES ('540127', '墨竹工卡县', '540100');
INSERT INTO `apparea` VALUES ('542121', '昌都县', '542100');
INSERT INTO `apparea` VALUES ('542122', '江达县', '542100');
INSERT INTO `apparea` VALUES ('542123', '贡觉县', '542100');
INSERT INTO `apparea` VALUES ('542124', '类乌齐县', '542100');
INSERT INTO `apparea` VALUES ('542125', '丁青县', '542100');
INSERT INTO `apparea` VALUES ('542126', '察雅县', '542100');
INSERT INTO `apparea` VALUES ('542127', '八宿县', '542100');
INSERT INTO `apparea` VALUES ('542128', '左贡县', '542100');
INSERT INTO `apparea` VALUES ('542129', '芒康县', '542100');
INSERT INTO `apparea` VALUES ('542132', '洛隆县', '542100');
INSERT INTO `apparea` VALUES ('542133', '边坝县', '542100');
INSERT INTO `apparea` VALUES ('542221', '乃东县', '542200');
INSERT INTO `apparea` VALUES ('542222', '扎囊县', '542200');
INSERT INTO `apparea` VALUES ('542223', '贡嘎县', '542200');
INSERT INTO `apparea` VALUES ('542224', '桑日县', '542200');
INSERT INTO `apparea` VALUES ('542225', '琼结县', '542200');
INSERT INTO `apparea` VALUES ('542226', '曲松县', '542200');
INSERT INTO `apparea` VALUES ('542227', '措美县', '542200');
INSERT INTO `apparea` VALUES ('542228', '洛扎县', '542200');
INSERT INTO `apparea` VALUES ('542229', '加查县', '542200');
INSERT INTO `apparea` VALUES ('542231', '隆子县', '542200');
INSERT INTO `apparea` VALUES ('542232', '错那县', '542200');
INSERT INTO `apparea` VALUES ('542233', '浪卡子县', '542200');
INSERT INTO `apparea` VALUES ('542301', '日喀则市', '542300');
INSERT INTO `apparea` VALUES ('542322', '南木林县', '542300');
INSERT INTO `apparea` VALUES ('542323', '江孜县', '542300');
INSERT INTO `apparea` VALUES ('542324', '定日县', '542300');
INSERT INTO `apparea` VALUES ('542325', '萨迦县', '542300');
INSERT INTO `apparea` VALUES ('542326', '拉孜县', '542300');
INSERT INTO `apparea` VALUES ('542327', '昂仁县', '542300');
INSERT INTO `apparea` VALUES ('542328', '谢通门县', '542300');
INSERT INTO `apparea` VALUES ('542329', '白朗县', '542300');
INSERT INTO `apparea` VALUES ('542330', '仁布县', '542300');
INSERT INTO `apparea` VALUES ('542331', '康马县', '542300');
INSERT INTO `apparea` VALUES ('542332', '定结县', '542300');
INSERT INTO `apparea` VALUES ('542333', '仲巴县', '542300');
INSERT INTO `apparea` VALUES ('542334', '亚东县', '542300');
INSERT INTO `apparea` VALUES ('542335', '吉隆县', '542300');
INSERT INTO `apparea` VALUES ('542336', '聂拉木县', '542300');
INSERT INTO `apparea` VALUES ('542337', '萨嘎县', '542300');
INSERT INTO `apparea` VALUES ('542338', '岗巴县', '542300');
INSERT INTO `apparea` VALUES ('542421', '那曲县', '542400');
INSERT INTO `apparea` VALUES ('542422', '嘉黎县', '542400');
INSERT INTO `apparea` VALUES ('542423', '比如县', '542400');
INSERT INTO `apparea` VALUES ('542424', '聂荣县', '542400');
INSERT INTO `apparea` VALUES ('542425', '安多县', '542400');
INSERT INTO `apparea` VALUES ('542426', '申扎县', '542400');
INSERT INTO `apparea` VALUES ('542427', '索　县', '542400');
INSERT INTO `apparea` VALUES ('542428', '班戈县', '542400');
INSERT INTO `apparea` VALUES ('542429', '巴青县', '542400');
INSERT INTO `apparea` VALUES ('542430', '尼玛县', '542400');
INSERT INTO `apparea` VALUES ('542521', '普兰县', '542500');
INSERT INTO `apparea` VALUES ('542522', '札达县', '542500');
INSERT INTO `apparea` VALUES ('542523', '噶尔县', '542500');
INSERT INTO `apparea` VALUES ('542524', '日土县', '542500');
INSERT INTO `apparea` VALUES ('542525', '革吉县', '542500');
INSERT INTO `apparea` VALUES ('542526', '改则县', '542500');
INSERT INTO `apparea` VALUES ('542527', '措勤县', '542500');
INSERT INTO `apparea` VALUES ('542621', '林芝县', '542600');
INSERT INTO `apparea` VALUES ('542622', '工布江达县', '542600');
INSERT INTO `apparea` VALUES ('542623', '米林县', '542600');
INSERT INTO `apparea` VALUES ('542624', '墨脱县', '542600');
INSERT INTO `apparea` VALUES ('542625', '波密县', '542600');
INSERT INTO `apparea` VALUES ('542626', '察隅县', '542600');
INSERT INTO `apparea` VALUES ('542627', '朗　县', '542600');
INSERT INTO `apparea` VALUES ('610102', '新城区', '610100');
INSERT INTO `apparea` VALUES ('610103', '碑林区', '610100');
INSERT INTO `apparea` VALUES ('610104', '莲湖区', '610100');
INSERT INTO `apparea` VALUES ('610111', '灞桥区', '610100');
INSERT INTO `apparea` VALUES ('610112', '未央区', '610100');
INSERT INTO `apparea` VALUES ('610113', '雁塔区', '610100');
INSERT INTO `apparea` VALUES ('610114', '阎良区', '610100');
INSERT INTO `apparea` VALUES ('610115', '临潼区', '610100');
INSERT INTO `apparea` VALUES ('610116', '长安区', '610100');
INSERT INTO `apparea` VALUES ('610122', '蓝田县', '610100');
INSERT INTO `apparea` VALUES ('610124', '周至县', '610100');
INSERT INTO `apparea` VALUES ('610125', '户　县', '610100');
INSERT INTO `apparea` VALUES ('610126', '高陵县', '610100');
INSERT INTO `apparea` VALUES ('610202', '王益区', '610200');
INSERT INTO `apparea` VALUES ('610203', '印台区', '610200');
INSERT INTO `apparea` VALUES ('610204', '耀州区', '610200');
INSERT INTO `apparea` VALUES ('610222', '宜君县', '610200');
INSERT INTO `apparea` VALUES ('610302', '渭滨区', '610300');
INSERT INTO `apparea` VALUES ('610303', '金台区', '610300');
INSERT INTO `apparea` VALUES ('610304', '陈仓区', '610300');
INSERT INTO `apparea` VALUES ('610322', '凤翔县', '610300');
INSERT INTO `apparea` VALUES ('610323', '岐山县', '610300');
INSERT INTO `apparea` VALUES ('610324', '扶风县', '610300');
INSERT INTO `apparea` VALUES ('610326', '眉　县', '610300');
INSERT INTO `apparea` VALUES ('610327', '陇　县', '610300');
INSERT INTO `apparea` VALUES ('610328', '千阳县', '610300');
INSERT INTO `apparea` VALUES ('610329', '麟游县', '610300');
INSERT INTO `apparea` VALUES ('610330', '凤　县', '610300');
INSERT INTO `apparea` VALUES ('610331', '太白县', '610300');
INSERT INTO `apparea` VALUES ('610402', '秦都区', '610400');
INSERT INTO `apparea` VALUES ('610403', '杨凌区', '610400');
INSERT INTO `apparea` VALUES ('610404', '渭城区', '610400');
INSERT INTO `apparea` VALUES ('610422', '三原县', '610400');
INSERT INTO `apparea` VALUES ('610423', '泾阳县', '610400');
INSERT INTO `apparea` VALUES ('610424', '乾　县', '610400');
INSERT INTO `apparea` VALUES ('610425', '礼泉县', '610400');
INSERT INTO `apparea` VALUES ('610426', '永寿县', '610400');
INSERT INTO `apparea` VALUES ('610427', '彬　县', '610400');
INSERT INTO `apparea` VALUES ('610428', '长武县', '610400');
INSERT INTO `apparea` VALUES ('610429', '旬邑县', '610400');
INSERT INTO `apparea` VALUES ('610430', '淳化县', '610400');
INSERT INTO `apparea` VALUES ('610431', '武功县', '610400');
INSERT INTO `apparea` VALUES ('610481', '兴平市', '610400');
INSERT INTO `apparea` VALUES ('610502', '临渭区', '610500');
INSERT INTO `apparea` VALUES ('610521', '华　县', '610500');
INSERT INTO `apparea` VALUES ('610522', '潼关县', '610500');
INSERT INTO `apparea` VALUES ('610523', '大荔县', '610500');
INSERT INTO `apparea` VALUES ('610524', '合阳县', '610500');
INSERT INTO `apparea` VALUES ('610525', '澄城县', '610500');
INSERT INTO `apparea` VALUES ('610526', '蒲城县', '610500');
INSERT INTO `apparea` VALUES ('610527', '白水县', '610500');
INSERT INTO `apparea` VALUES ('610528', '富平县', '610500');
INSERT INTO `apparea` VALUES ('610581', '韩城市', '610500');
INSERT INTO `apparea` VALUES ('610582', '华阴市', '610500');
INSERT INTO `apparea` VALUES ('610602', '宝塔区', '610600');
INSERT INTO `apparea` VALUES ('610621', '延长县', '610600');
INSERT INTO `apparea` VALUES ('610622', '延川县', '610600');
INSERT INTO `apparea` VALUES ('610623', '子长县', '610600');
INSERT INTO `apparea` VALUES ('610624', '安塞县', '610600');
INSERT INTO `apparea` VALUES ('610625', '志丹县', '610600');
INSERT INTO `apparea` VALUES ('610626', '吴旗县', '610600');
INSERT INTO `apparea` VALUES ('610627', '甘泉县', '610600');
INSERT INTO `apparea` VALUES ('610628', '富　县', '610600');
INSERT INTO `apparea` VALUES ('610629', '洛川县', '610600');
INSERT INTO `apparea` VALUES ('610630', '宜川县', '610600');
INSERT INTO `apparea` VALUES ('610631', '黄龙县', '610600');
INSERT INTO `apparea` VALUES ('610632', '黄陵县', '610600');
INSERT INTO `apparea` VALUES ('610702', '汉台区', '610700');
INSERT INTO `apparea` VALUES ('610721', '南郑县', '610700');
INSERT INTO `apparea` VALUES ('610722', '城固县', '610700');
INSERT INTO `apparea` VALUES ('610723', '洋　县', '610700');
INSERT INTO `apparea` VALUES ('610724', '西乡县', '610700');
INSERT INTO `apparea` VALUES ('610725', '勉　县', '610700');
INSERT INTO `apparea` VALUES ('610726', '宁强县', '610700');
INSERT INTO `apparea` VALUES ('610727', '略阳县', '610700');
INSERT INTO `apparea` VALUES ('610728', '镇巴县', '610700');
INSERT INTO `apparea` VALUES ('610729', '留坝县', '610700');
INSERT INTO `apparea` VALUES ('610730', '佛坪县', '610700');
INSERT INTO `apparea` VALUES ('610802', '榆阳区', '610800');
INSERT INTO `apparea` VALUES ('610821', '神木县', '610800');
INSERT INTO `apparea` VALUES ('610822', '府谷县', '610800');
INSERT INTO `apparea` VALUES ('610823', '横山县', '610800');
INSERT INTO `apparea` VALUES ('610824', '靖边县', '610800');
INSERT INTO `apparea` VALUES ('610825', '定边县', '610800');
INSERT INTO `apparea` VALUES ('610826', '绥德县', '610800');
INSERT INTO `apparea` VALUES ('610827', '米脂县', '610800');
INSERT INTO `apparea` VALUES ('610828', '佳　县', '610800');
INSERT INTO `apparea` VALUES ('610829', '吴堡县', '610800');
INSERT INTO `apparea` VALUES ('610830', '清涧县', '610800');
INSERT INTO `apparea` VALUES ('610831', '子洲县', '610800');
INSERT INTO `apparea` VALUES ('610902', '汉滨区', '610900');
INSERT INTO `apparea` VALUES ('610921', '汉阴县', '610900');
INSERT INTO `apparea` VALUES ('610922', '石泉县', '610900');
INSERT INTO `apparea` VALUES ('610923', '宁陕县', '610900');
INSERT INTO `apparea` VALUES ('610924', '紫阳县', '610900');
INSERT INTO `apparea` VALUES ('610925', '岚皋县', '610900');
INSERT INTO `apparea` VALUES ('610926', '平利县', '610900');
INSERT INTO `apparea` VALUES ('610927', '镇坪县', '610900');
INSERT INTO `apparea` VALUES ('610928', '旬阳县', '610900');
INSERT INTO `apparea` VALUES ('610929', '白河县', '610900');
INSERT INTO `apparea` VALUES ('611002', '商州区', '611000');
INSERT INTO `apparea` VALUES ('611021', '洛南县', '611000');
INSERT INTO `apparea` VALUES ('611022', '丹凤县', '611000');
INSERT INTO `apparea` VALUES ('611023', '商南县', '611000');
INSERT INTO `apparea` VALUES ('611024', '山阳县', '611000');
INSERT INTO `apparea` VALUES ('611025', '镇安县', '611000');
INSERT INTO `apparea` VALUES ('611026', '柞水县', '611000');
INSERT INTO `apparea` VALUES ('620102', '城关区', '620100');
INSERT INTO `apparea` VALUES ('620103', '七里河区', '620100');
INSERT INTO `apparea` VALUES ('620104', '西固区', '620100');
INSERT INTO `apparea` VALUES ('620105', '安宁区', '620100');
INSERT INTO `apparea` VALUES ('620111', '红古区', '620100');
INSERT INTO `apparea` VALUES ('620121', '永登县', '620100');
INSERT INTO `apparea` VALUES ('620122', '皋兰县', '620100');
INSERT INTO `apparea` VALUES ('620123', '榆中县', '620100');
INSERT INTO `apparea` VALUES ('620302', '金川区', '620300');
INSERT INTO `apparea` VALUES ('620321', '永昌县', '620300');
INSERT INTO `apparea` VALUES ('620402', '白银区', '620400');
INSERT INTO `apparea` VALUES ('620403', '平川区', '620400');
INSERT INTO `apparea` VALUES ('620421', '靖远县', '620400');
INSERT INTO `apparea` VALUES ('620422', '会宁县', '620400');
INSERT INTO `apparea` VALUES ('620423', '景泰县', '620400');
INSERT INTO `apparea` VALUES ('620502', '秦城区', '620500');
INSERT INTO `apparea` VALUES ('620503', '北道区', '620500');
INSERT INTO `apparea` VALUES ('620521', '清水县', '620500');
INSERT INTO `apparea` VALUES ('620522', '秦安县', '620500');
INSERT INTO `apparea` VALUES ('620523', '甘谷县', '620500');
INSERT INTO `apparea` VALUES ('620524', '武山县', '620500');
INSERT INTO `apparea` VALUES ('620525', '张家川回族自治县', '620500');
INSERT INTO `apparea` VALUES ('620602', '凉州区', '620600');
INSERT INTO `apparea` VALUES ('620621', '民勤县', '620600');
INSERT INTO `apparea` VALUES ('620622', '古浪县', '620600');
INSERT INTO `apparea` VALUES ('620623', '天祝藏族自治县', '620600');
INSERT INTO `apparea` VALUES ('620702', '甘州区', '620700');
INSERT INTO `apparea` VALUES ('620721', '肃南裕固族自治县', '620700');
INSERT INTO `apparea` VALUES ('620722', '民乐县', '620700');
INSERT INTO `apparea` VALUES ('620723', '临泽县', '620700');
INSERT INTO `apparea` VALUES ('620724', '高台县', '620700');
INSERT INTO `apparea` VALUES ('620725', '山丹县', '620700');
INSERT INTO `apparea` VALUES ('620802', '崆峒区', '620800');
INSERT INTO `apparea` VALUES ('620821', '泾川县', '620800');
INSERT INTO `apparea` VALUES ('620822', '灵台县', '620800');
INSERT INTO `apparea` VALUES ('620823', '崇信县', '620800');
INSERT INTO `apparea` VALUES ('620824', '华亭县', '620800');
INSERT INTO `apparea` VALUES ('620825', '庄浪县', '620800');
INSERT INTO `apparea` VALUES ('620826', '静宁县', '620800');
INSERT INTO `apparea` VALUES ('620902', '肃州区', '620900');
INSERT INTO `apparea` VALUES ('620921', '金塔县', '620900');
INSERT INTO `apparea` VALUES ('620922', '安西县', '620900');
INSERT INTO `apparea` VALUES ('620923', '肃北蒙古族自治县', '620900');
INSERT INTO `apparea` VALUES ('620924', '阿克塞哈萨克族自治县', '620900');
INSERT INTO `apparea` VALUES ('620981', '玉门市', '620900');
INSERT INTO `apparea` VALUES ('620982', '敦煌市', '620900');
INSERT INTO `apparea` VALUES ('621002', '西峰区', '621000');
INSERT INTO `apparea` VALUES ('621021', '庆城县', '621000');
INSERT INTO `apparea` VALUES ('621022', '环　县', '621000');
INSERT INTO `apparea` VALUES ('621023', '华池县', '621000');
INSERT INTO `apparea` VALUES ('621024', '合水县', '621000');
INSERT INTO `apparea` VALUES ('621025', '正宁县', '621000');
INSERT INTO `apparea` VALUES ('621026', '宁　县', '621000');
INSERT INTO `apparea` VALUES ('621027', '镇原县', '621000');
INSERT INTO `apparea` VALUES ('621102', '安定区', '621100');
INSERT INTO `apparea` VALUES ('621121', '通渭县', '621100');
INSERT INTO `apparea` VALUES ('621122', '陇西县', '621100');
INSERT INTO `apparea` VALUES ('621123', '渭源县', '621100');
INSERT INTO `apparea` VALUES ('621124', '临洮县', '621100');
INSERT INTO `apparea` VALUES ('621125', '漳　县', '621100');
INSERT INTO `apparea` VALUES ('621126', '岷　县', '621100');
INSERT INTO `apparea` VALUES ('621202', '武都区', '621200');
INSERT INTO `apparea` VALUES ('621221', '成　县', '621200');
INSERT INTO `apparea` VALUES ('621222', '文　县', '621200');
INSERT INTO `apparea` VALUES ('621223', '宕昌县', '621200');
INSERT INTO `apparea` VALUES ('621224', '康　县', '621200');
INSERT INTO `apparea` VALUES ('621225', '西和县', '621200');
INSERT INTO `apparea` VALUES ('621226', '礼　县', '621200');
INSERT INTO `apparea` VALUES ('621227', '徽　县', '621200');
INSERT INTO `apparea` VALUES ('621228', '两当县', '621200');
INSERT INTO `apparea` VALUES ('622901', '临夏市', '622900');
INSERT INTO `apparea` VALUES ('622921', '临夏县', '622900');
INSERT INTO `apparea` VALUES ('622922', '康乐县', '622900');
INSERT INTO `apparea` VALUES ('622923', '永靖县', '622900');
INSERT INTO `apparea` VALUES ('622924', '广河县', '622900');
INSERT INTO `apparea` VALUES ('622925', '和政县', '622900');
INSERT INTO `apparea` VALUES ('622926', '东乡族自治县', '622900');
INSERT INTO `apparea` VALUES ('622927', '积石山保安族东乡族撒拉族自治县', '622900');
INSERT INTO `apparea` VALUES ('623001', '合作市', '623000');
INSERT INTO `apparea` VALUES ('623021', '临潭县', '623000');
INSERT INTO `apparea` VALUES ('623022', '卓尼县', '623000');
INSERT INTO `apparea` VALUES ('623023', '舟曲县', '623000');
INSERT INTO `apparea` VALUES ('623024', '迭部县', '623000');
INSERT INTO `apparea` VALUES ('623025', '玛曲县', '623000');
INSERT INTO `apparea` VALUES ('623026', '碌曲县', '623000');
INSERT INTO `apparea` VALUES ('623027', '夏河县', '623000');
INSERT INTO `apparea` VALUES ('630102', '城东区', '630100');
INSERT INTO `apparea` VALUES ('630103', '城中区', '630100');
INSERT INTO `apparea` VALUES ('630104', '城西区', '630100');
INSERT INTO `apparea` VALUES ('630105', '城北区', '630100');
INSERT INTO `apparea` VALUES ('630121', '大通回族土族自治县', '630100');
INSERT INTO `apparea` VALUES ('630122', '湟中县', '630100');
INSERT INTO `apparea` VALUES ('630123', '湟源县', '630100');
INSERT INTO `apparea` VALUES ('632121', '平安县', '632100');
INSERT INTO `apparea` VALUES ('632122', '民和回族土族自治县', '632100');
INSERT INTO `apparea` VALUES ('632123', '乐都县', '632100');
INSERT INTO `apparea` VALUES ('632126', '互助土族自治县', '632100');
INSERT INTO `apparea` VALUES ('632127', '化隆回族自治县', '632100');
INSERT INTO `apparea` VALUES ('632128', '循化撒拉族自治县', '632100');
INSERT INTO `apparea` VALUES ('632221', '门源回族自治县', '632200');
INSERT INTO `apparea` VALUES ('632222', '祁连县', '632200');
INSERT INTO `apparea` VALUES ('632223', '海晏县', '632200');
INSERT INTO `apparea` VALUES ('632224', '刚察县', '632200');
INSERT INTO `apparea` VALUES ('632321', '同仁县', '632300');
INSERT INTO `apparea` VALUES ('632322', '尖扎县', '632300');
INSERT INTO `apparea` VALUES ('632323', '泽库县', '632300');
INSERT INTO `apparea` VALUES ('632324', '河南蒙古族自治县', '632300');
INSERT INTO `apparea` VALUES ('632521', '共和县', '632500');
INSERT INTO `apparea` VALUES ('632522', '同德县', '632500');
INSERT INTO `apparea` VALUES ('632523', '贵德县', '632500');
INSERT INTO `apparea` VALUES ('632524', '兴海县', '632500');
INSERT INTO `apparea` VALUES ('632525', '贵南县', '632500');
INSERT INTO `apparea` VALUES ('632621', '玛沁县', '632600');
INSERT INTO `apparea` VALUES ('632622', '班玛县', '632600');
INSERT INTO `apparea` VALUES ('632623', '甘德县', '632600');
INSERT INTO `apparea` VALUES ('632624', '达日县', '632600');
INSERT INTO `apparea` VALUES ('632625', '久治县', '632600');
INSERT INTO `apparea` VALUES ('632626', '玛多县', '632600');
INSERT INTO `apparea` VALUES ('632721', '玉树县', '632700');
INSERT INTO `apparea` VALUES ('632722', '杂多县', '632700');
INSERT INTO `apparea` VALUES ('632723', '称多县', '632700');
INSERT INTO `apparea` VALUES ('632724', '治多县', '632700');
INSERT INTO `apparea` VALUES ('632725', '囊谦县', '632700');
INSERT INTO `apparea` VALUES ('632726', '曲麻莱县', '632700');
INSERT INTO `apparea` VALUES ('632801', '格尔木市', '632800');
INSERT INTO `apparea` VALUES ('632802', '德令哈市', '632800');
INSERT INTO `apparea` VALUES ('632821', '乌兰县', '632800');
INSERT INTO `apparea` VALUES ('632822', '都兰县', '632800');
INSERT INTO `apparea` VALUES ('632823', '天峻县', '632800');
INSERT INTO `apparea` VALUES ('640104', '兴庆区', '640100');
INSERT INTO `apparea` VALUES ('640105', '西夏区', '640100');
INSERT INTO `apparea` VALUES ('640106', '金凤区', '640100');
INSERT INTO `apparea` VALUES ('640121', '永宁县', '640100');
INSERT INTO `apparea` VALUES ('640122', '贺兰县', '640100');
INSERT INTO `apparea` VALUES ('640181', '灵武市', '640100');
INSERT INTO `apparea` VALUES ('640202', '大武口区', '640200');
INSERT INTO `apparea` VALUES ('640205', '惠农区', '640200');
INSERT INTO `apparea` VALUES ('640221', '平罗县', '640200');
INSERT INTO `apparea` VALUES ('640302', '利通区', '640300');
INSERT INTO `apparea` VALUES ('640323', '盐池县', '640300');
INSERT INTO `apparea` VALUES ('640324', '同心县', '640300');
INSERT INTO `apparea` VALUES ('640381', '青铜峡市', '640300');
INSERT INTO `apparea` VALUES ('640402', '原州区', '640400');
INSERT INTO `apparea` VALUES ('640422', '西吉县', '640400');
INSERT INTO `apparea` VALUES ('640423', '隆德县', '640400');
INSERT INTO `apparea` VALUES ('640424', '泾源县', '640400');
INSERT INTO `apparea` VALUES ('640425', '彭阳县', '640400');
INSERT INTO `apparea` VALUES ('640502', '沙坡头区', '640500');
INSERT INTO `apparea` VALUES ('640521', '中宁县', '640500');
INSERT INTO `apparea` VALUES ('640522', '海原县', '640500');
INSERT INTO `apparea` VALUES ('650102', '天山区', '650100');
INSERT INTO `apparea` VALUES ('650103', '沙依巴克区', '650100');
INSERT INTO `apparea` VALUES ('650104', '新市区', '650100');
INSERT INTO `apparea` VALUES ('650105', '水磨沟区', '650100');
INSERT INTO `apparea` VALUES ('650106', '头屯河区', '650100');
INSERT INTO `apparea` VALUES ('650107', '达坂城区', '650100');
INSERT INTO `apparea` VALUES ('650108', '东山区', '650100');
INSERT INTO `apparea` VALUES ('650121', '乌鲁木齐县', '650100');
INSERT INTO `apparea` VALUES ('650202', '独山子区', '650200');
INSERT INTO `apparea` VALUES ('650203', '克拉玛依区', '650200');
INSERT INTO `apparea` VALUES ('650204', '白碱滩区', '650200');
INSERT INTO `apparea` VALUES ('650205', '乌尔禾区', '650200');
INSERT INTO `apparea` VALUES ('652101', '吐鲁番市', '652100');
INSERT INTO `apparea` VALUES ('652122', '鄯善县', '652100');
INSERT INTO `apparea` VALUES ('652123', '托克逊县', '652100');
INSERT INTO `apparea` VALUES ('652201', '哈密市', '652200');
INSERT INTO `apparea` VALUES ('652222', '巴里坤哈萨克自治县', '652200');
INSERT INTO `apparea` VALUES ('652223', '伊吾县', '652200');
INSERT INTO `apparea` VALUES ('652301', '昌吉市', '652300');
INSERT INTO `apparea` VALUES ('652302', '阜康市', '652300');
INSERT INTO `apparea` VALUES ('652303', '米泉市', '652300');
INSERT INTO `apparea` VALUES ('652323', '呼图壁县', '652300');
INSERT INTO `apparea` VALUES ('652324', '玛纳斯县', '652300');
INSERT INTO `apparea` VALUES ('652325', '奇台县', '652300');
INSERT INTO `apparea` VALUES ('652327', '吉木萨尔县', '652300');
INSERT INTO `apparea` VALUES ('652328', '木垒哈萨克自治县', '652300');
INSERT INTO `apparea` VALUES ('652701', '博乐市', '652700');
INSERT INTO `apparea` VALUES ('652722', '精河县', '652700');
INSERT INTO `apparea` VALUES ('652723', '温泉县', '652700');
INSERT INTO `apparea` VALUES ('652801', '库尔勒市', '652800');
INSERT INTO `apparea` VALUES ('652822', '轮台县', '652800');
INSERT INTO `apparea` VALUES ('652823', '尉犁县', '652800');
INSERT INTO `apparea` VALUES ('652824', '若羌县', '652800');
INSERT INTO `apparea` VALUES ('652825', '且末县', '652800');
INSERT INTO `apparea` VALUES ('652826', '焉耆回族自治县', '652800');
INSERT INTO `apparea` VALUES ('652827', '和静县', '652800');
INSERT INTO `apparea` VALUES ('652828', '和硕县', '652800');
INSERT INTO `apparea` VALUES ('652829', '博湖县', '652800');
INSERT INTO `apparea` VALUES ('652901', '阿克苏市', '652900');
INSERT INTO `apparea` VALUES ('652922', '温宿县', '652900');
INSERT INTO `apparea` VALUES ('652923', '库车县', '652900');
INSERT INTO `apparea` VALUES ('652924', '沙雅县', '652900');
INSERT INTO `apparea` VALUES ('652925', '新和县', '652900');
INSERT INTO `apparea` VALUES ('652926', '拜城县', '652900');
INSERT INTO `apparea` VALUES ('652927', '乌什县', '652900');
INSERT INTO `apparea` VALUES ('652928', '阿瓦提县', '652900');
INSERT INTO `apparea` VALUES ('652929', '柯坪县', '652900');
INSERT INTO `apparea` VALUES ('653001', '阿图什市', '653000');
INSERT INTO `apparea` VALUES ('653022', '阿克陶县', '653000');
INSERT INTO `apparea` VALUES ('653023', '阿合奇县', '653000');
INSERT INTO `apparea` VALUES ('653024', '乌恰县', '653000');
INSERT INTO `apparea` VALUES ('653101', '喀什市', '653100');
INSERT INTO `apparea` VALUES ('653121', '疏附县', '653100');
INSERT INTO `apparea` VALUES ('653122', '疏勒县', '653100');
INSERT INTO `apparea` VALUES ('653123', '英吉沙县', '653100');
INSERT INTO `apparea` VALUES ('653124', '泽普县', '653100');
INSERT INTO `apparea` VALUES ('653125', '莎车县', '653100');
INSERT INTO `apparea` VALUES ('653126', '叶城县', '653100');
INSERT INTO `apparea` VALUES ('653127', '麦盖提县', '653100');
INSERT INTO `apparea` VALUES ('653128', '岳普湖县', '653100');
INSERT INTO `apparea` VALUES ('653129', '伽师县', '653100');
INSERT INTO `apparea` VALUES ('653130', '巴楚县', '653100');
INSERT INTO `apparea` VALUES ('653131', '塔什库尔干塔吉克自治县', '653100');
INSERT INTO `apparea` VALUES ('653201', '和田市', '653200');
INSERT INTO `apparea` VALUES ('653221', '和田县', '653200');
INSERT INTO `apparea` VALUES ('653222', '墨玉县', '653200');
INSERT INTO `apparea` VALUES ('653223', '皮山县', '653200');
INSERT INTO `apparea` VALUES ('653224', '洛浦县', '653200');
INSERT INTO `apparea` VALUES ('653225', '策勒县', '653200');
INSERT INTO `apparea` VALUES ('653226', '于田县', '653200');
INSERT INTO `apparea` VALUES ('653227', '民丰县', '653200');
INSERT INTO `apparea` VALUES ('654002', '伊宁市', '654000');
INSERT INTO `apparea` VALUES ('654003', '奎屯市', '654000');
INSERT INTO `apparea` VALUES ('654021', '伊宁县', '654000');
INSERT INTO `apparea` VALUES ('654022', '察布查尔锡伯自治县', '654000');
INSERT INTO `apparea` VALUES ('654023', '霍城县', '654000');
INSERT INTO `apparea` VALUES ('654024', '巩留县', '654000');
INSERT INTO `apparea` VALUES ('654025', '新源县', '654000');
INSERT INTO `apparea` VALUES ('654026', '昭苏县', '654000');
INSERT INTO `apparea` VALUES ('654027', '特克斯县', '654000');
INSERT INTO `apparea` VALUES ('654028', '尼勒克县', '654000');
INSERT INTO `apparea` VALUES ('654201', '塔城市', '654200');
INSERT INTO `apparea` VALUES ('654202', '乌苏市', '654200');
INSERT INTO `apparea` VALUES ('654221', '额敏县', '654200');
INSERT INTO `apparea` VALUES ('654223', '沙湾县', '654200');
INSERT INTO `apparea` VALUES ('654224', '托里县', '654200');
INSERT INTO `apparea` VALUES ('654225', '裕民县', '654200');
INSERT INTO `apparea` VALUES ('654226', '和布克赛尔蒙古自治县', '654200');
INSERT INTO `apparea` VALUES ('654301', '阿勒泰市', '654300');
INSERT INTO `apparea` VALUES ('654321', '布尔津县', '654300');
INSERT INTO `apparea` VALUES ('654322', '富蕴县', '654300');
INSERT INTO `apparea` VALUES ('654323', '福海县', '654300');
INSERT INTO `apparea` VALUES ('654324', '哈巴河县', '654300');
INSERT INTO `apparea` VALUES ('654325', '青河县', '654300');
INSERT INTO `apparea` VALUES ('654326', '吉木乃县', '654300');
INSERT INTO `apparea` VALUES ('659001', '石河子市', '659000');
INSERT INTO `apparea` VALUES ('659002', '阿拉尔市', '659000');
INSERT INTO `apparea` VALUES ('659003', '图木舒克市', '659000');
INSERT INTO `apparea` VALUES ('659004', '五家渠市', '659000');
INSERT INTO `apparea` VALUES ('710000', '台湾省', '710000');
INSERT INTO `apparea` VALUES ('810000', '香 港', '810000');
INSERT INTO `apparea` VALUES ('820000', '澳 门', '820000');

-- ----------------------------
-- Table structure for appcity
-- ----------------------------
DROP TABLE IF EXISTS `appcity`;
CREATE TABLE `appcity` (
  `cid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市ID',
  `cname` varchar(50) DEFAULT '' COMMENT '城市名称',
  `pid` int(11) unsigned DEFAULT '0' COMMENT '省份ID',
  `orderid` int(11) DEFAULT '0' COMMENT '行数',
  `areaCode` varchar(10) DEFAULT '' COMMENT '区号',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appcity
-- ----------------------------
INSERT INTO `appcity` VALUES ('110100', '北京市', '110000', '100', '');
INSERT INTO `appcity` VALUES ('120100', '天津市', '120000', '100', '');
INSERT INTO `appcity` VALUES ('130100', '石家庄市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130200', '唐山市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130300', '秦皇岛市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130400', '邯郸市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130500', '邢台市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130600', '保定市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130700', '张家口市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130800', '承德市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('130900', '沧州市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('131000', '廊坊市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('131100', '衡水市', '130000', '100', '');
INSERT INTO `appcity` VALUES ('140100', '太原市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140200', '大同市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140300', '阳泉市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140400', '长治市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140500', '晋城市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140600', '朔州市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140700', '晋中市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140800', '运城市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('140900', '忻州市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('141000', '临汾市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('141100', '吕梁市', '140000', '100', '');
INSERT INTO `appcity` VALUES ('150100', '呼和浩特市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150200', '包头市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150300', '乌海市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150400', '赤峰市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150500', '通辽市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150600', '鄂尔多斯市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150700', '呼伦贝尔市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150800', '巴彦淖尔市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('150900', '乌兰察布市', '150000', '100', '');
INSERT INTO `appcity` VALUES ('152200', '兴安盟', '150000', '100', '');
INSERT INTO `appcity` VALUES ('152500', '锡林郭勒盟', '150000', '100', '');
INSERT INTO `appcity` VALUES ('152900', '阿拉善盟', '150000', '100', '');
INSERT INTO `appcity` VALUES ('210100', '沈阳市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210200', '大连市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210300', '鞍山市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210400', '抚顺市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210500', '本溪市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210600', '丹东市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210700', '锦州市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210800', '营口市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('210900', '阜新市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('211000', '辽阳市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('211100', '盘锦市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('211200', '铁岭市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('211300', '朝阳市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('211400', '葫芦岛市', '210000', '100', '');
INSERT INTO `appcity` VALUES ('220100', '长春市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('220200', '吉林市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('220300', '四平市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('220400', '辽源市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('220500', '通化市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('220600', '白山市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('220700', '松原市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('220800', '白城市', '220000', '100', '');
INSERT INTO `appcity` VALUES ('222400', '延边朝鲜族自治州', '220000', '100', '');
INSERT INTO `appcity` VALUES ('230100', '哈尔滨市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230200', '齐齐哈尔市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230300', '鸡西市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230400', '鹤岗市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230500', '双鸭山市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230600', '大庆市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230700', '伊春市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230800', '佳木斯市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('230900', '七台河市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('231000', '牡丹江市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('231100', '黑河市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('231200', '绥化市', '230000', '100', '');
INSERT INTO `appcity` VALUES ('232700', '大兴安岭地区', '230000', '100', '');
INSERT INTO `appcity` VALUES ('310100', '市辖区', '310000', '100', '');
INSERT INTO `appcity` VALUES ('310200', '县', '310000', '100', '');
INSERT INTO `appcity` VALUES ('320100', '南京市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320200', '无锡市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320300', '徐州市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320400', '常州市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320500', '苏州市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320600', '南通市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320700', '连云港市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320800', '淮安市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('320900', '盐城市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('321000', '扬州市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('321100', '镇江市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('321200', '泰州市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('321300', '宿迁市', '320000', '100', '');
INSERT INTO `appcity` VALUES ('330100', '杭州市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330200', '宁波市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330300', '温州市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330400', '嘉兴市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330500', '湖州市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330600', '绍兴市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330700', '金华市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330800', '衢州市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('330900', '舟山市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('331000', '台州市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('331100', '丽水市', '330000', '100', '');
INSERT INTO `appcity` VALUES ('340100', '合肥市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('340200', '芜湖市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('340300', '蚌埠市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('340400', '淮南市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('340500', '马鞍山市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('340600', '淮北市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('340700', '铜陵市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('340800', '安庆市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341000', '黄山市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341100', '滁州市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341200', '阜阳市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341300', '宿州市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341400', '巢湖市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341500', '六安市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341600', '亳州市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341700', '池州市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('341800', '宣城市', '340000', '100', '');
INSERT INTO `appcity` VALUES ('350100', '福州市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350200', '厦门市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350300', '莆田市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350400', '三明市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350500', '泉州市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350600', '漳州市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350700', '南平市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350800', '龙岩市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('350900', '宁德市', '350000', '100', '');
INSERT INTO `appcity` VALUES ('360100', '南昌市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360200', '景德镇市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360300', '萍乡市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360400', '九江市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360500', '新余市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360600', '鹰潭市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360700', '赣州市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360800', '吉安市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('360900', '宜春市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('361000', '抚州市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('361100', '上饶市', '360000', '100', '');
INSERT INTO `appcity` VALUES ('370100', '济南市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370200', '青岛市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370300', '淄博市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370400', '枣庄市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370500', '东营市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370600', '烟台市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370700', '潍坊市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370800', '济宁市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('370900', '泰安市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371000', '威海市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371100', '日照市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371200', '莱芜市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371300', '临沂市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371400', '德州市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371500', '聊城市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371600', '滨州市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('371700', '荷泽市', '370000', '100', '');
INSERT INTO `appcity` VALUES ('410100', '郑州市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410200', '开封市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410300', '洛阳市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410400', '平顶山市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410500', '安阳市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410600', '鹤壁市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410700', '新乡市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410800', '焦作市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('410900', '濮阳市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411000', '许昌市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411100', '漯河市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411200', '三门峡市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411300', '南阳市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411400', '商丘市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411500', '信阳市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411600', '周口市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('411700', '驻马店市', '410000', '100', '');
INSERT INTO `appcity` VALUES ('420100', '武汉市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('420200', '黄石市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('420300', '十堰市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('420500', '宜昌市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('420600', '襄樊市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('420700', '鄂州市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('420800', '荆门市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('420900', '孝感市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('421000', '荆州市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('421100', '黄冈市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('421200', '咸宁市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('421300', '随州市', '420000', '100', '');
INSERT INTO `appcity` VALUES ('422800', '恩施土家族苗族自治州', '420000', '100', '');
INSERT INTO `appcity` VALUES ('429000', '省直辖行政单位', '420000', '100', '');
INSERT INTO `appcity` VALUES ('430100', '长沙市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430200', '株洲市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430300', '湘潭市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430400', '衡阳市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430500', '邵阳市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430600', '岳阳市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430700', '常德市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430800', '张家界市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('430900', '益阳市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('431000', '郴州市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('431100', '永州市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('431200', '怀化市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('431300', '娄底市', '430000', '100', '');
INSERT INTO `appcity` VALUES ('433100', '湘西土家族苗族自治州', '430000', '100', '');
INSERT INTO `appcity` VALUES ('440100', '广州市', '440000', '1', '020');
INSERT INTO `appcity` VALUES ('440200', '韶关市', '440000', '4', '123');
INSERT INTO `appcity` VALUES ('440300', '深圳市', '440000', '100', '000');
INSERT INTO `appcity` VALUES ('440400', '珠海市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('440500', '汕头市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('440600', '佛山市', '440000', '8', '');
INSERT INTO `appcity` VALUES ('440700', '江门市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('440800', '湛江市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('440900', '茂名市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('441200', '肇庆市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('441300', '惠州市', '440000', '7', '');
INSERT INTO `appcity` VALUES ('441400', '梅州市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('441500', '汕尾市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('441600', '河源市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('441700', '阳江市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('441800', '清远市', '440000', '3', '');
INSERT INTO `appcity` VALUES ('441900', '东莞市', '440000', '6', '');
INSERT INTO `appcity` VALUES ('442000', '中山市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('445100', '潮州市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('445200', '揭阳市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('445300', '云浮市', '440000', '100', '');
INSERT INTO `appcity` VALUES ('445400', '花都市', '440000', '2', '');
INSERT INTO `appcity` VALUES ('445500', '英德市', '440000', '5', '');
INSERT INTO `appcity` VALUES ('450100', '南宁市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450200', '柳州市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450300', '桂林市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450400', '梧州市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450500', '北海市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450600', '防城港市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450700', '钦州市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450800', '贵港市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('450900', '玉林市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('451000', '百色市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('451100', '贺州市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('451200', '河池市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('451300', '来宾市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('451400', '崇左市', '450000', '100', '');
INSERT INTO `appcity` VALUES ('460100', '海口市', '460000', '100', '');
INSERT INTO `appcity` VALUES ('460200', '三亚市', '460000', '100', '');
INSERT INTO `appcity` VALUES ('469000', '省直辖县级行政单位', '460000', '100', '');
INSERT INTO `appcity` VALUES ('500100', '市辖区', '500000', '100', '');
INSERT INTO `appcity` VALUES ('500200', '县', '500000', '100', '');
INSERT INTO `appcity` VALUES ('500300', '市', '500000', '100', '');
INSERT INTO `appcity` VALUES ('510100', '成都市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('510300', '自贡市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('510400', '攀枝花市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('510500', '泸州市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('510600', '德阳市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('510700', '绵阳市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('510800', '广元市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('510900', '遂宁市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511000', '内江市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511100', '乐山市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511300', '南充市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511400', '眉山市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511500', '宜宾市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511600', '广安市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511700', '达州市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511800', '雅安市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('511900', '巴中市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('512000', '资阳市', '510000', '100', '');
INSERT INTO `appcity` VALUES ('513200', '阿坝藏族羌族自治州', '510000', '100', '');
INSERT INTO `appcity` VALUES ('513300', '甘孜藏族自治州', '510000', '100', '');
INSERT INTO `appcity` VALUES ('513400', '凉山彝族自治州', '510000', '100', '');
INSERT INTO `appcity` VALUES ('520100', '贵阳市', '520000', '100', '');
INSERT INTO `appcity` VALUES ('520200', '六盘水市', '520000', '100', '');
INSERT INTO `appcity` VALUES ('520300', '遵义市', '520000', '100', '');
INSERT INTO `appcity` VALUES ('520400', '安顺市', '520000', '100', '');
INSERT INTO `appcity` VALUES ('522200', '铜仁地区', '520000', '100', '');
INSERT INTO `appcity` VALUES ('522300', '黔西南布依族苗族自治州', '520000', '100', '');
INSERT INTO `appcity` VALUES ('522400', '毕节地区', '520000', '100', '');
INSERT INTO `appcity` VALUES ('522600', '黔东南苗族侗族自治州', '520000', '100', '');
INSERT INTO `appcity` VALUES ('522700', '黔南布依族苗族自治州', '520000', '100', '');
INSERT INTO `appcity` VALUES ('530100', '昆明市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('530300', '曲靖市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('530400', '玉溪市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('530500', '保山市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('530600', '昭通市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('530700', '丽江市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('530800', '思茅市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('530900', '临沧市', '530000', '100', '');
INSERT INTO `appcity` VALUES ('532300', '楚雄彝族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('532500', '红河哈尼族彝族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('532600', '文山壮族苗族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('532800', '西双版纳傣族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('532900', '大理白族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('533100', '德宏傣族景颇族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('533300', '怒江傈僳族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('533400', '迪庆藏族自治州', '530000', '100', '');
INSERT INTO `appcity` VALUES ('540100', '拉萨市', '540000', '100', '');
INSERT INTO `appcity` VALUES ('542100', '昌都地区', '540000', '100', '');
INSERT INTO `appcity` VALUES ('542200', '山南地区', '540000', '100', '');
INSERT INTO `appcity` VALUES ('542300', '日喀则地区', '540000', '100', '');
INSERT INTO `appcity` VALUES ('542400', '那曲地区', '540000', '100', '');
INSERT INTO `appcity` VALUES ('542500', '阿里地区', '540000', '100', '');
INSERT INTO `appcity` VALUES ('542600', '林芝地区', '540000', '100', '');
INSERT INTO `appcity` VALUES ('610100', '西安市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610200', '铜川市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610300', '宝鸡市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610400', '咸阳市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610500', '渭南市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610600', '延安市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610700', '汉中市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610800', '榆林市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('610900', '安康市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('611000', '商洛市', '610000', '100', '');
INSERT INTO `appcity` VALUES ('620100', '兰州市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620200', '嘉峪关市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620300', '金昌市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620400', '白银市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620500', '天水市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620600', '武威市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620700', '张掖市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620800', '平凉市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('620900', '酒泉市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('621000', '庆阳市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('621100', '定西市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('621200', '陇南市', '620000', '100', '');
INSERT INTO `appcity` VALUES ('622900', '临夏回族自治州', '620000', '100', '');
INSERT INTO `appcity` VALUES ('623000', '甘南藏族自治州', '620000', '100', '');
INSERT INTO `appcity` VALUES ('630100', '西宁市', '630000', '100', '');
INSERT INTO `appcity` VALUES ('632100', '海东地区', '630000', '100', '');
INSERT INTO `appcity` VALUES ('632200', '海北藏族自治州', '630000', '100', '');
INSERT INTO `appcity` VALUES ('632300', '黄南藏族自治州', '630000', '100', '');
INSERT INTO `appcity` VALUES ('632500', '海南藏族自治州', '630000', '100', '');
INSERT INTO `appcity` VALUES ('632600', '果洛藏族自治州', '630000', '100', '');
INSERT INTO `appcity` VALUES ('632700', '玉树藏族自治州', '630000', '100', '');
INSERT INTO `appcity` VALUES ('632800', '海西蒙古族藏族自治州', '630000', '100', '');
INSERT INTO `appcity` VALUES ('640100', '银川市', '640000', '100', '');
INSERT INTO `appcity` VALUES ('640200', '石嘴山市', '640000', '100', '');
INSERT INTO `appcity` VALUES ('640300', '吴忠市', '640000', '100', '');
INSERT INTO `appcity` VALUES ('640400', '固原市', '640000', '100', '');
INSERT INTO `appcity` VALUES ('640500', '中卫市', '640000', '100', '');
INSERT INTO `appcity` VALUES ('650100', '乌鲁木齐市', '650000', '100', '');
INSERT INTO `appcity` VALUES ('650200', '克拉玛依市', '650000', '100', '');
INSERT INTO `appcity` VALUES ('652100', '吐鲁番地区', '650000', '100', '');
INSERT INTO `appcity` VALUES ('652200', '哈密地区', '650000', '100', '');
INSERT INTO `appcity` VALUES ('652300', '昌吉回族自治州', '650000', '100', '');
INSERT INTO `appcity` VALUES ('652700', '博尔塔拉蒙古自治州', '650000', '100', '');
INSERT INTO `appcity` VALUES ('652800', '巴音郭楞蒙古自治州', '650000', '100', '');
INSERT INTO `appcity` VALUES ('652900', '阿克苏地区', '650000', '100', '');
INSERT INTO `appcity` VALUES ('653000', '克孜勒苏柯尔克孜自治州', '650000', '100', '');
INSERT INTO `appcity` VALUES ('653100', '喀什地区', '650000', '100', '');
INSERT INTO `appcity` VALUES ('653200', '和田地区', '650000', '100', '');
INSERT INTO `appcity` VALUES ('654000', '伊犁哈萨克自治州', '650000', '100', '');
INSERT INTO `appcity` VALUES ('654200', '塔城地区', '650000', '100', '');
INSERT INTO `appcity` VALUES ('654300', '阿勒泰地区', '650000', '100', '');
INSERT INTO `appcity` VALUES ('659000', '省直辖行政单位', '650000', '100', '');
INSERT INTO `appcity` VALUES ('710000', '台湾省', '710000', '100', '');
INSERT INTO `appcity` VALUES ('810000', '香  港', '810000', '100', '');
INSERT INTO `appcity` VALUES ('820000', '澳  门', '820000', '100', '');

-- ----------------------------
-- Table structure for appconftype
-- ----------------------------
DROP TABLE IF EXISTS `appconftype`;
CREATE TABLE `appconftype` (
  `typeencode` varchar(30) NOT NULL COMMENT '类型编码',
  `typename` varchar(30) DEFAULT '' COMMENT '类型名称',
  PRIMARY KEY (`typeencode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appconftype
-- ----------------------------
INSERT INTO `appconftype` VALUES ('A001', '出货单状态');
INSERT INTO `appconftype` VALUES ('A002', '订单类型');
INSERT INTO `appconftype` VALUES ('A003', '订单状态');
INSERT INTO `appconftype` VALUES ('A004', '发票类型');
INSERT INTO `appconftype` VALUES ('A005', '工号所在组');
INSERT INTO `appconftype` VALUES ('A006', '跟进标签');
INSERT INTO `appconftype` VALUES ('A007', '购买次数');
INSERT INTO `appconftype` VALUES ('A008', '进线方式');
INSERT INTO `appconftype` VALUES ('A009', '库存数');
INSERT INTO `appconftype` VALUES ('A010', '快递单状态');
INSERT INTO `appconftype` VALUES ('A011', '快递公司');
INSERT INTO `appconftype` VALUES ('A012', '客户等级');
INSERT INTO `appconftype` VALUES ('A013', '客户来源');
INSERT INTO `appconftype` VALUES ('A014', '客户收入');
INSERT INTO `appconftype` VALUES ('A015', '客户学历');
INSERT INTO `appconftype` VALUES ('A016', '客户意向');
INSERT INTO `appconftype` VALUES ('A017', '客户职业');
INSERT INTO `appconftype` VALUES ('A018', '是否成交');
INSERT INTO `appconftype` VALUES ('A019', '是否处理');
INSERT INTO `appconftype` VALUES ('A020', '是否记账');
INSERT INTO `appconftype` VALUES ('A021', '是否完成');
INSERT INTO `appconftype` VALUES ('A022', '审核状态');
INSERT INTO `appconftype` VALUES ('A023', '手机类型');
INSERT INTO `appconftype` VALUES ('A024', '支付方式');
INSERT INTO `appconftype` VALUES ('A025', '供应商');
INSERT INTO `appconftype` VALUES ('A026', '电话黑名单');
INSERT INTO `appconftype` VALUES ('A029', '职业');
INSERT INTO `appconftype` VALUES ('A030', '短信关键字');
INSERT INTO `appconftype` VALUES ('A031', '处理结果');
INSERT INTO `appconftype` VALUES ('A032', '电话加拨');
INSERT INTO `appconftype` VALUES ('A033', '数据字段');
INSERT INTO `appconftype` VALUES ('A034', '默认省市区信息');
INSERT INTO `appconftype` VALUES ('A035', '异动原因');
INSERT INTO `appconftype` VALUES ('A036', '号码屏蔽');

-- ----------------------------
-- Table structure for appprovince
-- ----------------------------
DROP TABLE IF EXISTS `appprovince`;
CREATE TABLE `appprovince` (
  `pid` int(11) unsigned NOT NULL COMMENT '省份ID',
  `pname` varchar(50) DEFAULT NULL COMMENT '省份名称',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appprovince
-- ----------------------------
INSERT INTO `appprovince` VALUES ('110000', '北京市');
INSERT INTO `appprovince` VALUES ('120000', '天津市');
INSERT INTO `appprovince` VALUES ('130000', '河北省');
INSERT INTO `appprovince` VALUES ('140000', '山西省');
INSERT INTO `appprovince` VALUES ('150000', '内蒙古');
INSERT INTO `appprovince` VALUES ('210000', '辽宁省');
INSERT INTO `appprovince` VALUES ('220000', '吉林省');
INSERT INTO `appprovince` VALUES ('230000', '黑龙江');
INSERT INTO `appprovince` VALUES ('310000', '上海市');
INSERT INTO `appprovince` VALUES ('320000', '江苏省');
INSERT INTO `appprovince` VALUES ('330000', '浙江省');
INSERT INTO `appprovince` VALUES ('340000', '安徽省');
INSERT INTO `appprovince` VALUES ('350000', '福建省');
INSERT INTO `appprovince` VALUES ('360000', '江西省');
INSERT INTO `appprovince` VALUES ('370000', '山东省');
INSERT INTO `appprovince` VALUES ('410000', '河南省');
INSERT INTO `appprovince` VALUES ('420000', '湖北省');
INSERT INTO `appprovince` VALUES ('430000', '湖南省');
INSERT INTO `appprovince` VALUES ('440000', '广东省');
INSERT INTO `appprovince` VALUES ('450000', '广西省');
INSERT INTO `appprovince` VALUES ('460000', '海南省');
INSERT INTO `appprovince` VALUES ('500000', '重庆市');
INSERT INTO `appprovince` VALUES ('510000', '四川省');
INSERT INTO `appprovince` VALUES ('520000', '贵州省');
INSERT INTO `appprovince` VALUES ('530000', '云南省');
INSERT INTO `appprovince` VALUES ('540000', '西  藏');
INSERT INTO `appprovince` VALUES ('610000', '陕西省');
INSERT INTO `appprovince` VALUES ('620000', '甘肃省');
INSERT INTO `appprovince` VALUES ('630000', '青海省');
INSERT INTO `appprovince` VALUES ('640000', '宁  夏');
INSERT INTO `appprovince` VALUES ('650000', '新  疆');
INSERT INTO `appprovince` VALUES ('710000', '台湾省');
INSERT INTO `appprovince` VALUES ('810000', '香  港');
INSERT INTO `appprovince` VALUES ('820000', '澳  门');

-- ----------------------------
-- Table structure for apprightlist
-- ----------------------------
DROP TABLE IF EXISTS `apprightlist`;
CREATE TABLE `apprightlist` (
  `groupbh` varchar(30) DEFAULT NULL COMMENT '权限组名',
  `rightbh` varchar(30) DEFAULT NULL COMMENT '权限位编号',
  `systemid` varchar(30) DEFAULT NULL COMMENT '系统标示',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1447 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of apprightlist
-- ----------------------------
INSERT INTO `apprightlist` VALUES ('gr15110007', '1', '', '15');
INSERT INTO `apprightlist` VALUES ('gr15110007', '12', '', '16');
INSERT INTO `apprightlist` VALUES ('gr15110007', '13', '', '17');
INSERT INTO `apprightlist` VALUES ('gr15110007', '14', '', '18');
INSERT INTO `apprightlist` VALUES ('gr15110007', '15', '', '19');
INSERT INTO `apprightlist` VALUES ('gr15110007', '2', '', '20');
INSERT INTO `apprightlist` VALUES ('gr15110007', '21', '', '21');
INSERT INTO `apprightlist` VALUES ('gr15120011', '1', '', '112');
INSERT INTO `apprightlist` VALUES ('gr15120011', '12', '', '113');
INSERT INTO `apprightlist` VALUES ('gr15120011', '13', '', '114');
INSERT INTO `apprightlist` VALUES ('gr15120011', '14', '', '115');
INSERT INTO `apprightlist` VALUES ('gr15120011', '15', '', '116');
INSERT INTO `apprightlist` VALUES ('gr15120011', '16', '', '117');
INSERT INTO `apprightlist` VALUES ('gr15120011', '17', '', '118');
INSERT INTO `apprightlist` VALUES ('gr15120011', '2', '', '119');
INSERT INTO `apprightlist` VALUES ('gr15120011', '20', '', '120');
INSERT INTO `apprightlist` VALUES ('gr15120011', '21', '', '121');
INSERT INTO `apprightlist` VALUES ('gr15120011', '6', '', '122');
INSERT INTO `apprightlist` VALUES ('gr15120011', '48', '', '123');
INSERT INTO `apprightlist` VALUES ('gr15120011', '8', '', '124');
INSERT INTO `apprightlist` VALUES ('gr15120011', '73', '', '125');
INSERT INTO `apprightlist` VALUES ('gr15120011', '74', '', '126');
INSERT INTO `apprightlist` VALUES ('gr15120011', '10', '', '127');
INSERT INTO `apprightlist` VALUES ('gr15120011', '80', '', '128');
INSERT INTO `apprightlist` VALUES ('gr15120011', '11', '', '129');
INSERT INTO `apprightlist` VALUES ('gr15120011', '82', '', '130');
INSERT INTO `apprightlist` VALUES ('gr15120011', '85', '', '131');
INSERT INTO `apprightlist` VALUES ('gr15120013', '1', '', '155');
INSERT INTO `apprightlist` VALUES ('gr15120013', '13', '', '156');
INSERT INTO `apprightlist` VALUES ('gr15120013', '2', '', '157');
INSERT INTO `apprightlist` VALUES ('gr15120013', '20', '', '158');
INSERT INTO `apprightlist` VALUES ('gr15120013', '21', '', '159');
INSERT INTO `apprightlist` VALUES ('gr15120013', '3', '', '160');
INSERT INTO `apprightlist` VALUES ('gr15120013', '24', '', '161');
INSERT INTO `apprightlist` VALUES ('gr15120013', '28', '', '162');
INSERT INTO `apprightlist` VALUES ('gr15120013', '4', '', '163');
INSERT INTO `apprightlist` VALUES ('gr15120013', '33', '', '164');
INSERT INTO `apprightlist` VALUES ('gr15120013', '34', '', '165');
INSERT INTO `apprightlist` VALUES ('gr15120013', '35', '', '166');
INSERT INTO `apprightlist` VALUES ('gr15120013', '36', '', '167');
INSERT INTO `apprightlist` VALUES ('gr15120013', '7', '', '168');
INSERT INTO `apprightlist` VALUES ('gr15120013', '66', '', '169');
INSERT INTO `apprightlist` VALUES ('gr15120013', '67', '', '170');
INSERT INTO `apprightlist` VALUES ('gr15120013', '68', '', '171');
INSERT INTO `apprightlist` VALUES ('gr15120013', '69', '', '172');
INSERT INTO `apprightlist` VALUES ('gr15120013', '70', '', '173');
INSERT INTO `apprightlist` VALUES ('gr15120013', '71', '', '174');
INSERT INTO `apprightlist` VALUES ('gr15120013', '72', '', '175');
INSERT INTO `apprightlist` VALUES ('gr15120013', '10', '', '176');
INSERT INTO `apprightlist` VALUES ('gr15120013', '80', '', '177');
INSERT INTO `apprightlist` VALUES ('gr15120013', '81', '', '178');
INSERT INTO `apprightlist` VALUES ('gr15120013', '11', '', '179');
INSERT INTO `apprightlist` VALUES ('gr15120013', '85', '', '180');
INSERT INTO `apprightlist` VALUES ('gr15120014', '3', '', '232');
INSERT INTO `apprightlist` VALUES ('gr15120014', '22', '', '233');
INSERT INTO `apprightlist` VALUES ('gr15120014', '23', '', '234');
INSERT INTO `apprightlist` VALUES ('gr15120014', '24', '', '235');
INSERT INTO `apprightlist` VALUES ('gr15120014', '25', '', '236');
INSERT INTO `apprightlist` VALUES ('gr15120014', '26', '', '237');
INSERT INTO `apprightlist` VALUES ('gr15120014', '27', '', '238');
INSERT INTO `apprightlist` VALUES ('gr15120014', '28', '', '239');
INSERT INTO `apprightlist` VALUES ('gr15120014', '29', '', '240');
INSERT INTO `apprightlist` VALUES ('gr15120014', '30', '', '241');
INSERT INTO `apprightlist` VALUES ('gr15120014', '31', '', '242');
INSERT INTO `apprightlist` VALUES ('gr15120014', '32', '', '243');
INSERT INTO `apprightlist` VALUES ('gr15120014', '4', '', '244');
INSERT INTO `apprightlist` VALUES ('gr15120014', '33', '', '245');
INSERT INTO `apprightlist` VALUES ('gr15120014', '11', '', '246');
INSERT INTO `apprightlist` VALUES ('gr15120014', '85', '', '247');
INSERT INTO `apprightlist` VALUES ('gr15120015', '1', '', '248');
INSERT INTO `apprightlist` VALUES ('gr15120015', '13', '', '249');
INSERT INTO `apprightlist` VALUES ('gr15120015', '2', '', '250');
INSERT INTO `apprightlist` VALUES ('gr15120015', '20', '', '251');
INSERT INTO `apprightlist` VALUES ('gr15120015', '3', '', '252');
INSERT INTO `apprightlist` VALUES ('gr15120015', '24', '', '253');
INSERT INTO `apprightlist` VALUES ('gr15120015', '27', '', '254');
INSERT INTO `apprightlist` VALUES ('gr15120015', '28', '', '255');
INSERT INTO `apprightlist` VALUES ('gr15120015', '29', '', '256');
INSERT INTO `apprightlist` VALUES ('gr15120015', '30', '', '257');
INSERT INTO `apprightlist` VALUES ('gr15120015', '31', '', '258');
INSERT INTO `apprightlist` VALUES ('gr15120015', '32', '', '259');
INSERT INTO `apprightlist` VALUES ('gr15120015', '4', '', '260');
INSERT INTO `apprightlist` VALUES ('gr15120015', '33', '', '261');
INSERT INTO `apprightlist` VALUES ('gr15120015', '35', '', '262');
INSERT INTO `apprightlist` VALUES ('gr15120015', '36', '', '263');
INSERT INTO `apprightlist` VALUES ('gr15120015', '5', '', '264');
INSERT INTO `apprightlist` VALUES ('gr15120015', '37', '', '265');
INSERT INTO `apprightlist` VALUES ('gr15120015', '38', '', '266');
INSERT INTO `apprightlist` VALUES ('gr15120015', '39', '', '267');
INSERT INTO `apprightlist` VALUES ('gr15120015', '40', '', '268');
INSERT INTO `apprightlist` VALUES ('gr15120015', '41', '', '269');
INSERT INTO `apprightlist` VALUES ('gr15120015', '42', '', '270');
INSERT INTO `apprightlist` VALUES ('gr15120015', '43', '', '271');
INSERT INTO `apprightlist` VALUES ('gr15120015', '44', '', '272');
INSERT INTO `apprightlist` VALUES ('gr15120015', '45', '', '273');
INSERT INTO `apprightlist` VALUES ('gr15120015', '46', '', '274');
INSERT INTO `apprightlist` VALUES ('gr15120015', '47', '', '275');
INSERT INTO `apprightlist` VALUES ('gr15120015', '6', '', '276');
INSERT INTO `apprightlist` VALUES ('gr15120015', '48', '', '277');
INSERT INTO `apprightlist` VALUES ('gr15120015', '49', '', '278');
INSERT INTO `apprightlist` VALUES ('gr15120015', '52', '', '279');
INSERT INTO `apprightlist` VALUES ('gr15120015', '53', '', '280');
INSERT INTO `apprightlist` VALUES ('gr15120015', '56', '', '281');
INSERT INTO `apprightlist` VALUES ('gr15120015', '57', '', '282');
INSERT INTO `apprightlist` VALUES ('gr15120015', '58', '', '283');
INSERT INTO `apprightlist` VALUES ('gr15120015', '59', '', '284');
INSERT INTO `apprightlist` VALUES ('gr15120015', '60', '', '285');
INSERT INTO `apprightlist` VALUES ('gr15120015', '61', '', '286');
INSERT INTO `apprightlist` VALUES ('gr15120015', '9', '', '287');
INSERT INTO `apprightlist` VALUES ('gr15120015', '78', '', '288');
INSERT INTO `apprightlist` VALUES ('gr15120015', '11', '', '289');
INSERT INTO `apprightlist` VALUES ('gr15120015', '85', '', '290');
INSERT INTO `apprightlist` VALUES ('gr15120016', '3', '', '291');
INSERT INTO `apprightlist` VALUES ('gr15120016', '24', '', '292');
INSERT INTO `apprightlist` VALUES ('gr15120016', '27', '', '293');
INSERT INTO `apprightlist` VALUES ('gr15120016', '28', '', '294');
INSERT INTO `apprightlist` VALUES ('gr15120016', '4', '', '295');
INSERT INTO `apprightlist` VALUES ('gr15120016', '33', '', '296');
INSERT INTO `apprightlist` VALUES ('gr15120016', '34', '', '297');
INSERT INTO `apprightlist` VALUES ('gr15120016', '35', '', '298');
INSERT INTO `apprightlist` VALUES ('gr15120016', '36', '', '299');
INSERT INTO `apprightlist` VALUES ('gr15120016', '11', '', '300');
INSERT INTO `apprightlist` VALUES ('gr15120016', '85', '', '301');
INSERT INTO `apprightlist` VALUES ('gr15120017', '1', '', '302');
INSERT INTO `apprightlist` VALUES ('gr15120017', '12', '', '303');
INSERT INTO `apprightlist` VALUES ('gr15120017', '13', '', '304');
INSERT INTO `apprightlist` VALUES ('gr15120017', '14', '', '305');
INSERT INTO `apprightlist` VALUES ('gr15120017', '15', '', '306');
INSERT INTO `apprightlist` VALUES ('gr15120017', '16', '', '307');
INSERT INTO `apprightlist` VALUES ('gr15120017', '17', '', '308');
INSERT INTO `apprightlist` VALUES ('gr15120017', '18', '', '309');
INSERT INTO `apprightlist` VALUES ('gr15120017', '2', '', '310');
INSERT INTO `apprightlist` VALUES ('gr15120017', '19', '', '311');
INSERT INTO `apprightlist` VALUES ('gr15120017', '20', '', '312');
INSERT INTO `apprightlist` VALUES ('gr15120017', '21', '', '313');
INSERT INTO `apprightlist` VALUES ('gr15120017', '3', '', '314');
INSERT INTO `apprightlist` VALUES ('gr15120017', '22', '', '315');
INSERT INTO `apprightlist` VALUES ('gr15120017', '23', '', '316');
INSERT INTO `apprightlist` VALUES ('gr15120017', '24', '', '317');
INSERT INTO `apprightlist` VALUES ('gr15120017', '25', '', '318');
INSERT INTO `apprightlist` VALUES ('gr15120017', '26', '', '319');
INSERT INTO `apprightlist` VALUES ('gr15120017', '27', '', '320');
INSERT INTO `apprightlist` VALUES ('gr15120017', '28', '', '321');
INSERT INTO `apprightlist` VALUES ('gr15120017', '29', '', '322');
INSERT INTO `apprightlist` VALUES ('gr15120017', '30', '', '323');
INSERT INTO `apprightlist` VALUES ('gr15120017', '31', '', '324');
INSERT INTO `apprightlist` VALUES ('gr15120017', '32', '', '325');
INSERT INTO `apprightlist` VALUES ('gr15120017', '4', '', '326');
INSERT INTO `apprightlist` VALUES ('gr15120017', '33', '', '327');
INSERT INTO `apprightlist` VALUES ('gr15120017', '34', '', '328');
INSERT INTO `apprightlist` VALUES ('gr15120017', '35', '', '329');
INSERT INTO `apprightlist` VALUES ('gr15120017', '36', '', '330');
INSERT INTO `apprightlist` VALUES ('gr15120017', '5', '', '331');
INSERT INTO `apprightlist` VALUES ('gr15120017', '37', '', '332');
INSERT INTO `apprightlist` VALUES ('gr15120017', '38', '', '333');
INSERT INTO `apprightlist` VALUES ('gr15120017', '39', '', '334');
INSERT INTO `apprightlist` VALUES ('gr15120017', '40', '', '335');
INSERT INTO `apprightlist` VALUES ('gr15120017', '41', '', '336');
INSERT INTO `apprightlist` VALUES ('gr15120017', '42', '', '337');
INSERT INTO `apprightlist` VALUES ('gr15120017', '43', '', '338');
INSERT INTO `apprightlist` VALUES ('gr15120017', '44', '', '339');
INSERT INTO `apprightlist` VALUES ('gr15120017', '45', '', '340');
INSERT INTO `apprightlist` VALUES ('gr15120017', '46', '', '341');
INSERT INTO `apprightlist` VALUES ('gr15120017', '47', '', '342');
INSERT INTO `apprightlist` VALUES ('gr15120017', '6', '', '343');
INSERT INTO `apprightlist` VALUES ('gr15120017', '48', '', '344');
INSERT INTO `apprightlist` VALUES ('gr15120017', '49', '', '345');
INSERT INTO `apprightlist` VALUES ('gr15120017', '50', '', '346');
INSERT INTO `apprightlist` VALUES ('gr15120017', '51', '', '347');
INSERT INTO `apprightlist` VALUES ('gr15120017', '52', '', '348');
INSERT INTO `apprightlist` VALUES ('gr15120017', '53', '', '349');
INSERT INTO `apprightlist` VALUES ('gr15120017', '54', '', '350');
INSERT INTO `apprightlist` VALUES ('gr15120017', '55', '', '351');
INSERT INTO `apprightlist` VALUES ('gr15120017', '56', '', '352');
INSERT INTO `apprightlist` VALUES ('gr15120017', '57', '', '353');
INSERT INTO `apprightlist` VALUES ('gr15120017', '58', '', '354');
INSERT INTO `apprightlist` VALUES ('gr15120017', '59', '', '355');
INSERT INTO `apprightlist` VALUES ('gr15120017', '60', '', '356');
INSERT INTO `apprightlist` VALUES ('gr15120017', '61', '', '357');
INSERT INTO `apprightlist` VALUES ('gr15120017', '62', '', '358');
INSERT INTO `apprightlist` VALUES ('gr15120017', '63', '', '359');
INSERT INTO `apprightlist` VALUES ('gr15120017', '64', '', '360');
INSERT INTO `apprightlist` VALUES ('gr15120017', '65', '', '361');
INSERT INTO `apprightlist` VALUES ('gr15120017', '7', '', '362');
INSERT INTO `apprightlist` VALUES ('gr15120017', '66', '', '363');
INSERT INTO `apprightlist` VALUES ('gr15120017', '67', '', '364');
INSERT INTO `apprightlist` VALUES ('gr15120017', '68', '', '365');
INSERT INTO `apprightlist` VALUES ('gr15120017', '69', '', '366');
INSERT INTO `apprightlist` VALUES ('gr15120017', '70', '', '367');
INSERT INTO `apprightlist` VALUES ('gr15120017', '71', '', '368');
INSERT INTO `apprightlist` VALUES ('gr15120017', '72', '', '369');
INSERT INTO `apprightlist` VALUES ('gr15120017', '8', '', '370');
INSERT INTO `apprightlist` VALUES ('gr15120017', '73', '', '371');
INSERT INTO `apprightlist` VALUES ('gr15120017', '74', '', '372');
INSERT INTO `apprightlist` VALUES ('gr15120017', '75', '', '373');
INSERT INTO `apprightlist` VALUES ('gr15120017', '9', '', '374');
INSERT INTO `apprightlist` VALUES ('gr15120017', '76', '', '375');
INSERT INTO `apprightlist` VALUES ('gr15120017', '77', '', '376');
INSERT INTO `apprightlist` VALUES ('gr15120017', '78', '', '377');
INSERT INTO `apprightlist` VALUES ('gr15120017', '79', '', '378');
INSERT INTO `apprightlist` VALUES ('gr15120017', '10', '', '379');
INSERT INTO `apprightlist` VALUES ('gr15120017', '80', '', '380');
INSERT INTO `apprightlist` VALUES ('gr15120017', '81', '', '381');
INSERT INTO `apprightlist` VALUES ('gr15120017', '11', '', '382');
INSERT INTO `apprightlist` VALUES ('gr15120017', '82', '', '383');
INSERT INTO `apprightlist` VALUES ('gr15120017', '83', '', '384');
INSERT INTO `apprightlist` VALUES ('gr15120017', '84', '', '385');
INSERT INTO `apprightlist` VALUES ('gr15120017', '85', '', '386');
INSERT INTO `apprightlist` VALUES ('gr15120017', '86', '', '387');
INSERT INTO `apprightlist` VALUES ('gr15120017', '88', '', '388');
INSERT INTO `apprightlist` VALUES ('gr15120017', '89', '', '389');
INSERT INTO `apprightlist` VALUES ('gr15120017', '90', '', '390');
INSERT INTO `apprightlist` VALUES ('gr15120017', '1', '', '391');
INSERT INTO `apprightlist` VALUES ('gr15120017', '12', '', '392');
INSERT INTO `apprightlist` VALUES ('gr15120017', '13', '', '393');
INSERT INTO `apprightlist` VALUES ('gr15120017', '14', '', '394');
INSERT INTO `apprightlist` VALUES ('gr15120017', '15', '', '395');
INSERT INTO `apprightlist` VALUES ('gr15120017', '16', '', '396');
INSERT INTO `apprightlist` VALUES ('gr15120017', '17', '', '397');
INSERT INTO `apprightlist` VALUES ('gr15120017', '18', '', '398');
INSERT INTO `apprightlist` VALUES ('gr15120012', '1', null, '785');
INSERT INTO `apprightlist` VALUES ('gr15120012', '15', null, '786');
INSERT INTO `apprightlist` VALUES ('gr15120012', '16', null, '787');
INSERT INTO `apprightlist` VALUES ('gr15120012', '17', null, '788');
INSERT INTO `apprightlist` VALUES ('gr15120012', '19', null, '789');
INSERT INTO `apprightlist` VALUES ('gr15120012', '21', null, '790');
INSERT INTO `apprightlist` VALUES ('gr15120012', '94', null, '791');
INSERT INTO `apprightlist` VALUES ('gr15120012', '2', null, '792');
INSERT INTO `apprightlist` VALUES ('gr15120012', '23', null, '793');
INSERT INTO `apprightlist` VALUES ('gr15120012', '24', null, '794');
INSERT INTO `apprightlist` VALUES ('gr15120012', '3', null, '795');
INSERT INTO `apprightlist` VALUES ('gr15120012', '25', null, '796');
INSERT INTO `apprightlist` VALUES ('gr15120012', '26', null, '797');
INSERT INTO `apprightlist` VALUES ('gr15120012', '27', null, '798');
INSERT INTO `apprightlist` VALUES ('gr15120012', '28', null, '799');
INSERT INTO `apprightlist` VALUES ('gr15120012', '29', null, '800');
INSERT INTO `apprightlist` VALUES ('gr15120012', '30', null, '801');
INSERT INTO `apprightlist` VALUES ('gr15120012', '31', null, '802');
INSERT INTO `apprightlist` VALUES ('gr15120012', '32', null, '803');
INSERT INTO `apprightlist` VALUES ('gr15120012', '33', null, '804');
INSERT INTO `apprightlist` VALUES ('gr15120012', '34', null, '805');
INSERT INTO `apprightlist` VALUES ('gr15120012', '35', null, '806');
INSERT INTO `apprightlist` VALUES ('gr15120012', '5', null, '807');
INSERT INTO `apprightlist` VALUES ('gr15120012', '41', null, '808');
INSERT INTO `apprightlist` VALUES ('gr15120012', '42', null, '809');
INSERT INTO `apprightlist` VALUES ('gr15120012', '43', null, '810');
INSERT INTO `apprightlist` VALUES ('gr15120012', '45', null, '811');
INSERT INTO `apprightlist` VALUES ('gr15120012', '46', null, '812');
INSERT INTO `apprightlist` VALUES ('gr15120012', '47', null, '813');
INSERT INTO `apprightlist` VALUES ('gr15120012', '48', null, '814');
INSERT INTO `apprightlist` VALUES ('gr15120012', '49', null, '815');
INSERT INTO `apprightlist` VALUES ('gr15120012', '50', null, '816');
INSERT INTO `apprightlist` VALUES ('gr15120012', '6', null, '817');
INSERT INTO `apprightlist` VALUES ('gr15120012', '51', null, '818');
INSERT INTO `apprightlist` VALUES ('gr15120012', '52', null, '819');
INSERT INTO `apprightlist` VALUES ('gr15120012', '53', null, '820');
INSERT INTO `apprightlist` VALUES ('gr15120012', '54', null, '821');
INSERT INTO `apprightlist` VALUES ('gr15120012', '55', null, '822');
INSERT INTO `apprightlist` VALUES ('gr15120012', '56', null, '823');
INSERT INTO `apprightlist` VALUES ('gr15120012', '57', null, '824');
INSERT INTO `apprightlist` VALUES ('gr15120012', '58', null, '825');
INSERT INTO `apprightlist` VALUES ('gr15120012', '59', null, '826');
INSERT INTO `apprightlist` VALUES ('gr15120012', '60', null, '827');
INSERT INTO `apprightlist` VALUES ('gr15120012', '61', null, '828');
INSERT INTO `apprightlist` VALUES ('gr15120012', '62', null, '829');
INSERT INTO `apprightlist` VALUES ('gr15120012', '63', null, '830');
INSERT INTO `apprightlist` VALUES ('gr15120012', '64', null, '831');
INSERT INTO `apprightlist` VALUES ('gr15120012', '65', null, '832');
INSERT INTO `apprightlist` VALUES ('gr15120012', '66', null, '833');
INSERT INTO `apprightlist` VALUES ('gr15120012', '67', null, '834');
INSERT INTO `apprightlist` VALUES ('gr15120012', '68', null, '835');
INSERT INTO `apprightlist` VALUES ('gr15120012', '97', null, '836');
INSERT INTO `apprightlist` VALUES ('gr15120012', '98', null, '837');
INSERT INTO `apprightlist` VALUES ('gr15120012', '99', null, '838');
INSERT INTO `apprightlist` VALUES ('gr15120012', '100', null, '839');
INSERT INTO `apprightlist` VALUES ('gr15120012', '101', null, '840');
INSERT INTO `apprightlist` VALUES ('gr15120012', '102', null, '841');
INSERT INTO `apprightlist` VALUES ('gr15120012', '7', null, '842');
INSERT INTO `apprightlist` VALUES ('gr15120012', '69', null, '843');
INSERT INTO `apprightlist` VALUES ('gr15120012', '70', null, '844');
INSERT INTO `apprightlist` VALUES ('gr15120012', '73', null, '845');
INSERT INTO `apprightlist` VALUES ('gr15120012', '74', null, '846');
INSERT INTO `apprightlist` VALUES ('gr15120012', '8', null, '847');
INSERT INTO `apprightlist` VALUES ('gr15120012', '76', null, '848');
INSERT INTO `apprightlist` VALUES ('gr15120012', '77', null, '849');
INSERT INTO `apprightlist` VALUES ('gr15120012', '78', null, '850');
INSERT INTO `apprightlist` VALUES ('gr15120012', '9', null, '851');
INSERT INTO `apprightlist` VALUES ('gr15120012', '79', null, '852');
INSERT INTO `apprightlist` VALUES ('gr15120012', '80', null, '853');
INSERT INTO `apprightlist` VALUES ('gr15120012', '81', null, '854');
INSERT INTO `apprightlist` VALUES ('gr15120012', '82', null, '855');
INSERT INTO `apprightlist` VALUES ('gr15120012', '10', null, '856');
INSERT INTO `apprightlist` VALUES ('gr15120012', '83', null, '857');
INSERT INTO `apprightlist` VALUES ('gr15120012', '84', null, '858');
INSERT INTO `apprightlist` VALUES ('gr15120012', '11', null, '859');
INSERT INTO `apprightlist` VALUES ('gr15120012', '85', null, '860');
INSERT INTO `apprightlist` VALUES ('gr15120012', '12', null, '861');
INSERT INTO `apprightlist` VALUES ('gr15120012', '108', null, '862');
INSERT INTO `apprightlist` VALUES ('gr15120012', '104', null, '863');
INSERT INTO `apprightlist` VALUES ('gr15120012', '105', null, '864');
INSERT INTO `apprightlist` VALUES ('gr15120012', '106', null, '865');
INSERT INTO `apprightlist` VALUES ('gr15120012', '107', null, '866');
INSERT INTO `apprightlist` VALUES ('gr15120012', '13', null, '867');
INSERT INTO `apprightlist` VALUES ('gr15120012', '109', null, '868');
INSERT INTO `apprightlist` VALUES ('gr15120012', '110', null, '869');
INSERT INTO `apprightlist` VALUES ('gr15120012', '111', null, '870');
INSERT INTO `apprightlist` VALUES ('gr15120012', '112', null, '871');
INSERT INTO `apprightlist` VALUES ('gr15120012', '113', null, '872');
INSERT INTO `apprightlist` VALUES ('gr15120012', '14', null, '873');
INSERT INTO `apprightlist` VALUES ('gr15120012', '114', null, '874');
INSERT INTO `apprightlist` VALUES ('gr15120012', '115', null, '875');
INSERT INTO `apprightlist` VALUES ('gr15110010', '1', null, '1333');
INSERT INTO `apprightlist` VALUES ('gr15110010', '15', null, '1334');
INSERT INTO `apprightlist` VALUES ('gr15110010', '16', null, '1335');
INSERT INTO `apprightlist` VALUES ('gr15110010', '17', null, '1336');
INSERT INTO `apprightlist` VALUES ('gr15110010', '18', null, '1337');
INSERT INTO `apprightlist` VALUES ('gr15110010', '19', null, '1338');
INSERT INTO `apprightlist` VALUES ('gr15110010', '21', null, '1339');
INSERT INTO `apprightlist` VALUES ('gr15110010', '94', null, '1340');
INSERT INTO `apprightlist` VALUES ('gr15110010', '2', null, '1341');
INSERT INTO `apprightlist` VALUES ('gr15110010', '23', null, '1342');
INSERT INTO `apprightlist` VALUES ('gr15110010', '24', null, '1343');
INSERT INTO `apprightlist` VALUES ('gr15110010', '3', null, '1344');
INSERT INTO `apprightlist` VALUES ('gr15110010', '25', null, '1345');
INSERT INTO `apprightlist` VALUES ('gr15110010', '26', null, '1346');
INSERT INTO `apprightlist` VALUES ('gr15110010', '27', null, '1347');
INSERT INTO `apprightlist` VALUES ('gr15110010', '28', null, '1348');
INSERT INTO `apprightlist` VALUES ('gr15110010', '35', null, '1349');
INSERT INTO `apprightlist` VALUES ('gr15110010', '29', null, '1350');
INSERT INTO `apprightlist` VALUES ('gr15110010', '30', null, '1351');
INSERT INTO `apprightlist` VALUES ('gr15110010', '117', null, '1352');
INSERT INTO `apprightlist` VALUES ('gr15110010', '31', null, '1353');
INSERT INTO `apprightlist` VALUES ('gr15110010', '118', null, '1354');
INSERT INTO `apprightlist` VALUES ('gr15110010', '32', null, '1355');
INSERT INTO `apprightlist` VALUES ('gr15110010', '33', null, '1356');
INSERT INTO `apprightlist` VALUES ('gr15110010', '34', null, '1357');
INSERT INTO `apprightlist` VALUES ('gr15110010', '4', null, '1358');
INSERT INTO `apprightlist` VALUES ('gr15110010', '36', null, '1359');
INSERT INTO `apprightlist` VALUES ('gr15110010', '37', null, '1360');
INSERT INTO `apprightlist` VALUES ('gr15110010', '38', null, '1361');
INSERT INTO `apprightlist` VALUES ('gr15110010', '39', null, '1362');
INSERT INTO `apprightlist` VALUES ('gr15110010', '5', null, '1363');
INSERT INTO `apprightlist` VALUES ('gr15110010', '41', null, '1364');
INSERT INTO `apprightlist` VALUES ('gr15110010', '42', null, '1365');
INSERT INTO `apprightlist` VALUES ('gr15110010', '43', null, '1366');
INSERT INTO `apprightlist` VALUES ('gr15110010', '45', null, '1367');
INSERT INTO `apprightlist` VALUES ('gr15110010', '46', null, '1368');
INSERT INTO `apprightlist` VALUES ('gr15110010', '47', null, '1369');
INSERT INTO `apprightlist` VALUES ('gr15110010', '48', null, '1370');
INSERT INTO `apprightlist` VALUES ('gr15110010', '49', null, '1371');
INSERT INTO `apprightlist` VALUES ('gr15110010', '50', null, '1372');
INSERT INTO `apprightlist` VALUES ('gr15110010', '6', null, '1373');
INSERT INTO `apprightlist` VALUES ('gr15110010', '51', null, '1374');
INSERT INTO `apprightlist` VALUES ('gr15110010', '52', null, '1375');
INSERT INTO `apprightlist` VALUES ('gr15110010', '53', null, '1376');
INSERT INTO `apprightlist` VALUES ('gr15110010', '54', null, '1377');
INSERT INTO `apprightlist` VALUES ('gr15110010', '55', null, '1378');
INSERT INTO `apprightlist` VALUES ('gr15110010', '56', null, '1379');
INSERT INTO `apprightlist` VALUES ('gr15110010', '57', null, '1380');
INSERT INTO `apprightlist` VALUES ('gr15110010', '58', null, '1381');
INSERT INTO `apprightlist` VALUES ('gr15110010', '59', null, '1382');
INSERT INTO `apprightlist` VALUES ('gr15110010', '60', null, '1383');
INSERT INTO `apprightlist` VALUES ('gr15110010', '61', null, '1384');
INSERT INTO `apprightlist` VALUES ('gr15110010', '62', null, '1385');
INSERT INTO `apprightlist` VALUES ('gr15110010', '63', null, '1386');
INSERT INTO `apprightlist` VALUES ('gr15110010', '64', null, '1387');
INSERT INTO `apprightlist` VALUES ('gr15110010', '65', null, '1388');
INSERT INTO `apprightlist` VALUES ('gr15110010', '66', null, '1389');
INSERT INTO `apprightlist` VALUES ('gr15110010', '67', null, '1390');
INSERT INTO `apprightlist` VALUES ('gr15110010', '68', null, '1391');
INSERT INTO `apprightlist` VALUES ('gr15110010', '97', null, '1392');
INSERT INTO `apprightlist` VALUES ('gr15110010', '98', null, '1393');
INSERT INTO `apprightlist` VALUES ('gr15110010', '99', null, '1394');
INSERT INTO `apprightlist` VALUES ('gr15110010', '100', null, '1395');
INSERT INTO `apprightlist` VALUES ('gr15110010', '101', null, '1396');
INSERT INTO `apprightlist` VALUES ('gr15110010', '102', null, '1397');
INSERT INTO `apprightlist` VALUES ('gr15110010', '7', null, '1398');
INSERT INTO `apprightlist` VALUES ('gr15110010', '69', null, '1399');
INSERT INTO `apprightlist` VALUES ('gr15110010', '70', null, '1400');
INSERT INTO `apprightlist` VALUES ('gr15110010', '71', null, '1401');
INSERT INTO `apprightlist` VALUES ('gr15110010', '72', null, '1402');
INSERT INTO `apprightlist` VALUES ('gr15110010', '73', null, '1403');
INSERT INTO `apprightlist` VALUES ('gr15110010', '74', null, '1404');
INSERT INTO `apprightlist` VALUES ('gr15110010', '75', null, '1405');
INSERT INTO `apprightlist` VALUES ('gr15110010', '8', null, '1406');
INSERT INTO `apprightlist` VALUES ('gr15110010', '76', null, '1407');
INSERT INTO `apprightlist` VALUES ('gr15110010', '77', null, '1408');
INSERT INTO `apprightlist` VALUES ('gr15110010', '78', null, '1409');
INSERT INTO `apprightlist` VALUES ('gr15110010', '9', null, '1410');
INSERT INTO `apprightlist` VALUES ('gr15110010', '79', null, '1411');
INSERT INTO `apprightlist` VALUES ('gr15110010', '80', null, '1412');
INSERT INTO `apprightlist` VALUES ('gr15110010', '81', null, '1413');
INSERT INTO `apprightlist` VALUES ('gr15110010', '82', null, '1414');
INSERT INTO `apprightlist` VALUES ('gr15110010', '10', null, '1415');
INSERT INTO `apprightlist` VALUES ('gr15110010', '83', null, '1416');
INSERT INTO `apprightlist` VALUES ('gr15110010', '84', null, '1417');
INSERT INTO `apprightlist` VALUES ('gr15110010', '11', null, '1418');
INSERT INTO `apprightlist` VALUES ('gr15110010', '85', null, '1419');
INSERT INTO `apprightlist` VALUES ('gr15110010', '86', null, '1420');
INSERT INTO `apprightlist` VALUES ('gr15110010', '87', null, '1421');
INSERT INTO `apprightlist` VALUES ('gr15110010', '88', null, '1422');
INSERT INTO `apprightlist` VALUES ('gr15110010', '89', null, '1423');
INSERT INTO `apprightlist` VALUES ('gr15110010', '90', null, '1424');
INSERT INTO `apprightlist` VALUES ('gr15110010', '91', null, '1425');
INSERT INTO `apprightlist` VALUES ('gr15110010', '92', null, '1426');
INSERT INTO `apprightlist` VALUES ('gr15110010', '93', null, '1427');
INSERT INTO `apprightlist` VALUES ('gr15110010', '95', null, '1428');
INSERT INTO `apprightlist` VALUES ('gr15110010', '96', null, '1429');
INSERT INTO `apprightlist` VALUES ('gr15110010', '103', null, '1430');
INSERT INTO `apprightlist` VALUES ('gr15110010', '116', null, '1431');
INSERT INTO `apprightlist` VALUES ('gr15110010', '12', null, '1432');
INSERT INTO `apprightlist` VALUES ('gr15110010', '108', null, '1433');
INSERT INTO `apprightlist` VALUES ('gr15110010', '104', null, '1434');
INSERT INTO `apprightlist` VALUES ('gr15110010', '105', null, '1435');
INSERT INTO `apprightlist` VALUES ('gr15110010', '106', null, '1436');
INSERT INTO `apprightlist` VALUES ('gr15110010', '107', null, '1437');
INSERT INTO `apprightlist` VALUES ('gr15110010', '13', null, '1438');
INSERT INTO `apprightlist` VALUES ('gr15110010', '109', null, '1439');
INSERT INTO `apprightlist` VALUES ('gr15110010', '110', null, '1440');
INSERT INTO `apprightlist` VALUES ('gr15110010', '111', null, '1441');
INSERT INTO `apprightlist` VALUES ('gr15110010', '112', null, '1442');
INSERT INTO `apprightlist` VALUES ('gr15110010', '113', null, '1443');
INSERT INTO `apprightlist` VALUES ('gr15110010', '14', null, '1444');
INSERT INTO `apprightlist` VALUES ('gr15110010', '114', null, '1445');
INSERT INTO `apprightlist` VALUES ('gr15110010', '115', null, '1446');

-- ----------------------------
-- Table structure for appstreet
-- ----------------------------
DROP TABLE IF EXISTS `appstreet`;
CREATE TABLE `appstreet` (
  `sid` int(11) NOT NULL COMMENT '街道ID',
  `sname` varchar(30) DEFAULT NULL COMMENT '街道名称',
  `aid` int(11) DEFAULT NULL COMMENT '区县ID',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appstreet
-- ----------------------------

-- ----------------------------
-- Table structure for cgaa
-- ----------------------------
DROP TABLE IF EXISTS `cgaa`;
CREATE TABLE `cgaa` (
  `cgaa01` varchar(30) NOT NULL DEFAULT '' COMMENT '采购单编号',
  `cgaa02` varchar(20) DEFAULT '未审核' COMMENT '是否审核[未审核、已审核]',
  `cgaa03` decimal(10,2) DEFAULT '0.00' COMMENT '采购总金额',
  `cgaa04` decimal(10,2) DEFAULT '0.00' COMMENT '采购总量',
  `cgaa05` varchar(30) DEFAULT '' COMMENT '下单人员',
  `cgaa06` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '下单时间',
  `cgaa07` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '预计到货时间',
  `cgaa08` decimal(10,2) DEFAULT '0.00' COMMENT '运费',
  `cgaa09` varchar(100) DEFAULT '' COMMENT '供应商名称',
  `cgaa10` varchar(500) DEFAULT '' COMMENT '备注',
  `cgaa11` varchar(30) DEFAULT '' COMMENT '项目数',
  `cgaa12` varchar(20) DEFAULT '未打款' COMMENT '是否打款',
  `cgaa13` varchar(20) DEFAULT '未完成' COMMENT '是否完成',
  `cgaa14` varchar(30) DEFAULT '' COMMENT '供应商ID',
  `cgaa15` decimal(10,2) DEFAULT '0.00' COMMENT '退货总额',
  `cgaa16` decimal(10,2) DEFAULT '0.00' COMMENT '退货总数',
  `cgaa17` varchar(30) DEFAULT '' COMMENT '操作人(退供应商)',
  `cgaa18` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '操作时间',
  `cgaa19` varchar(1) DEFAULT '否' COMMENT '是否已退货供应商',
  `cgaa20` varchar(10) DEFAULT '' COMMENT '采购单状态[部分已入库、已全部入库]',
  `cgaa21` varchar(10) DEFAULT '' COMMENT '采购单类型',
  `cgaa22` decimal(10,2) DEFAULT '0.00' COMMENT '过账金额',
  PRIMARY KEY (`cgaa01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cgaa
-- ----------------------------
INSERT INTO `cgaa` VALUES ('CG15120001', '未审核', '6550.00', '211.00', 'dengshaocong', '2015-12-14 06:15:08', '2015-12-21 17:08:52', '0.00', '上海天龙生物科技有限公司', '', '3', '未打款', '未完成', '', '0.00', '0.00', '', '0000-00-00 00:00:00', '否', '', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG15120002', '已审核', '0.00', '0.00', 'dengshaocong', '2015-12-15 11:34:07', '2015-12-21 11:34:03', '0.00', '上海天龙生物科技有限公司', '', '2', '已打款', '未完成', 'GR15120009', '0.00', '0.00', '', '0000-00-00 00:00:00', '否', '', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG15120003', '未审核', '0.00', '0.00', 'dengshaocong', '2015-12-15 11:34:41', '2015-12-21 11:34:03', '20.00', '中国联通', '', '2', '已打款', '未完成', '', '0.00', '0.00', '', '0000-00-00 00:00:00', '否', '', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG15120004', '未审核', '1020.00', '102.00', 'dengshaocong', '2015-12-15 02:56:13', '2015-12-21 14:55:09', '0.00', '中国联通', '', '4', '未打款', '未完成', '', '0.00', '0.00', '', '0000-00-00 00:00:00', '否', '', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG15120005', '已审核', '1519.62', '124.00', 'dengshaocong', '2015-12-15 02:57:59', '2015-12-27 14:57:54', '20.00', '广州锦新', '', '1', '已打款', '未完成', 'GR16010010', '0.00', '0.00', '', '0000-00-00 00:00:00', '否', '', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG15120006', '未审核', '0.00', '0.00', 'dengshaocong', '2015-12-17 11:08:09', '2015-12-30 23:59:59', '0.00', '广州锦新', '', '1', '未打款', '未完成', '', '0.00', '0.00', '', '0000-00-00 00:00:00', '否', '', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG15120007', '已审核', '2673.00', '21.00', 'dengshaocong', '2015-12-31 15:03:21', '2016-01-07 15:03:14', '0.00', '中国联通', '', '2', '已打款', '已完成', '', '0.00', '0.00', 'admin', '2016-03-11 19:07:06', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030001', '未审核', '0.00', '0.00', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '0.00', '', '', '', '未打款', '未完成', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030002', '未审核', '0.00', '0.00', 'admin', '2016-03-15 18:25:04', '1900-01-01 00:00:00', '0.00', '', '', '', '未打款', '未完成', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030003', '未审核', '0.00', '0.00', 'admin', '2016-03-15 18:28:40', '1900-01-01 00:00:00', '0.00', '', '', '', '未打款', '未完成', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030004', '未审核', '0.00', '0.00', 'admin', '2016-03-15 18:30:02', '1900-01-01 00:00:00', '0.00', '广州锦新', '', '', '未打款', '未完成', 'GR16010010', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030005', '未审核', '0.00', '0.00', 'admin', '2016-03-15 19:01:19', '1900-01-01 00:00:00', '0.00', '上海天龙生物科技有限公司', '', '', '未打款', '未完成', 'GR15120009', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030006', '未审核', '0.00', '0.00', 'admin', '2016-03-16 18:25:30', '1900-01-01 00:00:00', '11.00', '广州锦新', '321312312', '', '未打款', '未完成', 'GR16010010', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030007', '未审核', '0.00', '0.00', 'admin', '2016-03-16 19:06:55', '1900-01-01 00:00:00', '0.00', '广州锦新', '', '', '未打款', '已完成', 'GR16010010', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030008', '未审核', '0.00', '0.00', 'admin', '2016-03-16 19:12:29', '1900-01-01 00:00:00', '0.00', '上海天龙生物科技有限公司', '', '', '未打款', '已完成', 'gr15120009', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030009', '未审核', '0.00', '0.00', 'admin', '2016-03-16 19:30:08', '1900-01-01 00:00:00', '0.00', '上海天龙生物科技有限公司', '', '', '未打款', '已完成', 'gr15120009', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030010', '已审核', '660.00', '40.00', '管理员', '2016-03-17 09:36:11', '2016-03-17 00:00:00', '0.00', '', '', '2', '未打款', '已完成', '', '660.00', '40.00', 'admin', '2016-03-17 16:46:48', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030011', '已审核', '460.00', '40.00', '管理员', '2016-03-17 09:47:18', '2016-03-17 00:00:00', '0.00', '', '', '2', '已打款', '已完成', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030012', '已审核', '460.00', '40.00', '管理员', '2016-03-17 09:49:30', '2016-03-18 00:00:00', '0.00', '中国联通', '', '2', '未打款', '已完成', 'GR16010011', '460.00', '40.00', 'admin', '2016-03-17 16:39:03', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030013', '已审核', '580.00', '50.00', '管理员', '2016-03-17 16:50:28', '2016-03-17 00:00:00', '0.00', '中国联通', '', '2', '未打款', '已完成', 'GR16010011', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030014', '已审核', '810.00', '70.00', '管理员', '2016-03-17 16:52:26', '2016-03-17 00:00:00', '0.00', '广州锦新', '', '2', '未打款', '已完成', 'GR16010010', '383.00', '33.00', 'admin', '2016-03-17 16:56:04', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030015', '已审核', '1400.00', '90.00', '管理员', '2016-03-17 17:00:53', '2016-03-17 00:00:00', '0.00', '上海天龙生物科技有限公司', '', '2', '未打款', '已完成', 'gr15120009', '1400.00', '90.00', 'admin', '2016-03-17 17:12:18', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030016', '已审核', '880.00', '50.00', '管理员', '2016-03-18 19:04:22', '2016-03-18 00:00:00', '0.00', '中国移动', '', '2', '未打款', '已完成', 'GR15120008', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030017', '已审核', '1270.00', '49.00', '管理员', '2016-03-18 19:15:34', '2016-03-18 00:00:00', '0.00', '中国联通', '', '2', '未打款', '已完成', 'GR16010011', '950.00', '37.00', 'admin', '2016-03-23 09:41:48', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030018', '已审核', '900.00', '90.00', '管理员', '2016-03-23 09:57:44', '2016-03-23 00:00:00', '10.00', '中国联通', '3件商品哦', '3', '未打款', '已完成', 'GR16010011', '600.00', '60.00', 'admin', '2016-03-23 11:52:57', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030019', '已审核', '1200.00', '60.00', '管理员', '2016-03-23 12:33:49', '2016-03-23 00:00:00', '12.00', '上海天龙生物科技有限公司', 'second', '3', '未打款', '已完成', 'GR15120009', '1200.00', '60.00', 'admin', '2016-03-23 12:57:27', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030020', '已审核', '600.00', '40.00', '管理员', '2016-03-23 14:50:37', '2016-03-23 00:00:00', '12.00', '广州锦新', '达到', '2', '未打款', '已完成', 'GR16010010', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030021', '已审核', '1400.00', '70.00', '管理员', '2016-03-23 14:55:57', '2016-03-23 00:00:00', '0.00', '广州锦新', '', '2', '未打款', '已完成', 'GR16010010', '1400.00', '70.00', 'admin', '2016-03-23 16:07:53', '是', '已全部入库', '采购单入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030022', '已审核', '0.00', '0.00', 'admin', '2016-03-23 16:17:35', '1900-01-01 00:00:00', '0.00', '中国联通', '', '', '未打款', '已完成', 'GR16010011', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030023', '已审核', '0.00', '0.00', 'admin', '2016-03-23 18:01:34', '1900-01-01 00:00:00', '0.00', '中国联通', '', '', '未打款', '已完成', 'GR16010011', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030024', '已审核', '0.00', '0.00', 'admin', '2016-03-23 18:03:56', '1900-01-01 00:00:00', '0.00', '中国联通', '', '', '未打款', '已完成', 'GR16010011', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030025', '已审核', '0.00', '0.00', 'admin', '2016-03-23 18:06:17', '1900-01-01 00:00:00', '0.00', '上海天龙生物科技有限公司', '', '', '未打款', '已完成', 'GR15120009', '0.00', '0.00', '', '1900-01-01 00:00:00', '否', '已全部入库', '直接入库', '0.00');
INSERT INTO `cgaa` VALUES ('CG16030026', '已审核', '600.00', '60.00', 'admin', '2016-03-23 18:15:31', '1900-01-01 00:00:00', '0.00', '上海天龙生物科技有限公司', '', '', '未打款', '已完成', 'GR15120009', '0.00', '0.00', 'admin', '2016-03-30 16:56:48', '是', '已全部入库', '直接入库', '0.00');

-- ----------------------------
-- Table structure for cgab
-- ----------------------------
DROP TABLE IF EXISTS `cgab`;
CREATE TABLE `cgab` (
  `cgab01` varchar(50) NOT NULL DEFAULT '' COMMENT '供应商编号',
  `cgab02` varchar(50) DEFAULT '' COMMENT '供应商名称',
  `cgab03` varchar(255) DEFAULT '' COMMENT '供应商地址',
  `cgab04` varchar(30) DEFAULT '' COMMENT '供应商类型',
  `cgab05` varchar(500) DEFAULT '' COMMENT '供应内容',
  `cgab06` varchar(20) DEFAULT '' COMMENT '联系人姓名',
  `cgab07` varchar(20) DEFAULT '' COMMENT '联系人电话',
  `cgab08` varchar(255) DEFAULT '' COMMENT '供货范围',
  `cgab09` varchar(30) DEFAULT '' COMMENT '资料状态',
  `cgab10` varchar(255) DEFAULT '' COMMENT '供货地址',
  `cgab11` varchar(255) DEFAULT '' COMMENT '发票地址',
  `cgab12` varchar(30) DEFAULT '' COMMENT '发票类型',
  `cgab13` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '更新日期',
  `cgab14` varchar(20) DEFAULT '' COMMENT '账号',
  `cgab15` varchar(20) DEFAULT '' COMMENT '结款方式',
  `cgab16` varchar(100) DEFAULT '' COMMENT '备注',
  `cgab17` date DEFAULT '1990-01-01' COMMENT '添加时间',
  `cgab18` decimal(10,2) DEFAULT '0.00' COMMENT '余额',
  `cgab19` varchar(10) DEFAULT '' COMMENT '供应商分类',
  `cgab20` varchar(20) DEFAULT '' COMMENT '采购文员ID',
  `cgab21` varchar(50) DEFAULT '' COMMENT '采购文员信息',
  `cgab22` varchar(20) DEFAULT '' COMMENT '采购专员ID',
  `cgab23` varchar(50) DEFAULT '' COMMENT '采购专员信息',
  PRIMARY KEY (`cgab01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cgab
-- ----------------------------
INSERT INTO `cgab` VALUES ('GR15120003', '中国电信', '中国', '工厂', '', '', '', '', '', '', '', '', '2016-03-15 11:38:01', '1542564846465154', '现金不可退', '', '2015-12-18', '0.00', '0', '', '', '', '');
INSERT INTO `cgab` VALUES ('GR15120004', '云南白药', '阿斯顿发送到飞', '批发商', '', '', '', '', '', '', '', '', '2016-03-15 11:36:53', '123451654321654111', '现金不可退', '', '2015-12-18', '0.00', '0', '', '', '', '');
INSERT INTO `cgab` VALUES ('GR15120006', '华为经销商', '测试', '工厂', '', '', '', '', '', '', '', '', '2016-03-15 11:36:42', '4556791212', '月结', '', '2015-12-18', '0.00', '0', '', '', '', '');
INSERT INTO `cgab` VALUES ('GR15120008', '中国移动', '11111', '批发商', '', '', '', '', '', '', '', '', '2016-03-15 11:36:30', '333333333', '现金可退', '', '2015-12-18', '0.00', '0', '', '', '', '');
INSERT INTO `cgab` VALUES ('GR15120009', '上海天龙生物科技有限公司', '其实有', '工厂', '', '', '', '', '', '', '', '', '2016-03-15 11:36:08', '154512342341234234', '现金可退', '', '2015-12-18', '0.00', '0', '', '', '', '');
INSERT INTO `cgab` VALUES ('GR16010010', '广州锦新', '测试测试', '批发商', '', '', '', '', '', '', '', '', '2016-03-15 11:35:56', '工行：1241234', '现金可退', '', '2016-01-12', '0.00', '0', '', '', '', '');
INSERT INTO `cgab` VALUES ('GR16010011', '中国联通', '测试撒旦撒旦', '批发商', '', '', '', '', '', '', '', '', '2016-03-15 11:30:19', '123123213124123', '现金可退', '', '2016-01-12', '0.00', '0', '', '', '', '');

-- ----------------------------
-- Table structure for cgac
-- ----------------------------
DROP TABLE IF EXISTS `cgac`;
CREATE TABLE `cgac` (
  `cgac01` int(30) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cgac02` varchar(30) DEFAULT '' COMMENT '采购单编号',
  `cgac03` varchar(20) DEFAULT '' COMMENT '商品款号',
  `cgac04` varchar(50) DEFAULT '' COMMENT '商品名称',
  `cgac05` decimal(10,2) DEFAULT '0.00' COMMENT '进货单价',
  `cgac06` decimal(10,2) DEFAULT '0.00' COMMENT '采购量',
  `cgac07` decimal(10,2) DEFAULT '0.00' COMMENT '进货总价',
  `cgac08` varchar(200) DEFAULT '' COMMENT '商品属性',
  `cgac09` varchar(30) DEFAULT '' COMMENT '厂家货号',
  `cgac10` varchar(20) DEFAULT '未入库' COMMENT '是否入库',
  `cgac11` int(10) DEFAULT '0' COMMENT '第几项采购单内容（明细）',
  `cgac12` decimal(10,2) DEFAULT '0.00' COMMENT '已入库数量',
  `cgac13` decimal(10,2) DEFAULT '0.00' COMMENT '退货总额',
  `cgac14` decimal(10,2) DEFAULT '0.00' COMMENT '退货总数',
  `cgac15` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '退货时间',
  `cgac16` decimal(10,2) DEFAULT '0.00' COMMENT '每次退货数',
  PRIMARY KEY (`cgac01`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cgac
-- ----------------------------
INSERT INTO `cgac` VALUES ('5', 'CG15120001', 'A21341', 'dadas12321', '10.00', '100.00', '1000.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('6', 'CG15120001', 'HDJE12355', 'bbbbb', '50.00', '111.00', '5550.00', '', '', '未入库', '5', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('7', 'CG15120002', '', 'aaa', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('8', 'CG15120004', '', '测试2123', '10.00', '102.00', '1020.00', '哈哈哈:啊1,大小:L,测试:测试2', '', '未入库', '0', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('9', 'CG15120004', '', '测试2123', '0.00', '0.00', '0.00', '哈哈哈:啊1,大小:L,测试:测试3', '', '未入库', '1', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('10', 'CG15120004', '', '测试2123', '0.00', '0.00', '0.00', '哈哈哈:啊1,大小:XL,测试:测试2', '', '未入库', '2', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('11', 'CG15120004', '', '测试2123', '0.00', '0.00', '0.00', '哈哈哈:啊1,大小:XL,测试:测试3', '', '未入库', '3', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('12', 'CG15120004', '', 'dadas12321', '0.00', '0.00', '0.00', '', '', '未入库', '4', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('13', 'CG15120004', '', 'aaa', '0.00', '0.00', '0.00', '', '', '未入库', '5', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('14', 'CG15120004', '', '测试2123', '0.00', '0.00', '0.00', '哈哈哈:啊1,大小:L,测试:测试2', '', '未入库', '6', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('15', 'CG15120005', '254GG', 'dadas12321', '12.26', '124.00', '1519.62', '', '', '已入库', '0', '96.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('16', 'CG15120006', '9', 'bbbbb', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('17', 'CG15120006', '10', 'aaaa', '0.00', '0.00', '0.00', '', '', '未入库', '1', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('18', 'CG15120006', '9', 'bbbbb', '0.00', '0.00', '0.00', '', '', '未入库', '2', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('19', 'CG15120007', '15', '药测试', '132.00', '10.00', '1320.00', '哈哈哈:啊1,大小:M,测试:测试2', '', '已入库', '0', '10.00', '0.00', '0.00', '2016-03-11 19:07:06', '8.00');
INSERT INTO `cgac` VALUES ('20', 'CG15120007', '10', 'aaaa', '123.00', '11.00', '1353.00', '', '', '已入库', '1', '11.00', '0.00', '0.00', '2016-03-11 19:07:06', '7.00');
INSERT INTO `cgac` VALUES ('23', 'CG16030001', '26', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('24', 'CG16030001', '25', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('25', 'CG16030002', '16', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('26', 'CG16030002', '15', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('27', 'CG16030003', '16', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('28', 'CG16030003', '15', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('29', 'CG16030004', '15', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('30', 'CG16030004', '14', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('31', 'CG16030005', '15', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('32', 'CG16030005', '13', '', '0.00', '0.00', '0.00', '', '', '未入库', '0', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('33', 'CG16030006', '26', '玛莎玻尿酸原液250ml', '10.00', '0.00', '110.00', '', '', '已入库', '0', '11.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('34', 'CG16030006', '16', '测试1123', '10.00', '0.00', '330.00', '', '', '已入库', '0', '33.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('55', 'CG16030007', '14', '衣服1号！123', '11.00', '0.00', '121.00', '', '', '已入库', '0', '11.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('56', 'CG16030007', '15', '药测试', '22.00', '0.00', '484.00', '', '', '已入库', '0', '22.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('57', 'CG16030008', '26', '玛莎玻尿酸原液250ml', '11.00', '0.00', '110.00', '', '', '已入库', '0', '10.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('58', 'CG16030008', '16', '测试1123', '22.00', '0.00', '220.00', '', '', '已入库', '0', '10.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('59', 'CG16030009', '25', '碧生源减肥茶2012', '10.00', '0.00', '110.00', '', '', '已入库', '0', '11.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('60', 'CG16030009', '13', '测试2123', '10.00', '0.00', '220.00', '', '', '已入库', '0', '22.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('61', 'CG16030010', '25', '碧生源减肥茶2012', '11.00', '20.00', '220.00', '', 'F123456', '已入库', '0', '20.00', '220.00', '20.00', '2016-03-17 16:46:48', '9.00');
INSERT INTO `cgac` VALUES ('62', 'CG16030010', '15', '药测试', '22.00', '20.00', '440.00', '', '332123', '已入库', '1', '20.00', '440.00', '20.00', '2016-03-17 16:46:48', '8.00');
INSERT INTO `cgac` VALUES ('63', 'CG16030011', '12', 'dadas12321', '11.00', '20.00', '220.00', '', '5', '已入库', '0', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('64', 'CG16030011', '11', 'aaa', '12.00', '20.00', '240.00', '', '6', '已入库', '1', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('65', 'CG16030012', '16', '测试1123', '12.00', '20.00', '240.00', '', '2', '已入库', '0', '20.00', '240.00', '20.00', '2016-03-17 16:39:03', '20.00');
INSERT INTO `cgac` VALUES ('66', 'CG16030012', '15', '药测试', '11.00', '20.00', '220.00', '', '332123', '已入库', '1', '20.00', '220.00', '20.00', '2016-03-17 16:39:03', '20.00');
INSERT INTO `cgac` VALUES ('67', 'CG16030013', '26', '玛莎玻尿酸原液250ml', '11.00', '20.00', '220.00', '', 'M11001', '已入库', '0', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('68', 'CG16030013', '25', '碧生源减肥茶2012', '12.00', '30.00', '360.00', '', 'F123456', '已入库', '1', '30.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('69', 'CG16030014', '16', '测试1123', '11.00', '30.00', '330.00', '', '2', '已入库', '0', '30.00', '143.00', '13.00', '2016-03-17 16:56:04', '13.00');
INSERT INTO `cgac` VALUES ('70', 'CG16030014', '15', '药测试', '12.00', '40.00', '480.00', '', '332123', '已入库', '1', '40.00', '240.00', '20.00', '2016-03-17 16:56:04', '20.00');
INSERT INTO `cgac` VALUES ('71', 'CG16030015', '14', '衣服1号！123', '10.00', '40.00', '400.00', '', '1', '已入库', '0', '40.00', '400.00', '40.00', '2016-03-17 17:12:18', '9.00');
INSERT INTO `cgac` VALUES ('72', 'CG16030015', '12', 'dadas12321', '20.00', '50.00', '1000.00', '', '5', '已入库', '1', '50.00', '1000.00', '50.00', '2016-03-17 17:12:18', '8.00');
INSERT INTO `cgac` VALUES ('73', 'CG16030016', '26', '玛莎玻尿酸原液250ml', '11.00', '20.00', '220.00', '', 'M11001', '已入库', '0', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('74', 'CG16030016', '25', '碧生源减肥茶2012', '22.00', '30.00', '660.00', '', 'F123456', '已入库', '1', '30.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('75', 'CG16030017', '25', '碧生源减肥茶2012', '20.00', '20.00', '400.00', '', 'F123456', '已入库', '0', '20.00', '320.00', '16.00', '2016-03-23 09:41:48', '5.00');
INSERT INTO `cgac` VALUES ('76', 'CG16030017', '16', '测试1123', '30.00', '29.00', '870.00', '', '2', '已入库', '1', '29.00', '630.00', '21.00', '2016-03-23 09:41:48', '10.00');
INSERT INTO `cgac` VALUES ('77', 'CG16030018', '26', '玛莎玻尿酸原液250ml', '10.00', '20.00', '200.00', '', 'M11001', '已入库', '0', '20.00', '100.00', '10.00', '2016-03-23 11:52:57', '2.00');
INSERT INTO `cgac` VALUES ('78', 'CG16030018', '25', '碧生源减肥茶2012', '10.00', '30.00', '300.00', '', 'F123456', '已入库', '1', '30.00', '200.00', '20.00', '2016-03-23 11:52:57', '2.00');
INSERT INTO `cgac` VALUES ('79', 'CG16030018', '16', '测试1123', '10.00', '40.00', '400.00', '', '2', '已入库', '2', '40.00', '300.00', '30.00', '2016-03-23 11:52:57', '2.00');
INSERT INTO `cgac` VALUES ('80', 'CG16030019', '9', 'bbbbb', '10.00', '20.00', '200.00', '', 'TO1', '已入库', '0', '20.00', '200.00', '20.00', '2016-03-23 12:57:27', '9.00');
INSERT INTO `cgac` VALUES ('81', 'CG16030019', '10', 'aaaa', '20.00', '20.00', '400.00', '', '7', '已入库', '1', '20.00', '400.00', '20.00', '2016-03-23 12:57:27', '7.00');
INSERT INTO `cgac` VALUES ('82', 'CG16030019', '11', 'aaa', '30.00', '20.00', '600.00', '', '6', '已入库', '2', '20.00', '600.00', '20.00', '2016-03-23 12:57:27', '8.00');
INSERT INTO `cgac` VALUES ('83', 'CG16030020', '26', '玛莎玻尿酸原液250ml', '10.00', '20.00', '200.00', '', 'M11001', '已入库', '0', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('84', 'CG16030020', '25', '碧生源减肥茶2012', '20.00', '20.00', '400.00', '', 'F123456', '已入库', '1', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('85', 'CG16030021', '25', '碧生源减肥茶2012', '20.00', '30.00', '600.00', '', 'F123456', '已入库', '0', '30.00', '600.00', '30.00', '2016-03-23 16:07:53', '5.00');
INSERT INTO `cgac` VALUES ('86', 'CG16030021', '26', '玛莎玻尿酸原液250ml', '20.00', '40.00', '800.00', '', 'M11001', '已入库', '1', '40.00', '800.00', '40.00', '2016-03-23 16:07:53', '10.00');
INSERT INTO `cgac` VALUES ('87', 'CG16030022', '26', '玛莎玻尿酸原液250ml', '20.00', '0.00', '400.00', '', '', '已入库', '0', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('88', 'CG16030022', '25', '碧生源减肥茶2012', '30.00', '0.00', '900.00', '', '', '已入库', '0', '30.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('89', 'CG16030023', '26', '玛莎玻尿酸原液250ml', '10.00', '0.00', '110.00', '', '', '已入库', '0', '11.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('90', 'CG16030023', '25', '碧生源减肥茶2012', '20.00', '0.00', '240.00', '', '', '已入库', '0', '12.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('91', 'CG16030023', '16', '测试1123', '30.00', '0.00', '390.00', '', '', '已入库', '0', '13.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('92', 'CG16030024', '26', '玛莎玻尿酸原液250ml', '10.00', '0.00', '100.00', '', '', '已入库', '0', '10.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('93', 'CG16030024', '25', '碧生源减肥茶2012', '10.00', '0.00', '200.00', '', '', '已入库', '1', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('94', 'CG16030024', '16', '测试1123', '10.00', '0.00', '300.00', '', '', '已入库', '2', '30.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('95', 'CG16030025', '26', '玛莎玻尿酸原液250ml', '10.00', '10.00', '100.00', '', '', '已入库', '0', '10.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('96', 'CG16030025', '25', '碧生源减肥茶2012', '10.00', '20.00', '200.00', '', '', '已入库', '1', '20.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('97', 'CG16030025', '16', '测试1123', '10.00', '30.00', '300.00', '', '', '已入库', '2', '30.00', '0.00', '0.00', '1900-01-01 00:00:00', '0.00');
INSERT INTO `cgac` VALUES ('98', 'CG16030026', '26', '玛莎玻尿酸原液250ml', '10.00', '10.00', '100.00', '', '', '已入库', '0', '10.00', '10.00', '1.00', '2016-03-30 16:56:48', '1.00');
INSERT INTO `cgac` VALUES ('99', 'CG16030026', '25', '碧生源减肥茶2012', '10.00', '20.00', '200.00', '', '', '已入库', '1', '20.00', '20.00', '2.00', '2016-03-30 16:56:48', '2.00');
INSERT INTO `cgac` VALUES ('100', 'CG16030026', '15', '药测试', '10.00', '30.00', '300.00', '', '', '已入库', '2', '30.00', '300.00', '30.00', '2016-03-30 16:56:48', '30.00');

-- ----------------------------
-- Table structure for contactset
-- ----------------------------
DROP TABLE IF EXISTS `contactset`;
CREATE TABLE `contactset` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `personname` varchar(50) DEFAULT '' COMMENT '真实姓名',
  `sex` varchar(10) DEFAULT '男' COMMENT '性别',
  `phone` varchar(10) DEFAULT '' COMMENT '固定电话',
  `fenji` varchar(10) DEFAULT '' COMMENT '分机短号',
  `telephone` varchar(11) DEFAULT '' COMMENT '手机号码',
  `otherphone` varchar(20) DEFAULT '' COMMENT '其他号码',
  `faxnumber` varchar(20) DEFAULT '' COMMENT '传真号码',
  `email` varchar(50) DEFAULT '' COMMENT '电子邮箱',
  `address` varchar(100) DEFAULT '' COMMENT '详细地址',
  `bz` varchar(100) DEFAULT '' COMMENT '备注',
  `department` varchar(50) DEFAULT '' COMMENT '所在部门',
  `account` varchar(50) DEFAULT '' COMMENT '账号',
  `username` varchar(50) DEFAULT '' COMMENT '用户名',
  `role` varchar(50) DEFAULT '' COMMENT '角色',
  `ifsystem` varchar(10) DEFAULT '是' COMMENT '是否为系统内部人员',
  `updatetime` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '上一次更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contactset
-- ----------------------------
INSERT INTO `contactset` VALUES ('3', '财务部长', '女', '25875415', '415', '13548754511', '', '', '', '', '', '', '', '', '财务人员', '否', '2016-02-17 14:46:46');
INSERT INTO `contactset` VALUES ('5', '人事部长', '男', '', '', '135487648', '', '', '', '', '', '人事部', '', '', '0', '否', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('6', '物流部长', '男', '', '', '1542486522', '', '', '', '', '', '物流部', '', '', '物流人员', '否', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('8', '总经理', '男', '', '', '15875423654', '', '', '', '', '', '总经办', '', '', '管理员', '否', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('9', '财务部长', '男', '', '', '13524875452', '', '', '', '', '', '财务部', '', '', '财务人员', '否', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('13', '考核测试1号', '男', '', '', '', '', '', '', '', '', '事业四部', '', 'khtest1', '产品专员', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('14', '考核测试2号', '男', '', '', '', '', '', '', '', '', '佛山事业部', '', 'khtest2', '产品专员', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('15', '考核测试3号', '男', '', '', '', '', '', '', '', '', '市场部', '', 'khtest3', '产品专员', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('16', '角色测试', '男', '', '', '', '', '', '', '', '', '物流部', '', 'chtest', 'gr15110010', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('19', '上级测试', '男', '', '', '', '', '', '', '', '', '物流部', '', 'leveltest', '', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('20', '上级测试', '男', '', '', '', '', '', '', '', '', '物流部', '', 'leveltest', '', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('21', '上级测试', '男', '', '', '', '', '', '', '', '', '物流部', '', 'leveltest', '', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('22', '上级测试1', '男', '', '', '', '', '', '', '', '', '物流部', '', '1052', '', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('23', '采购文员1号', '男', '', '', '', '', '', '', '', '', '采购部', '', '6012', '', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('24', '采购专员1号', '男', '', '', '', '', '', '', '', '', '采购部', '', '6022', '', '是', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('25', '财务1部部长', '男', '', '', '13548547441', '', '', '', '', '', '财务部1部', '', '', '0', '否', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('26', '事业三部部长', '男', '', '', '13547565768', '', '', '', '', '', '事业三部', '', '', '一线组长', '否', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('27', '321321', '男', '', '', '13443223423', '', '', '', '', 'eqwdewqed', '', '', '', '0', '否', '2016-03-01 11:35:27');
INSERT INTO `contactset` VALUES ('28', 'asaaaaaaa', '男', '', '', '13543432423', '', '', '', '', '1312312321', '', '', '', '0', '否', '2016-03-01 11:53:00');
INSERT INTO `contactset` VALUES ('29', '1111111', '男', '', '', '11111111', '', '', '', '', '11111', '', '', '', '0', '否', '2016-03-01 11:54:22');
INSERT INTO `contactset` VALUES ('31', 'aaaaaaaaaa', '男', '', '', '1354324231', '', '', '', '', '', 'asdsad', '', '', '一线组长', '否', '1990-01-01 23:59:59');
INSERT INTO `contactset` VALUES ('32', 'bbbbbb', '男', '', '', '13123123123', '', '', '', '', '', 'asdsad', '', '', '产品专员', '否', '1990-01-01 23:59:59');

-- ----------------------------
-- Table structure for cpaa
-- ----------------------------
DROP TABLE IF EXISTS `cpaa`;
CREATE TABLE `cpaa` (
  `cpaa01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品编号',
  `cpaa02` varchar(50) DEFAULT '' COMMENT '产品名称',
  `cpaa03` varchar(10) DEFAULT '' COMMENT '产品分类ID',
  `cpaa04` varchar(10) DEFAULT '' COMMENT '产品分类子ID',
  `cpaa05` varchar(10) DEFAULT '' COMMENT '产品品牌名称',
  `cpaa06` decimal(10,2) DEFAULT '0.00' COMMENT '销售价',
  `cpaa07` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '创建时间',
  `cpaa08` varchar(2) DEFAULT '上架' COMMENT '是否上架(T为上架,F为下架,默认为T)',
  `cpaa09` varchar(1) DEFAULT '否' COMMENT '是否促销(T为是,F为否,默认为F)',
  `cpaa10` varchar(50) DEFAULT '' COMMENT '产品规格',
  `cpaa11` varchar(50) DEFAULT '' COMMENT '产品属性',
  `cpaa12` varchar(500) DEFAULT '' COMMENT '产品描述',
  `cpaa13` varchar(255) DEFAULT '' COMMENT '产品图片',
  `cpaa14` varchar(10) DEFAULT '共用' COMMENT '部门标示(共用,一线,二线)',
  `cpaa15` varchar(50) DEFAULT '' COMMENT '条码',
  `cpaa16` varchar(50) DEFAULT '' COMMENT '厂家代码(厂家货号)',
  `cpaa17` varchar(300) DEFAULT '' COMMENT '套用明细',
  `cpaa18` varchar(50) DEFAULT '' COMMENT '供应商编号',
  `cpaa19` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '上一次修改时间',
  `cpaa20` decimal(10,2) DEFAULT '20.00' COMMENT '备置量(预警)',
  PRIMARY KEY (`cpaa01`),
  KEY `CPFL` (`cpaa03`),
  KEY `CPZFL` (`cpaa04`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpaa
-- ----------------------------
INSERT INTO `cpaa` VALUES ('4', 'aaa', '2', '0', '0', '2.00', '0000-00-00 00:00:00', '上架', '否', '', '', '', '', '', '', '9', '', '', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('7', 'bbbbb', '3', '0', '1', '222.00', '2015-11-12 15:10:26', '下架', '否', '', '', '打算打算的撒的撒', '', '', '', 'TO1', '', '', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('8', 'bbbbb', '6', '0', '1', '222.00', '2015-11-12 15:11:54', '上架', '否', '', '', '打算打算的撒的撒', '', '', '', '8', '', '', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('9', 'bbbbb', '3', '0', '1', '222.00', '2015-11-12 15:12:25', '下架', '否', '', '', '打算打算的撒的撒', '', '', '', 'TO1', '', 'A0001', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('10', 'aaaa', '6', '0', '2', '223.00', '2015-11-17 13:57:32', '上架', '否', '', '', '', '', '', '', '7', '', 'A0001', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('11', 'aaa', '3', '0', '2', '123.00', '2015-11-18 11:31:05', '上架', '否', '', '', 'dasdasdas', '', '', '', '6', '', 'A0001', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('12', 'dadas12321', '7', '0', '2', '0.00', '2015-11-23 10:46:19', '上架', '否', '', '', 'd21312321', '', '', '', '5', '', 'A0001', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('13', '测试2123', '1', '0', '2', '210.00', '2015-12-07 11:56:57', '上架', '否', '', '', '', 'public/template/images/upload/2015/12/2409035329772.jpg', '共用', '', '4', '', 'A0001', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('14', '衣服1号！123', '4', '9', '2', '123.00', '2015-12-15 16:59:36', '上架', '是', '', '', '', 'public/template/images/upload/2015/12/2409151234068.jpg', '共用', '', '1', '', 'gr15120009', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('15', '药测试', '4', '8', '3', '123.00', '2015-12-23 17:41:45', '上架', '是', '500g/盒', '', '', 'public/template/images/upload/2015/12/2309414515572.png', '二线', '', '332123', '', 'gr15120004', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('16', '测试1123', '4', '8', '1', '123.00', '2016-01-04 16:17:50', '上架', '否', '100g/盒', '', '', 'public/template/images/upload/2016/01/0408175087047.png', '共用', 'FDSGFF23', '2', '', 'gr15120006', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('25', '碧生源减肥茶2012', '1001', '', '102', '99.00', '1900-01-01 00:00:00', '1', '0', '瓶', '', '这里填写产品介绍，可以为空', '', '共用', 'DSADA00', 'F123456', '', '', '1990-01-01 23:59:59', '20.00');
INSERT INTO `cpaa` VALUES ('26', '玛莎玻尿酸原液250ml', '1', '3', '0', '80.00', '1900-01-01 00:00:00', '上架', '否', '瓶', '', '', '', '共用', '', 'M11001', '', '0', '2016-02-15 10:39:07', '20.00');

-- ----------------------------
-- Table structure for cpab
-- ----------------------------
DROP TABLE IF EXISTS `cpab`;
CREATE TABLE `cpab` (
  `cpab01` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品分类ID',
  `cpab02` varchar(50) DEFAULT '' COMMENT '分类名称',
  `cpab03` varchar(30) DEFAULT '' COMMENT '拼音缩写',
  `cpab04` varchar(500) DEFAULT '' COMMENT '分类描述',
  `cpab05` varchar(1) DEFAULT 'T' COMMENT '是否上架(T为上架,F为下架,默认为T)',
  `cpab06` int(10) DEFAULT '0' COMMENT '上一级分类的外键，0为最上层',
  `cpab07` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '上次修改时间',
  PRIMARY KEY (`cpab01`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpab
-- ----------------------------
INSERT INTO `cpab` VALUES ('1', '苹果1', 'apple1', '这是 分手多久恢复快速的发货时刻', 'T', '0', '2016-02-15 10:43:02');
INSERT INTO `cpab` VALUES ('2', '咬了一口', 'one bite', '规范的合法共和国111asdasd', 'T', '1', '1990-01-01 23:59:59');
INSERT INTO `cpab` VALUES ('3', '大声道111', '11ds', '梵蒂冈地方123', 'T', '1', '1990-01-01 23:59:59');
INSERT INTO `cpab` VALUES ('4', '312321', '31231', '房顶上房顶上', 'T', '1', '1990-01-01 23:59:59');

-- ----------------------------
-- Table structure for cpac
-- ----------------------------
DROP TABLE IF EXISTS `cpac`;
CREATE TABLE `cpac` (
  `cpac01` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品子分类ID',
  `cpac02` int(10) unsigned DEFAULT NULL COMMENT '产品分类ID',
  `cpac03` varchar(50) DEFAULT NULL COMMENT '子分类名称',
  `cpac04` varchar(30) DEFAULT NULL COMMENT '拼音缩写',
  `cpac05` varchar(500) DEFAULT NULL COMMENT '分类描述',
  `cpac06` varchar(1) DEFAULT 'T' COMMENT '是否上架(T为上架,F为下架,默认为T)',
  PRIMARY KEY (`cpac01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpac
-- ----------------------------

-- ----------------------------
-- Table structure for cpad
-- ----------------------------
DROP TABLE IF EXISTS `cpad`;
CREATE TABLE `cpad` (
  `cpad01` int(10) NOT NULL AUTO_INCREMENT COMMENT '产品品牌ID',
  `cpad02` int(11) DEFAULT NULL COMMENT '产品子分类ID',
  `cpad03` varchar(50) DEFAULT '' COMMENT '品牌名称',
  `cpad04` varchar(80) DEFAULT NULL COMMENT '品牌logo',
  `cpad05` varchar(500) DEFAULT NULL COMMENT '品牌描述',
  `cpad06` varchar(255) DEFAULT NULL COMMENT '品牌地址',
  `cpad07` int(11) DEFAULT NULL COMMENT '品牌排序',
  `cpad08` varchar(1) DEFAULT 'T' COMMENT '是否显示(T为显示,F为不显示,默认为T)',
  `cpad09` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '上次修改时间',
  PRIMARY KEY (`cpad01`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpad
-- ----------------------------
INSERT INTO `cpad` VALUES ('1', null, 'cvb111', 'ada12', 'dasd213', null, '221', 'T', '1990-01-01 23:59:59');
INSERT INTO `cpad` VALUES ('2', null, '美容', 'mr', '', null, '11', 'T', '2016-02-15 10:45:45');

-- ----------------------------
-- Table structure for cpae
-- ----------------------------
DROP TABLE IF EXISTS `cpae`;
CREATE TABLE `cpae` (
  `cpae01` varchar(50) NOT NULL DEFAULT '' COMMENT '批次',
  `cpae02` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '产品编号',
  `cpae03` decimal(10,2) DEFAULT '0.00' COMMENT '正品库存量',
  `cpae04` decimal(10,2) DEFAULT '0.00' COMMENT '次品库存量',
  `cpae05` varchar(20) NOT NULL DEFAULT '' COMMENT '仓库',
  `cpae06` varchar(20) DEFAULT '' COMMENT '仓位',
  `cpae07` decimal(10,2) DEFAULT '0.00' COMMENT '成本均价',
  `cpae08` decimal(10,2) DEFAULT '0.00' COMMENT '参考价',
  `cpae09` decimal(10,2) DEFAULT '0.00' COMMENT '备置量(预警)',
  `cpae10` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '生产日期',
  `cpae11` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '到期日期',
  `cpae12` varchar(20) DEFAULT '' COMMENT '单位',
  `cpae13` decimal(10,2) DEFAULT '0.00' COMMENT '总额',
  `cpae14` varchar(50) DEFAULT '' COMMENT '仓库名',
  `cpae15` varchar(50) DEFAULT '' COMMENT '仓位名',
  `cpae16` decimal(10,2) DEFAULT '0.00' COMMENT '订单量',
  `cpae17` decimal(10,2) DEFAULT '0.00' COMMENT '可用量',
  `cpae18` varchar(100) DEFAULT '' COMMENT '属性',
  `cpae19` varchar(50) DEFAULT '' COMMENT '产品规格',
  `cpae20` varchar(50) DEFAULT '' COMMENT '采购单号(入库单号)',
  `cpae21` varchar(50) DEFAULT '' COMMENT '供应商名称',
  `cpae22` varchar(50) DEFAULT '' COMMENT '条码',
  PRIMARY KEY (`cpae01`,`cpae02`,`cpae05`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpae
-- ----------------------------
INSERT INTO `cpae` VALUES ('1511180001', '4', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-17 11:33:28', '2015-11-18 11:33:30', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511180001', '7', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-17 11:33:53', '2015-11-18 11:33:57', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511180001', '8', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-18 11:34:13', '2015-11-18 11:34:14', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511180001', '9', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-18 11:33:42', '2015-11-18 11:33:43', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511180002', '4', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-12 11:42:28', '2015-11-16 11:42:31', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511180002', '7', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-18 11:42:44', '2015-11-18 11:42:46', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511180002', '8', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-18 11:42:40', '2015-11-18 11:42:43', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511180002', '9', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '2015-11-16 11:42:36', '2015-11-17 11:42:38', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511260001', '4', '0.00', '0.00', '', '44444', '0.00', '0.00', '0.00', '2015-11-26 10:12:57', '2015-11-26 10:12:59', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511260001', '7', '0.00', '0.00', '', '77777', '0.00', '0.00', '0.00', '2015-11-26 10:12:19', '2015-11-26 10:12:22', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511260001', '8', '0.00', '0.00', '', '88888', '0.00', '0.00', '0.00', '2015-11-25 10:12:08', '2015-11-26 10:12:10', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1511260001', '9', '0.00', '0.00', '', '99999', '0.00', '0.00', '0.00', '2015-11-24 10:11:50', '2015-11-25 10:11:53', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1512030001', '7', '0.00', '0.00', '', '77777', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1512030001', '8', '0.00', '0.00', '', '88888', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1512030002', '7', '0.00', '0.00', '', '77777', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1512030002', '8', '0.00', '0.00', '', '88888', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1512150001', '11', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK15120001', '', '');
INSERT INTO `cpae` VALUES ('1512160001', '10', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK15120002', '', '');
INSERT INTO `cpae` VALUES ('1512160001', '12', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK15120002', '', '');
INSERT INTO `cpae` VALUES ('1512220001', '15', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK15120003', '', '');
INSERT INTO `cpae` VALUES ('1512220002', '14', '194.00', '0.00', '', '', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK15120004', '', '');
INSERT INTO `cpae` VALUES ('1512220002', '15', '33.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK15120004', '', '');
INSERT INTO `cpae` VALUES ('1601120001', '15', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010001', '', '');
INSERT INTO `cpae` VALUES ('1601120002', '13', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010002', '', '');
INSERT INTO `cpae` VALUES ('1601120003', '12', '3.00', '0.00', '', '', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010003', '', '');
INSERT INTO `cpae` VALUES ('1601120004', '12', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010004', '', '');
INSERT INTO `cpae` VALUES ('1601120005', '12', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010005', '', '');
INSERT INTO `cpae` VALUES ('1601120006', '12', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010006', '', '');
INSERT INTO `cpae` VALUES ('1601120007', '14', '43.00', '43.00', '', '23', '0.00', '0.00', '0.00', '2016-01-12 11:33:19', '2016-01-12 11:33:24', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010007', '', '');
INSERT INTO `cpae` VALUES ('1601120008', '15', '2.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '2016-01-05 11:35:32', '2016-01-25 11:35:36', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010008', '', '');
INSERT INTO `cpae` VALUES ('1601120009', '12', '3.00', '0.00', '', '', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010009', '', '');
INSERT INTO `cpae` VALUES ('1601190001', '8', '654.00', '0.00', '', '88888', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1601190001', '12', '42.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1601190001', '14', '391.00', '0.00', '', '23', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1601190001', '15', '52.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', '', '', '');
INSERT INTO `cpae` VALUES ('1601220001', '16', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010010', '', '');
INSERT INTO `cpae` VALUES ('1601220002', '163', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010011', '', '');
INSERT INTO `cpae` VALUES ('1601220003', '16', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010012', '', '');
INSERT INTO `cpae` VALUES ('1601230001', '16', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010013', '', '');
INSERT INTO `cpae` VALUES ('1601250001', '254', '124.00', '0.00', '', '', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010014', '', '');
INSERT INTO `cpae` VALUES ('1601250002', '254', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010015', '', '');
INSERT INTO `cpae` VALUES ('1601250003', '254', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010016', '', '');
INSERT INTO `cpae` VALUES ('1601250004', '254', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010017', '', '');
INSERT INTO `cpae` VALUES ('1601250005', '254', '11.00', '0.00', '', '', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010018', '', '');
INSERT INTO `cpae` VALUES ('1601250006', '254', '50.00', '0.00', '', '', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010019', '', '');
INSERT INTO `cpae` VALUES ('1601250007', '254', '11.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010020', '', '');
INSERT INTO `cpae` VALUES ('1601250008', '10', '2.00', '0.00', '', '123', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010021', '', '');
INSERT INTO `cpae` VALUES ('1601250008', '15', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010021', '', '');
INSERT INTO `cpae` VALUES ('1601250009', '10', '0.00', '0.00', '', '123', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010022', '', '');
INSERT INTO `cpae` VALUES ('1601250009', '15', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010022', '', '');
INSERT INTO `cpae` VALUES ('1601250010', '10', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010023', '', '');
INSERT INTO `cpae` VALUES ('1601250010', '15', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010023', '', '');
INSERT INTO `cpae` VALUES ('1601250011', '10', '0.00', '0.00', '', '123', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010024', '', '');
INSERT INTO `cpae` VALUES ('1601250011', '15', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16010024', '', '');
INSERT INTO `cpae` VALUES ('1603020001', '25', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16030001', '', '');
INSERT INTO `cpae` VALUES ('1603020001', '26', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16030001', '', '');
INSERT INTO `cpae` VALUES ('1603020002', '25', '22.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'RK16030002', '', '');
INSERT INTO `cpae` VALUES ('1603020002', '26', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'RK16030002', '', '');
INSERT INTO `cpae` VALUES ('1603020003', '16', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16030003', '', '');
INSERT INTO `cpae` VALUES ('1603020004', '14', '0.00', '0.00', '', '123', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16030004', '', '');
INSERT INTO `cpae` VALUES ('1603020004', '15', '0.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16030004', '', '');
INSERT INTO `cpae` VALUES ('1603030001', '10', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16030005', '', '');
INSERT INTO `cpae` VALUES ('1603030001', '15', '7.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'RK16030005', '', '');
INSERT INTO `cpae` VALUES ('1603140005', '16', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030006', '', '');
INSERT INTO `cpae` VALUES ('1603140005', '26', '11.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030006', '', '');
INSERT INTO `cpae` VALUES ('1603150001', '10', '4.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG15120007', '', '');
INSERT INTO `cpae` VALUES ('1603150001', '15', '2.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG15120007', '', '');
INSERT INTO `cpae` VALUES ('1603150002', '10', '7.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG15120007', '', '');
INSERT INTO `cpae` VALUES ('1603150002', '15', '8.00', '0.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG15120007', '', '');
INSERT INTO `cpae` VALUES ('1603150003', '25', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030001', '', '');
INSERT INTO `cpae` VALUES ('1603150003', '26', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030001', '', '');
INSERT INTO `cpae` VALUES ('1603150004', '25', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030001', '', '');
INSERT INTO `cpae` VALUES ('1603150004', '26', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030001', '', '');
INSERT INTO `cpae` VALUES ('1603150005', '15', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030002', '', '');
INSERT INTO `cpae` VALUES ('1603150005', '16', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030002', '', '');
INSERT INTO `cpae` VALUES ('1603150006', '15', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030003', '', '');
INSERT INTO `cpae` VALUES ('1603150006', '16', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030003', '', '');
INSERT INTO `cpae` VALUES ('1603150007', '14', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030004', '', '');
INSERT INTO `cpae` VALUES ('1603150007', '15', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030004', '', '');
INSERT INTO `cpae` VALUES ('1603150008', '13', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030005', '', '');
INSERT INTO `cpae` VALUES ('1603150008', '15', '0.00', '0.00', '', '', '0.00', '0.00', '0.00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030005', '', '');
INSERT INTO `cpae` VALUES ('1603160001', '15', '22.00', '0.00', '', '123', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030007', '', '');
INSERT INTO `cpae` VALUES ('1603160001', '16', '32.00', '44.00', '', '1001', '0.00', '0.00', '0.00', '2016-03-15 18:25:20', '2016-03-16 18:25:23', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030006', '', '');
INSERT INTO `cpae` VALUES ('1603160001', '26', '11.00', '22.00', '', '1001', '0.00', '0.00', '0.00', '2016-03-15 18:25:14', '2016-03-16 18:25:16', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030006', '', '');
INSERT INTO `cpae` VALUES ('1603160002', '14', '11.00', '33.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '121.00', '', '', '0.00', '0.00', '', '', 'CG16030007', '', '');
INSERT INTO `cpae` VALUES ('1603160002', '15', '22.00', '33.00', '', '1001', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '484.00', '', '', '0.00', '0.00', '', '', 'CG16030007', '', '');
INSERT INTO `cpae` VALUES ('1603160003', '16', '10.00', '0.00', '', '1001', '22.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030008', '', '');
INSERT INTO `cpae` VALUES ('1603160003', '26', '10.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '110.00', '', '', '0.00', '0.00', '', '', 'CG16030008', '', '');
INSERT INTO `cpae` VALUES ('1603160004', '13', '22.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '2016-03-22 19:29:55', '2016-03-17 19:29:56', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030009', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603160004', '25', '11.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '2016-03-14 19:29:50', '2016-03-16 19:29:53', '', '110.00', '', '', '0.00', '0.00', '', '', 'CG16030009', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170001', '15', '0.00', '0.00', '', '1001', '22.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '440.00', '', '', '0.00', '0.00', '', '', 'CG16030010', null, '');
INSERT INTO `cpae` VALUES ('1603170001', '25', '0.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030010', null, '');
INSERT INTO `cpae` VALUES ('1603170002', '11', '20.00', '0.00', '', '1001', '12.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '240.00', '', '', '0.00', '0.00', '', '', 'CG16030011', '', '');
INSERT INTO `cpae` VALUES ('1603170002', '12', '20.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030011', '', '');
INSERT INTO `cpae` VALUES ('1603170003', '15', '0.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '132.00', '', '', '0.00', '0.00', '', '', 'CG16030012', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603170003', '16', '0.00', '0.00', '', '1001', '12.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '132.00', '', '', '0.00', '0.00', '', '', 'CG16030012', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603170004', '15', '0.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '88.00', '', '', '0.00', '0.00', '', '', 'CG16030012', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603170004', '16', '0.00', '0.00', '', '1001', '12.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '108.00', '', '', '0.00', '0.00', '', '', 'CG16030012', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603170005', '25', '30.00', '0.00', '', '123', '12.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '360.00', '', '', '0.00', '0.00', '', '', 'CG16030013', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603170005', '26', '20.00', '0.00', '', '123', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '220.00', '', '', '0.00', '0.00', '', '', 'CG16030013', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603170006', '15', '20.00', '0.00', '', '1001', '12.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '132.00', '', '', '0.00', '0.00', '', '', 'CG16030014', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603170006', '16', '17.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '121.00', '', '', '0.00', '0.00', '', '', 'CG16030014', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603170007', '15', '20.00', '0.00', '', '1001', '12.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '132.00', '', '', '0.00', '0.00', '', '', 'CG16030014', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603170007', '16', '17.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '121.00', '', '', '0.00', '0.00', '', '', 'CG16030014', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603170008', '15', '20.00', '0.00', '', '1001', '12.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '216.00', '', '', '0.00', '0.00', '', '', 'CG16030014', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603170008', '16', '17.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '88.00', '', '', '0.00', '0.00', '', '', 'CG16030014', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603170009', '12', '264.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '240.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170009', '14', '267.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '110.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170010', '12', '264.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '440.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170010', '14', '267.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '110.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170011', '12', '264.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '300.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170011', '14', '267.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '110.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170012', '12', '31.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '20.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603170012', '14', '0.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '70.00', '', '', '0.00', '0.00', '', '', 'CG16030015', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603180001', '25', '11.00', '0.00', '', '1001', '22.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '242.00', '', '', '0.00', '0.00', '', '', 'CG16030016', '中国移动', '');
INSERT INTO `cpae` VALUES ('1603180001', '26', '11.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '121.00', '', '', '0.00', '0.00', '', '', 'CG16030016', '中国移动', '');
INSERT INTO `cpae` VALUES ('1603180002', '25', '19.00', '0.00', '', '1001', '22.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '418.00', '', '', '0.00', '0.00', '', '', 'CG16030016', '中国移动', '');
INSERT INTO `cpae` VALUES ('1603180002', '26', '9.00', '0.00', '', '1001', '11.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '99.00', '', '', '0.00', '0.00', '', '', 'CG16030016', '中国移动', '');
INSERT INTO `cpae` VALUES ('1603180003', '16', '8.00', '0.00', '', '1001', '30.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '240.00', '', '', '0.00', '0.00', '', '', 'CG16030017', '中国联通', 'FDSGFF23');
INSERT INTO `cpae` VALUES ('1603180003', '25', '4.00', '0.00', '', '123', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '80.00', '', '', '0.00', '0.00', '', '', 'CG16030017', '中国联通', 'DSADA00');
INSERT INTO `cpae` VALUES ('1603230001', '16', '10.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '100.00', '', '', '0.00', '0.00', '', '', 'CG16030018', '中国联通', 'FDSGFF23');
INSERT INTO `cpae` VALUES ('1603230001', '25', '10.00', '0.00', '', '123', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '100.00', '', '', '0.00', '0.00', '', '', 'CG16030018', '中国联通', 'DSADA00');
INSERT INTO `cpae` VALUES ('1603230001', '26', '10.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '100.00', '', '', '0.00', '0.00', '', '', 'CG16030018', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230002', '9', '0.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030019', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230002', '10', '0.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030019', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230002', '11', '0.00', '0.00', '', '1001', '30.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030019', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230003', '25', '20.00', '0.00', '', '123', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '400.00', '', '', '0.00', '0.00', '', '', 'CG16030020', '广州锦新', 'DSADA00');
INSERT INTO `cpae` VALUES ('1603230003', '26', '20.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '200.00', '', '', '0.00', '0.00', '', '', 'CG16030020', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603230004', '25', '0.00', '0.00', '', '123', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030021', '广州锦新', 'DSADA00');
INSERT INTO `cpae` VALUES ('1603230004', '26', '0.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030021', '广州锦新', '');
INSERT INTO `cpae` VALUES ('1603230005', '25', '30.00', '0.00', '', '123', '30.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '900.00', '', '', '0.00', '0.00', '', '', 'CG16030022', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230005', '26', '20.00', '0.00', '', '1001', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '400.00', '', '', '0.00', '0.00', '', '', 'CG16030022', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230006', '16', '13.00', '0.00', '', '1001', '30.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '390.00', '', '', '0.00', '0.00', '', '', 'CG16030023', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230006', '25', '12.00', '0.00', '', '123', '20.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '240.00', '', '', '0.00', '0.00', '', '', 'CG16030023', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230006', '26', '11.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '2016-03-23 18:01:19', '2016-03-23 18:01:20', '', '110.00', '', '', '0.00', '0.00', '', '', 'CG16030023', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230007', '16', '30.00', '10.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '300.00', '', '', '0.00', '0.00', '', '', 'CG16030024', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230007', '25', '20.00', '10.00', '', '123', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '200.00', '', '', '0.00', '0.00', '', '', 'CG16030024', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230007', '26', '10.00', '10.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '100.00', '', '', '0.00', '0.00', '', '', 'CG16030024', '中国联通', '');
INSERT INTO `cpae` VALUES ('1603230008', '16', '30.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '300.00', '', '', '0.00', '0.00', '', '', 'CG16030025', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230008', '25', '20.00', '0.00', '', '123', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '200.00', '', '', '0.00', '0.00', '', '', 'CG16030025', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230008', '26', '10.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '100.00', '', '', '0.00', '0.00', '', '', 'CG16030025', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230009', '15', '0.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0.00', '', '', '0.00', '0.00', '', '', 'CG16030026', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230009', '25', '18.00', '0.00', '', '123', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '180.00', '', '', '0.00', '0.00', '', '', 'CG16030026', '上海天龙生物科技有限公司', '');
INSERT INTO `cpae` VALUES ('1603230009', '26', '6.00', '0.00', '', '1001', '10.00', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '60.00', '', '', '0.00', '0.00', '', '', 'CG16030026', '上海天龙生物科技有限公司', '');

-- ----------------------------
-- Table structure for cpaf
-- ----------------------------
DROP TABLE IF EXISTS `cpaf`;
CREATE TABLE `cpaf` (
  `cpaf01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `cpaf02` varchar(50) DEFAULT '' COMMENT '批次',
  `cpaf03` int(11) unsigned DEFAULT '0' COMMENT '产品编号',
  `cpaf04` varchar(50) DEFAULT '' COMMENT '仓库',
  `cpaf05` varchar(50) DEFAULT '' COMMENT '仓位',
  `cpaf06` varchar(20) DEFAULT '' COMMENT '单位',
  `cpaf07` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '异动日期',
  `cpaf08` decimal(10,2) DEFAULT '0.00' COMMENT '异动数量',
  `cpaf09` varchar(50) DEFAULT '' COMMENT '异动类型(出库,直接入库,采购单入库)',
  `cpaf10` varchar(500) DEFAULT '' COMMENT '异动原因(备注)',
  `cpaf11` varchar(50) DEFAULT '' COMMENT '异动单号[出库单号、采购单号(入库单号)]',
  `cpaf12` decimal(10,2) DEFAULT '0.00' COMMENT '运费(给供应商的)',
  `cpaf13` varchar(50) DEFAULT '' COMMENT '供应商编号',
  `cpaf14` varchar(50) DEFAULT '' COMMENT '供应商名称',
  `cpaf15` varchar(1) DEFAULT '' COMMENT '方向(0为正数,1为负数)',
  `cpaf16` varchar(50) DEFAULT '' COMMENT '操作人',
  PRIMARY KEY (`cpaf01`)
) ENGINE=InnoDB AUTO_INCREMENT=386 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpaf
-- ----------------------------
INSERT INTO `cpaf` VALUES ('4', '1512220002', '15', '', '', '', '2015-12-22 16:01:09', '100.00', '采购单入库', '', '', '0.00', '1', '', '0', '');
INSERT INTO `cpaf` VALUES ('5', '1512220002', '14', '', '', '', '2015-12-22 16:01:09', '200.00', '采购单入库', '', '', '0.00', '1', '', '0', '');
INSERT INTO `cpaf` VALUES ('6', '1512220002', '14', '', '', '', '2016-01-08 17:07:21', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('7', '1601220001', '16', '', '', '', '2016-01-22 17:22:19', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('8', '1601220002', '163', '', '', '', '2016-01-22 17:22:31', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('9', '1601220003', '16', '', '', '', '2016-01-22 17:41:37', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('10', '1601230001', '16', '', '', '', '2016-01-23 10:03:00', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('12', '1601250001', '254', '', '', '', '2016-01-25 14:36:55', '124.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('17', '1601250005', '254', '', '', '', '2016-01-25 14:38:19', '11.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('19', '1601250006', '254', '', '', '', '2016-01-25 14:39:07', '50.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('21', '1601250007', '254', '', '1001', '', '2016-01-25 17:03:55', '11.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('24', '1601250008', '15', '', '1001', '', '2016-01-25 17:06:59', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('25', '1601250008', '10', '', '123', '', '2016-01-25 17:06:59', '2.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('28', '1601250009', '15', '', '1001', '', '2016-01-25 17:08:12', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('29', '1601250009', '10', '', '123', '', '2016-01-25 17:08:12', '9.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('34', '1601250011', '15', '', '1001', '', '2016-01-25 17:41:18', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('35', '1511260001', '7', '', '77777', '', '2016-02-03 10:55:35', '1.00', '退货入仓', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('36', '1511260001', '8', '', '88888', '', '2016-02-03 10:56:42', '2.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('37', '1511260001', '8', '', '88888', '', '2016-02-03 10:57:54', '2.00', '退货入仓', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('38', '1512220002', '15', '', '1001', '', '2016-02-23 16:55:14', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('39', '1512220002', '14', '', '', '', '2016-02-23 16:55:14', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('40', '1512220002', '15', '', '1001', '', '2016-02-23 16:58:01', '1.00', '退货入仓', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('41', '1512220002', '14', '', '', '', '2016-02-23 16:58:01', '1.00', '退货入仓', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('42', '1512220002', '15', '', '1001', '', '2016-02-24 14:41:02', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('43', '1512220002', '14', '', '', '', '2016-02-24 14:41:02', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('44', '1512220002', '14', '', '', '', '2016-02-24 15:21:35', '1.00', '退货入仓', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('45', '1512220002', '15', '', '1001', '', '2016-02-24 16:37:20', '1.00', '退货入仓', '', '', '0.00', '', '', '0', '1111');
INSERT INTO `cpaf` VALUES ('46', '1512220002', '14', '', '', '', '2016-02-24 16:40:34', '1.00', '终止退货入仓', '', '', '0.00', '', '', '-', '1111');
INSERT INTO `cpaf` VALUES ('47', '1512220002', '15', '', '1001', '', '2016-02-24 16:43:16', '1.00', '终止退货入仓', '', '', '0.00', '', '', '-', '1111');
INSERT INTO `cpaf` VALUES ('48', '1512220002', '15', '', '1001', '', '2016-02-24 16:43:19', '1.00', '终止退货入仓', '', '', '0.00', '', '', '-', '1111');
INSERT INTO `cpaf` VALUES ('49', '1512220002', '15', '', '1001', '', '2016-02-24 16:43:21', '1.00', '终止退货入仓', '', '', '0.00', '', '', '-', '1111');
INSERT INTO `cpaf` VALUES ('50', '1603020001', '26', '', '', '', '2016-03-02 14:07:29', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('51', '1603020001', '25', '', '', '', '2016-03-02 14:07:29', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('52', '1603020002', '26', '', '', '', '2016-03-02 14:07:43', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('53', '1603020002', '25', '', '', '', '2016-03-02 14:07:43', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('54', '1603020002', '26', '', '1001', '', '2016-03-02 14:07:59', '1312.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('55', '1603020002', '25', '', '123', '', '2016-03-02 14:07:59', '1111.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('56', '1603020003', '16', '', '', '', '2016-03-02 14:20:46', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('57', '1603020003', '16', '', '1001', '', '2016-03-02 14:21:48', '11.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('58', '1603020004', '14', '', '', '', '2016-03-02 15:20:46', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('59', '1603020004', '15', '', '', '', '2016-03-02 15:20:46', '0.00', '生成直接入库单号', '', '', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('60', '1603020004', '14', '', '123', '', '2016-03-02 15:21:33', '11.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('61', '1603020004', '15', '', '1001', '', '2016-03-02 15:21:33', '22.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('62', '1512150001', '11', '', '1001', '', '2016-03-03 10:00:31', '111.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('63', '1601250011', '10', '', '123', '', '2016-03-03 10:00:31', '222.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('64', '1512160001', '12', '', '', '', '2016-03-03 10:20:43', '288.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('65', '1512160001', '10', '', '', '', '2016-03-03 10:20:43', '100.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('66', '1512150001', '11', '', '1001', '', '2016-03-03 10:20:43', '1112.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('67', '1512030002', '8', '', '88888', '', '2016-03-03 10:20:43', '204.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('68', '1512030002', '7', '', '77777', '', '2016-03-03 10:20:43', '81.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('69', '1512030001', '7', '', '77777', '', '2016-03-03 10:20:43', '81.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('70', '1512030001', '8', '', '88888', '', '2016-03-03 10:20:43', '204.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('71', '1511260001', '9', '', '99999', '', '2016-03-03 10:20:43', '135.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('72', '1511260001', '8', '', '88888', '', '2016-03-03 10:20:43', '226.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('73', '1511260001', '7', '', '77777', '', '2016-03-03 10:20:43', '111.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('74', '1511260001', '4', '', '44444', '', '2016-03-03 10:20:43', '22.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('75', '1511180002', '7', '', '', '', '2016-03-03 10:20:43', '222.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('76', '1511180001', '7', '', '', '', '2016-03-03 10:20:43', '2.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('77', '1603020004', '15', '', '1001', '', '2016-03-03 10:21:49', '22.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('78', '1603020004', '14', '', '123', '', '2016-03-03 10:21:49', '11.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('79', '1603020003', '16', '', '1001', '', '2016-03-03 10:21:49', '11.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('80', '1603020002', '26', '', '1001', '', '2016-03-03 10:21:49', '1312.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('81', '1603020002', '25', '', '123', '', '2016-03-03 10:21:49', '1111.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('82', '1601250011', '10', '', '123', '', '2016-03-03 10:21:49', '222.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('83', '1601250011', '15', '', '1001', '', '2016-03-03 10:21:49', '1.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('84', '1601250009', '15', '', '1001', '', '2016-03-03 10:21:49', '1.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('85', '1601250009', '10', '', '123', '', '2016-03-03 10:21:49', '9.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('86', '1601250008', '15', '', '1001', '', '2016-03-03 10:21:49', '1.00', '盘亏', '', '', '0.00', '', '', '1', '');
INSERT INTO `cpaf` VALUES ('89', '1603030001', '15', '', '1001', '', '2016-03-03 10:35:18', '7.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('90', '1512220002', '14', '', '', '', '2016-03-08 14:12:18', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('91', '1512220002', '15', '', '1001', '', '2016-03-08 14:12:18', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('92', '1512220002', '14', '', '', '', '2016-03-08 14:41:54', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('94', '1603100001', '15', '', '1001', '', '2016-03-10 16:50:41', '10.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('95', '1603100002', '15', '', '', '', '2016-03-10 16:52:14', '0.00', '生成直接入库单号', '', 'CG16030006', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('96', '1603100002', '15', '', '1001', '', '2016-03-10 16:52:56', '11.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('97', '1603100001', '15', '', '123', '', '2016-03-11 15:55:40', '2.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('98', '1603100001', '10', '', '1001', '', '2016-03-11 15:55:40', '3.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('99', '1603100001', '15', '', '123', '', '2016-03-11 15:56:42', '2.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('100', '1603100001', '10', '', '1001', '', '2016-03-11 15:56:42', '3.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('101', '1603100001', '15', '', '123', '', '2016-03-11 16:11:06', '2.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('102', '1603100001', '10', '', '1001', '', '2016-03-11 16:11:06', '2.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('103', '1603100001', '15', '', '123', '', '2016-03-11 16:12:51', '8.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('104', '1603100001', '10', '', '1001', '', '2016-03-11 16:12:51', '9.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('105', '1603100001', '15', '', '123', '', '2016-03-11 16:29:37', '2.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('106', '1603100001', '10', '', '1001', '', '2016-03-11 16:29:37', '3.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('107', '1603100001', '15', '', '123', '', '2016-03-11 16:29:55', '8.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('108', '1603100001', '10', '', '1001', '', '2016-03-11 16:29:55', '8.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('109', '1603100001', '15', '', '123', '', '2016-03-11 19:03:04', '2.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('110', '1603100001', '10', '', '1001', '', '2016-03-11 19:03:04', '5.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('111', '1603100001', '15', '', '123', '', '2016-03-11 19:04:26', '8.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('112', '1603100001', '10', '', '1001', '', '2016-03-11 19:04:26', '6.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('113', '1603100001', '15', '', '123', '', '2016-03-11 19:06:29', '2.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('114', '1603100001', '10', '', '1001', '', '2016-03-11 19:06:29', '4.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('115', '1603100001', '15', '', '123', '', '2016-03-11 19:07:06', '8.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('116', '1603100001', '10', '', '1001', '', '2016-03-11 19:07:06', '7.00', '退货供应商', '', 'CG15120007', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('117', '1603100001', '15', '', '1001', '', '2016-03-14 17:06:47', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('118', '1603100001', '10', '', '1001', '', '2016-03-14 17:06:47', '3.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('121', '1603140001', '15', '', '1001', '', '2016-03-14 17:10:55', '2.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('122', '1603140001', '10', '', '1001', '', '2016-03-14 17:10:55', '3.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('125', '1603140002', '15', '', '1001', '', '2016-03-14 17:14:20', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('126', '1603140002', '10', '', '1001', '', '2016-03-14 17:14:20', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('129', '1603140003', '15', '', '1001', '', '2016-03-14 17:18:10', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('130', '1603140003', '10', '', '1001', '', '2016-03-14 17:18:10', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('133', '1603140004', '15', '', '1001', '', '2016-03-14 17:18:54', '5.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('134', '1603140004', '10', '', '1001', '', '2016-03-14 17:18:54', '3.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('135', '1603140005', '26', '', '', '', '2016-03-14 17:21:10', '0.00', '生成直接入库单号', '', 'CG16030006', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('136', '1603140005', '16', '', '', '', '2016-03-14 17:21:10', '0.00', '生成直接入库单号', '', 'CG16030006', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('139', '1603140006', '15', '', '1001', '', '2016-03-15 10:08:47', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('140', '1603140006', '10', '', '1001', '', '2016-03-15 10:08:47', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('143', '1603150001', '15', '', '1001', '', '2016-03-15 10:12:20', '9.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('144', '1603150001', '10', '', '1001', '', '2016-03-15 10:12:20', '10.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('145', '1603150001', '15', '', '1001', '', '2016-03-15 10:25:33', '2.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('146', '1603150001', '10', '', '1001', '', '2016-03-15 10:25:33', '2.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('149', '1603150002', '15', '', '1001', '', '2016-03-15 10:31:06', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('150', '1603150002', '10', '', '1001', '', '2016-03-15 10:31:06', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('153', '1603150003', '15', '', '1001', '', '2016-03-15 10:33:09', '7.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('154', '1603150003', '10', '', '1001', '', '2016-03-15 10:33:09', '8.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('159', '1603150001', '15', '', '1001', '', '2016-03-15 10:44:42', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('160', '1603150001', '10', '', '1001', '', '2016-03-15 10:44:42', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('163', '1603150002', '15', '', '1001', '', '2016-03-15 10:45:14', '9.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('164', '1603150002', '10', '', '1001', '', '2016-03-15 10:45:14', '10.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('171', '1603150001', '15', '', '1001', '', '2016-03-15 17:02:31', '1.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('172', '1603150001', '10', '', '1001', '', '2016-03-15 17:02:31', '11.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('174', '1603150002', '15', '', '1001', '', '2016-03-15 17:02:55', '9.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('177', '1603150001', '15', '', '1001', '', '2016-03-15 17:06:29', '2.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('178', '1603150001', '10', '', '1001', '', '2016-03-15 17:06:29', '4.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('181', '1603150002', '15', '', '1001', '', '2016-03-15 17:07:04', '8.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('182', '1603150002', '10', '', '1001', '', '2016-03-15 17:07:04', '7.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('183', '1603140005', '26', '', '1001', '', '2016-03-15 17:36:10', '11.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('184', '1603020002', '25', '', '1001', '', '2016-03-15 17:36:10', '22.00', '直接入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('185', '1603150003', '26', '', '', '', '2016-03-15 17:42:26', '0.00', '生成直接入库单号', '', 'CG16030001', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('186', '1603150003', '25', '', '', '', '2016-03-15 17:42:26', '0.00', '生成直接入库单号', '', 'CG16030001', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('187', '1603150004', '26', '', '', '', '2016-03-15 17:43:36', '0.00', '生成直接入库单号', '', 'CG16030001', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('188', '1603150004', '25', '', '', '', '2016-03-15 17:43:36', '0.00', '生成直接入库单号', '', 'CG16030001', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('189', '1603150005', '16', '', '', '', '2016-03-15 18:25:04', '0.00', '生成直接入库单号', '', 'CG16030002', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('190', '1603150005', '15', '', '', '', '2016-03-15 18:25:04', '0.00', '生成直接入库单号', '', 'CG16030002', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('191', '1603150006', '16', '', '', '', '2016-03-15 18:28:39', '0.00', '生成直接入库单号', '', 'CG16030003', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('192', '1603150006', '15', '', '', '', '2016-03-15 18:28:39', '0.00', '生成直接入库单号', '', 'CG16030003', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('193', '1603150007', '15', '', '', '', '2016-03-15 18:30:02', '0.00', '生成直接入库单号', '', 'CG16030004', '0.00', 'GR16010010', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('194', '1603150007', '14', '', '', '', '2016-03-15 18:30:02', '0.00', '生成直接入库单号', '', 'CG16030004', '0.00', 'GR16010010', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('195', '1603150008', '15', '', '', '', '2016-03-15 19:01:19', '0.00', '生成直接入库单号', '', 'CG16030005', '0.00', 'gr15120009', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('196', '1603150008', '13', '', '', '', '2016-03-15 19:01:19', '0.00', '生成直接入库单号', '', 'CG16030005', '0.00', 'gr15120009', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('197', '1603160001', '26', '', '1001', '', '2016-03-16 18:25:30', '11.00', '直接入库', '321312312', 'CG16030006', '11.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('198', '1603160001', '16', '', '1001', '', '2016-03-16 18:25:30', '33.00', '直接入库', '321312312', 'CG16030006', '11.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('219', '1603160002', '14', '', '1001', '', '2016-03-16 19:06:55', '11.00', '直接入库', '', 'CG16030007', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('220', '1603160002', '15', '', '1001', '', '2016-03-16 19:06:55', '22.00', '直接入库', '', 'CG16030007', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('221', '1603160003', '26', '', '1001', '', '2016-03-16 19:12:29', '10.00', '直接入库', '', 'CG16030008', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('222', '1603160003', '16', '', '1001', '', '2016-03-16 19:12:29', '10.00', '直接入库', '', 'CG16030008', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('223', '1603160004', '25', '', '1001', '', '2016-03-16 19:30:08', '11.00', '直接入库', '', 'CG16030009', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('224', '1603160004', '13', '', '1001', '', '2016-03-16 19:30:08', '22.00', '直接入库', '', 'CG16030009', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('225', '1603170001', '25', '', '', '', '2016-03-17 09:37:49', '0.00', '提交保存', '', 'CG16030010', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('226', '1603170001', '15', '', '', '', '2016-03-17 09:37:49', '0.00', '提交保存', '', 'CG16030010', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('227', '1603170001', '25', '', '1001', '', '2016-03-17 09:38:04', '20.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('228', '1603170001', '15', '', '1001', '', '2016-03-17 09:38:04', '20.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('229', '1603170002', '12', '', '', '', '2016-03-17 09:47:55', '0.00', '提交保存', '', 'CG16030011', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('230', '1603170002', '11', '', '', '', '2016-03-17 09:47:55', '0.00', '提交保存', '', 'CG16030011', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('231', '1603170002', '12', '', '1001', '', '2016-03-17 09:48:50', '20.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('232', '1603170002', '11', '', '1001', '', '2016-03-17 09:48:50', '20.00', '采购单入库', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('233', '1603170003', '16', '', '', '', '2016-03-17 09:49:50', '0.00', '提交保存', '', 'CG16030012', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('234', '1603170003', '15', '', '', '', '2016-03-17 09:49:50', '0.00', '提交保存', '', 'CG16030012', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('235', '1603170003', '16', '', '1001', '', '2016-03-17 09:50:10', '11.00', '采购单入库', '', '', '0.00', 'GR16010011', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('236', '1603170003', '15', '', '1001', '', '2016-03-17 09:50:10', '12.00', '采购单入库', '', '', '0.00', 'GR16010011', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('237', '1603170004', '16', '', '', '', '2016-03-17 09:51:08', '0.00', '提交保存', '', 'CG16030012', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('238', '1603170004', '15', '', '', '', '2016-03-17 09:51:08', '0.00', '提交保存', '', 'CG16030012', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('239', '1603170004', '16', '', '1001', '', '2016-03-17 09:51:24', '9.00', '采购单入库', '', '', '0.00', 'GR16010011', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('240', '1603170004', '15', '', '1001', '', '2016-03-17 09:51:24', '8.00', '采购单入库', '', '', '0.00', 'GR16010011', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('241', '1603170003', '16', '', '1001', '', '2016-03-17 16:39:03', '20.00', '退货供应商', '', 'CG16030012', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('242', '1603170003', '15', '', '1001', '', '2016-03-17 16:39:03', '20.00', '退货供应商', '', 'CG16030012', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('243', '1603170001', '25', '', '1001', '', '2016-03-17 16:46:31', '11.00', '退货供应商', '', 'CG16030010', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('244', '1603170001', '15', '', '1001', '', '2016-03-17 16:46:31', '12.00', '退货供应商', '', 'CG16030010', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('245', '1603170001', '25', '', '1001', '', '2016-03-17 16:46:48', '9.00', '退货供应商', '', 'CG16030010', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('246', '1603170001', '15', '', '1001', '', '2016-03-17 16:46:48', '8.00', '退货供应商', '', 'CG16030010', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('247', '1603170005', '26', '', '', '', '2016-03-17 16:50:46', '0.00', '提交保存', '', 'CG16030013', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('248', '1603170005', '25', '', '', '', '2016-03-17 16:50:46', '0.00', '提交保存', '', 'CG16030013', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('249', '1603170005', '26', '', '123', '', '2016-03-17 16:51:52', '20.00', '采购单入库', '', '', '0.00', 'GR16010011', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('250', '1603170005', '25', '', '123', '', '2016-03-17 16:51:52', '30.00', '采购单入库', '', '', '0.00', 'GR16010011', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('251', '1603170006', '16', '', '', '', '2016-03-17 16:52:56', '0.00', '提交保存', '', 'CG16030014', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('252', '1603170006', '15', '', '', '', '2016-03-17 16:52:56', '0.00', '提交保存', '', 'CG16030014', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('253', '1603170006', '16', '', '1001', '', '2016-03-17 16:53:05', '11.00', '采购单入库', '', '', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('254', '1603170006', '15', '', '1001', '', '2016-03-17 16:53:05', '11.00', '采购单入库', '', '', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('255', '1603170007', '16', '', '', '', '2016-03-17 16:53:20', '0.00', '提交保存', '', 'CG16030014', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('256', '1603170007', '15', '', '', '', '2016-03-17 16:53:20', '0.00', '提交保存', '', 'CG16030014', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('257', '1603170007', '16', '', '1001', '', '2016-03-17 16:53:22', '11.00', '采购单入库', '', '', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('258', '1603170007', '15', '', '1001', '', '2016-03-17 16:53:22', '11.00', '采购单入库', '', '', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('259', '1603170008', '16', '', '', '', '2016-03-17 16:55:21', '0.00', '提交保存', '', 'CG16030014', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('260', '1603170008', '15', '', '', '', '2016-03-17 16:55:21', '0.00', '提交保存', '', 'CG16030014', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('261', '1603170008', '16', '', '1001', '', '2016-03-17 16:55:27', '8.00', '采购单入库', '', '', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('262', '1603170008', '15', '', '1001', '', '2016-03-17 16:55:27', '18.00', '采购单入库', '', '', '0.00', 'GR16010010', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('263', '1603170006', '16', '', '1001', '', '2016-03-17 16:56:04', '13.00', '退货供应商', '', 'CG16030014', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('264', '1603170006', '15', '', '1001', '', '2016-03-17 16:56:04', '20.00', '退货供应商', '', 'CG16030014', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('265', '1603170009', '14', '', '', '', '2016-03-17 17:01:40', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('266', '1603170009', '12', '', '', '', '2016-03-17 17:01:40', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('267', '1603170009', '14', '', '1001', '', '2016-03-17 17:01:48', '11.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('268', '1603170009', '12', '', '1001', '', '2016-03-17 17:01:48', '12.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('269', '1603170010', '14', '', '', '', '2016-03-17 17:02:16', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('270', '1603170010', '12', '', '', '', '2016-03-17 17:02:16', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('271', '1603170010', '14', '', '1001', '', '2016-03-17 17:02:23', '11.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('272', '1603170010', '12', '', '1001', '', '2016-03-17 17:02:23', '22.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('273', '1603170011', '14', '', '', '', '2016-03-17 17:02:43', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('274', '1603170011', '12', '', '', '', '2016-03-17 17:02:43', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('275', '1603170011', '14', '', '1001', '', '2016-03-17 17:04:34', '11.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('276', '1603170011', '12', '', '1001', '', '2016-03-17 17:04:34', '15.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('277', '1603170012', '14', '', '', '', '2016-03-17 17:04:50', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('278', '1603170012', '12', '', '', '', '2016-03-17 17:04:50', '0.00', '提交保存', '', 'CG16030015', '0.00', '', '', '', 'admin');
INSERT INTO `cpaf` VALUES ('279', '1603170012', '14', '', '1001', '', '2016-03-17 17:04:57', '7.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('280', '1603170012', '12', '', '1001', '', '2016-03-17 17:04:57', '1.00', '采购单入库', '', '', '0.00', 'gr15120009', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('281', '1603170009', '14', '', '1001', '', '2016-03-17 17:05:34', '20.00', '退货供应商', '', 'CG16030015', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('282', '1603170009', '12', '', '1001', '', '2016-03-17 17:05:34', '30.00', '退货供应商', '', 'CG16030015', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('283', '1603170009', '14', '', '1001', '', '2016-03-17 17:11:48', '11.00', '退货供应商', '', 'CG16030015', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('284', '1603170009', '12', '', '1001', '', '2016-03-17 17:11:48', '12.00', '退货供应商', '', 'CG16030015', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('285', '1603170009', '14', '', '1001', '', '2016-03-17 17:12:18', '9.00', '退货供应商', '', 'CG16030015', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('286', '1603170009', '12', '', '1001', '', '2016-03-17 17:12:18', '8.00', '退货供应商', '', 'CG16030015', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('287', '1603170012', '12', '', '1001', '', '2016-03-17 18:59:02', '222.00', '仓库报废', '', 'CG16030015', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('288', '1603170012', '12', '', '1001', '', '2016-03-17 19:00:23', '11.00', '仓库报废', '', 'CG16030015', '0.00', '', '上海天龙生物科技有限公司', '1', 'admin');
INSERT INTO `cpaf` VALUES ('295', '1603180001', '26', '', '1001', '', '2016-03-18 19:12:57', '11.00', '采购单入库', '', 'CG16030016', '0.00', 'GR15120008', '中国移动', '0', 'admin');
INSERT INTO `cpaf` VALUES ('296', '1603180001', '25', '', '1001', '', '2016-03-18 19:12:57', '11.00', '采购单入库', '', 'CG16030016', '0.00', 'GR15120008', '中国移动', '0', 'admin');
INSERT INTO `cpaf` VALUES ('297', '1603180002', '26', '', '1001', '', '2016-03-18 19:14:31', '9.00', '采购单入库', '', 'CG16030016', '0.00', 'GR15120008', '中国移动', '0', 'admin');
INSERT INTO `cpaf` VALUES ('298', '1603180002', '25', '', '1001', '', '2016-03-18 19:14:31', '19.00', '采购单入库', '', 'CG16030016', '0.00', 'GR15120008', '中国移动', '0', 'admin');
INSERT INTO `cpaf` VALUES ('299', '1603180003', '25', '', '123', '', '2016-03-18 19:34:55', '11.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('300', '1603180003', '16', '', '1001', '', '2016-03-18 19:34:55', '11.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('301', '1603180004', '25', '', '123', '', '2016-03-18 19:46:33', '12.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('302', '1603180004', '16', '', '1001', '', '2016-03-18 19:46:33', '12.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('303', '1603180005', '25', '', '123', '', '2016-03-18 19:48:45', '7.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('304', '1603180005', '16', '', '1001', '', '2016-03-18 19:48:45', '7.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('305', '1603180006', '25', '', '123', '', '2016-03-18 19:59:47', '1.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('306', '1603180006', '16', '', '1001', '', '2016-03-18 19:59:47', '2.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('307', '1603160001', '16', '', '1001', '', '2016-03-22 14:49:06', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('308', '1603180003', '25', '', '123', '', '2016-03-22 19:34:52', '9.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('309', '1603180003', '16', '', '1001', '', '2016-03-22 19:34:52', '18.00', '采购单入库', '', 'CG16030017', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('310', '1603180003', '25', '', '123', '', '2016-03-22 19:44:21', '11.00', '退货供应商', '', 'CG16030017', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('311', '1603180003', '16', '', '1001', '', '2016-03-22 19:44:21', '11.00', '退货供应商', '', 'CG16030017', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('312', '1603180003', '25', '', '123', '', '2016-03-23 09:41:48', '5.00', '退货供应商', '', 'CG16030017', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('313', '1603180003', '16', '', '1001', '', '2016-03-23 09:41:48', '10.00', '退货供应商', '', 'CG16030017', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('314', '1603230001', '26', '', '1001', '', '2016-03-23 09:59:32', '10.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('315', '1603230001', '25', '', '123', '', '2016-03-23 09:59:32', '20.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('316', '1603230001', '16', '', '1001', '', '2016-03-23 09:59:32', '30.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('317', '1603230001', '26', '', '1001', '', '2016-03-23 11:47:20', '2.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('318', '1603230001', '25', '', '123', '', '2016-03-23 11:47:20', '2.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('319', '1603230001', '16', '', '1001', '', '2016-03-23 11:47:20', '2.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('320', '1603230001', '26', '', '1001', '', '2016-03-23 11:49:00', '6.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('321', '1603230001', '25', '', '123', '', '2016-03-23 11:49:00', '16.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('322', '1603230001', '16', '', '1001', '', '2016-03-23 11:49:00', '26.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('323', '1603230001', '26', '', '1001', '', '2016-03-23 11:52:57', '2.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('324', '1603230001', '25', '', '123', '', '2016-03-23 11:52:57', '2.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('325', '1603230001', '16', '', '1001', '', '2016-03-23 11:52:57', '2.00', '退货供应商', '', 'CG16030018', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('326', '1603230002', '9', '', '1001', '', '2016-03-23 12:55:42', '20.00', '采购单入库', '', 'CG16030019', '12.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('327', '1603230002', '11', '', '1001', '', '2016-03-23 12:55:42', '20.00', '采购单入库', '', 'CG16030019', '12.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('328', '1603230002', '10', '', '1001', '', '2016-03-23 12:55:42', '20.00', '采购单入库', '', 'CG16030019', '12.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('329', '1603230002', '9', '', '1001', '', '2016-03-23 12:56:43', '11.00', '退货供应商', '', 'CG16030019', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('330', '1603230002', '11', '', '1001', '', '2016-03-23 12:56:43', '12.00', '退货供应商', '', 'CG16030019', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('331', '1603230002', '10', '', '1001', '', '2016-03-23 12:56:43', '13.00', '退货供应商', '', 'CG16030019', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('332', '1603230002', '9', '', '1001', '', '2016-03-23 12:57:27', '9.00', '退货供应商', '', 'CG16030019', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('333', '1603230002', '11', '', '1001', '', '2016-03-23 12:57:27', '8.00', '退货供应商', '', 'CG16030019', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('334', '1603230002', '10', '', '1001', '', '2016-03-23 12:57:27', '7.00', '退货供应商', '', 'CG16030019', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('338', '1603230001', '26', '', '1001', '', '2016-03-23 14:29:17', '1.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('339', '1603230001', '25', '', '123', '', '2016-03-23 14:29:17', '2.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('340', '1603230001', '16', '', '1001', '', '2016-03-23 14:29:17', '3.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('341', '1603230001', '26', '', '1001', '', '2016-03-23 14:34:00', '1.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('342', '1603230001', '25', '', '123', '', '2016-03-23 14:34:00', '2.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('343', '1603230001', '16', '', '1001', '', '2016-03-23 14:34:00', '3.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('344', '1603230001', '26', '', '1001', '', '2016-03-23 14:34:27', '8.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('345', '1603230001', '25', '', '123', '', '2016-03-23 14:34:27', '6.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('346', '1603230001', '16', '', '1001', '', '2016-03-23 14:34:27', '4.00', '采购单入库', '', 'CG16030018', '10.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('347', '1603230003', '26', '', '1001', '', '2016-03-23 14:51:47', '20.00', '采购单入库', '', 'CG16030020', '12.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('348', '1603230003', '25', '', '123', '', '2016-03-23 14:51:47', '20.00', '采购单入库', '', 'CG16030020', '12.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('349', '1603230004', '26', '', '1001', '', '2016-03-23 14:57:15', '10.00', '采购单入库', '', 'CG16030021', '0.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('350', '1603230004', '25', '', '123', '', '2016-03-23 14:57:15', '12.00', '采购单入库', '', 'CG16030021', '0.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('351', '1603230004', '26', '', '1001', '', '2016-03-23 15:00:19', '20.00', '采购单入库', '', 'CG16030021', '0.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('352', '1603230004', '25', '', '123', '', '2016-03-23 15:00:19', '8.00', '采购单入库', '', 'CG16030021', '0.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('353', '1603230004', '26', '', '1001', '', '2016-03-23 15:00:52', '10.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('354', '1603230004', '25', '', '123', '', '2016-03-23 15:00:52', '10.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('355', '1603230004', '26', '', '1001', '', '2016-03-23 15:20:58', '10.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('356', '1603230004', '25', '', '123', '', '2016-03-23 15:20:58', '10.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('357', '1603230004', '26', '', '1001', '', '2016-03-23 16:04:41', '10.00', '采购单入库', '', 'CG16030021', '0.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('358', '1603230004', '25', '', '123', '', '2016-03-23 16:04:41', '10.00', '采购单入库', '', 'CG16030021', '0.00', 'GR16010010', '广州锦新', '0', 'admin');
INSERT INTO `cpaf` VALUES ('359', '1603230004', '26', '', '1001', '', '2016-03-23 16:07:36', '10.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('360', '1603230004', '25', '', '123', '', '2016-03-23 16:07:36', '5.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('361', '1603230004', '26', '', '1001', '', '2016-03-23 16:07:53', '10.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('362', '1603230004', '25', '', '123', '', '2016-03-23 16:07:53', '5.00', '退货供应商', '', 'CG16030021', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('363', '1603230005', '26', '', '1001', '', '2016-03-23 16:17:35', '20.00', '直接入库', '', 'CG16030022', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('364', '1603230005', '25', '', '123', '', '2016-03-23 16:17:35', '30.00', '直接入库', '', 'CG16030022', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('365', '1603140005', '26', '', '1001', '', '2016-03-23 16:54:42', '1.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('366', '1603020002', '25', '', '1001', '', '2016-03-23 16:54:43', '2.00', '出库', '', '', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('367', '1603140005', '26', '', '1001', '', '2016-03-23 17:05:05', '1.00', '退货入仓', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('368', '1603020002', '25', '', '1001', '', '2016-03-23 17:05:05', '2.00', '退货入仓', '', '', '0.00', '', '', '0', 'admin');
INSERT INTO `cpaf` VALUES ('369', '1603230006', '26', '', '1001', '', '2016-03-23 18:01:34', '11.00', '直接入库', '', 'CG16030023', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('370', '1603230006', '25', '', '123', '', '2016-03-23 18:01:34', '12.00', '直接入库', '', 'CG16030023', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('371', '1603230006', '16', '', '1001', '', '2016-03-23 18:01:34', '13.00', '直接入库', '', 'CG16030023', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('372', '1603230007', '26', '', '1001', '', '2016-03-23 18:03:55', '10.00', '直接入库', '', 'CG16030024', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('373', '1603230007', '25', '', '123', '', '2016-03-23 18:03:55', '20.00', '直接入库', '', 'CG16030024', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('374', '1603230007', '16', '', '1001', '', '2016-03-23 18:03:55', '30.00', '直接入库', '', 'CG16030024', '0.00', 'GR16010011', '中国联通', '0', 'admin');
INSERT INTO `cpaf` VALUES ('375', '1603230008', '26', '', '1001', '', '2016-03-23 18:06:17', '10.00', '直接入库', '', 'CG16030025', '0.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('376', '1603230008', '25', '', '123', '', '2016-03-23 18:06:17', '20.00', '直接入库', '', 'CG16030025', '0.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('377', '1603230008', '16', '', '1001', '', '2016-03-23 18:06:17', '30.00', '直接入库', '', 'CG16030025', '0.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('378', '1603230009', '26', '', '1001', '', '2016-03-23 18:15:31', '10.00', '直接入库', '', 'CG16030026', '0.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('379', '1603230009', '25', '', '123', '', '2016-03-23 18:15:31', '20.00', '直接入库', '', 'CG16030026', '0.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('380', '1603230009', '15', '', '1001', '', '2016-03-23 18:15:31', '30.00', '直接入库', '', 'CG16030026', '0.00', 'GR15120009', '上海天龙生物科技有限公司', '0', 'admin');
INSERT INTO `cpaf` VALUES ('381', '1603230009', '26', '', '1001', '', '2016-03-24 10:34:55', '1.00', '仓库报废', '', 'CG16030026', '0.00', '', '上海天龙生物科技有限公司', '1', 'admin');
INSERT INTO `cpaf` VALUES ('382', '1603230009', '26', '', '1001', '', '2016-03-24 10:35:08', '2.00', '仓库报废', '', 'CG16030026', '0.00', '', '上海天龙生物科技有限公司', '1', 'admin');
INSERT INTO `cpaf` VALUES ('383', '1603230009', '26', '', '1001', '', '2016-03-30 16:56:48', '1.00', '退货供应商', '', 'CG16030026', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('384', '1603230009', '25', '', '123', '', '2016-03-30 16:56:48', '2.00', '退货供应商', '', 'CG16030026', '0.00', '', '', '1', 'admin');
INSERT INTO `cpaf` VALUES ('385', '1603230009', '15', '', '1001', '', '2016-03-30 16:56:48', '30.00', '退货供应商', '', 'CG16030026', '0.00', '', '', '1', 'admin');

-- ----------------------------
-- Table structure for cpag
-- ----------------------------
DROP TABLE IF EXISTS `cpag`;
CREATE TABLE `cpag` (
  `cpag01` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cpag02` varchar(50) NOT NULL DEFAULT '' COMMENT '属性名称',
  `cpag03` int(11) DEFAULT '0' COMMENT '上一级属性的ID，0为没有上一级',
  `cpag04` varchar(500) DEFAULT NULL COMMENT '子属性的内容，用|隔开',
  `cpag05` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '上次修改时间',
  PRIMARY KEY (`cpag01`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpag
-- ----------------------------
INSERT INTO `cpag` VALUES ('1', '服饰', '0', '', '2016-02-15 10:59:25');
INSERT INTO `cpag` VALUES ('2', '哈哈哈', '1', '啊1|啊2|啊3', '2016-02-15 10:56:42');
INSERT INTO `cpag` VALUES ('3', '阿里巴巴', '0', '', '1990-01-01 23:59:59');
INSERT INTO `cpag` VALUES ('4', '哈哈', '3', '呵呵呵呵|呵呵呵|呵呵呵|呵呵', '1990-01-01 23:59:59');
INSERT INTO `cpag` VALUES ('5', '大小', '1', 'S|M|L|XL|XXL|XXXL', '1990-01-01 23:59:59');
INSERT INTO `cpag` VALUES ('6', '测试', '1', '测试1|测试2|测试3', '1990-01-01 23:59:59');
INSERT INTO `cpag` VALUES ('7', '爆炸', '3', '爆炸1|爆炸2|爆炸3', '1990-01-01 23:59:59');

-- ----------------------------
-- Table structure for cpsxxq
-- ----------------------------
DROP TABLE IF EXISTS `cpsxxq`;
CREATE TABLE `cpsxxq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpid` int(11) DEFAULT NULL COMMENT '产品ID，绑定产品',
  `cpsxxq` varchar(500) DEFAULT NULL COMMENT '产品属性详情',
  `sxid` int(11) DEFAULT '0' COMMENT '属性ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpsxxq
-- ----------------------------
INSERT INTO `cpsxxq` VALUES ('10', '13', '2_啊1', '2');
INSERT INTO `cpsxxq` VALUES ('11', '13', '5_L', '5');
INSERT INTO `cpsxxq` VALUES ('12', '13', '6_测试3', '6');

-- ----------------------------
-- Table structure for cwaa
-- ----------------------------
DROP TABLE IF EXISTS `cwaa`;
CREATE TABLE `cwaa` (
  `cwaa01` varchar(30) NOT NULL COMMENT '结算单号',
  `cwaa02` varchar(30) DEFAULT '' COMMENT '订单号',
  `cwaa03` varchar(30) DEFAULT '' COMMENT '客户编号',
  `cwaa04` varchar(30) DEFAULT '' COMMENT '支付方式',
  `cwaa05` decimal(10,2) DEFAULT '0.00' COMMENT '订单总额',
  `cwaa06` decimal(10,2) DEFAULT '0.00' COMMENT '运费',
  `cwaa07` decimal(10,2) DEFAULT '0.00' COMMENT '退金额',
  `cwaa08` varchar(200) DEFAULT '' COMMENT '业绩工号',
  `cwaa09` varchar(30) DEFAULT '' COMMENT '收据类型[出货订单、退换货订单、采购单]',
  `cwaa10` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '结算时间',
  `cwaa11` varchar(30) DEFAULT '' COMMENT '操作人工号',
  `cwaa12` varchar(30) DEFAULT '' COMMENT '操作人姓名',
  PRIMARY KEY (`cwaa01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cwaa
-- ----------------------------
INSERT INTO `cwaa` VALUES ('JS16030003', 'XS16030003', 'KH16020013', '现金支付', '246.00', '0.00', '0.00', 'admin', '出货订单', '2016-03-08 14:12:12', 'admin', '管理员');
INSERT INTO `cwaa` VALUES ('JS16030004', 'XS16030002', 'KH16020014', '支付宝', '123.00', '0.00', '0.00', 'admin', '出货订单', '2016-03-08 14:41:48', 'admin', '管理员');

-- ----------------------------
-- Table structure for cwab
-- ----------------------------
DROP TABLE IF EXISTS `cwab`;
CREATE TABLE `cwab` (
  `cwab01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水号',
  `cwab02` varchar(30) DEFAULT '' COMMENT '结算单号',
  `cwab03` varchar(30) DEFAULT '' COMMENT '收款人',
  `cwab04` varchar(20) DEFAULT '现金' COMMENT '收款方式',
  `cwab05` decimal(10,2) DEFAULT '0.00' COMMENT '收款金额',
  `cwab06` varchar(20) DEFAULT '' COMMENT '收款类型 [运费、收客户金额、记1、记2、撤1、撤2、退款]',
  `cwab07` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '收款时间',
  `cwab08` varchar(10) DEFAULT '' COMMENT '是否有效',
  `cwab09` varchar(30) DEFAULT '' COMMENT '操作人工号',
  `cwab10` varchar(30) DEFAULT '' COMMENT '操作人姓名',
  PRIMARY KEY (`cwab01`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cwab
-- ----------------------------
INSERT INTO `cwab` VALUES ('17', 'JS16030003', 'admin', '现金', '246.00', '收客户金额', '2016-03-08 14:12:12', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('18', 'JS16030004', 'admin', '现金', '123.00', '收客户金额', '2016-03-08 14:41:48', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('19', 'JS16030003', 'admin', '现金', '11.00', '记1', '2016-03-08 14:44:22', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('20', 'JS16030004', 'admin', '现金', '0.00', '记1', '2016-03-08 14:44:22', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('21', 'JS16030004', 'admin', '现金', '0.00', '撤1', '2016-03-08 14:44:26', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('22', 'JS16030003', 'admin', '现金', '11.00', '撤1', '2016-03-08 14:44:43', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('23', 'JS16030003', 'admin', '现金', '11.00', '记1', '2016-03-08 14:45:13', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('24', 'JS16030004', 'admin', '现金', '0.00', '记1', '2016-03-08 14:45:13', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('25', 'JS16030003', 'admin', '现金', '22.00', '记2', '2016-03-08 14:45:29', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('26', 'JS16030004', 'admin', '现金', '0.00', '记2', '2016-03-08 14:45:29', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('27', 'JS16030003', 'admin', '现金', '11.00', '撤1', '2016-03-08 14:46:33', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('28', 'JS16030004', 'admin', '现金', '0.00', '撤2', '2016-03-08 14:46:36', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('30', 'JS16030003', 'admin', '现金', '0.00', '退款', '2016-03-08 16:52:34', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('31', 'JS16030003', 'admin', '现金', '0.00', '记1', '2016-03-14 11:34:10', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('32', 'JS16030004', 'admin', '现金', '0.00', '记1', '2016-03-14 11:34:10', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('33', null, 'admin', '现金', '0.00', '记1', '2016-03-14 11:34:10', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('34', null, 'admin', '现金', '0.00', '记1', '2016-03-14 11:34:10', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('35', 'JS16030003', 'admin', '现金', '0.00', '撤1', '2016-03-14 11:34:26', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('36', null, 'admin', '现金', '0.00', '撤1', '2016-03-14 11:34:33', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('37', null, 'admin', '现金', '0.00', '记1', '2016-03-14 11:56:34', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('38', 'JS16030004', 'admin', '现金', '0.00', '撤1', '2016-03-14 12:17:23', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('39', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-14 12:32:14', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('40', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-14 12:33:31', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('41', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-14 12:34:30', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('42', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-14 12:40:49', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('43', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-14 12:40:53', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('44', 'JS16030003', 'admin', '现金', '0.00', '记1', '2016-03-14 12:45:07', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('45', 'JS16030003', 'admin', '现金', '22.00', '撤2', '2016-03-14 12:45:10', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('46', 'JS16030003', 'admin', '现金', '0.00', '撤1', '2016-03-14 12:46:04', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('47', 'JS16030003', 'admin', '现金', '22.00', '记2', '2016-03-14 12:46:06', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('48', 'JS16030003', 'admin', '现金', '22.00', '撤2', '2016-03-14 12:46:09', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('49', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-14 12:46:11', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('50', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-14 12:46:14', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('51', null, 'admin', '现金', '0.00', '撤1', '2016-03-14 12:46:18', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('52', null, 'admin', '现金', '0.00', '记2', '2016-03-14 12:46:21', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('53', null, 'admin', '现金', '0.00', '记1', '2016-03-14 12:46:30', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('54', null, 'admin', '现金', '0.00', '记2', '2016-03-14 12:46:35', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('55', null, 'admin', '现金', '0.00', '撤2', '2016-03-14 12:46:40', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('56', null, 'admin', '现金', '0.00', '撤1', '2016-03-14 12:46:49', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('57', null, 'admin', '现金', '0.00', '记1', '2016-03-14 12:51:31', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('58', null, 'admin', '现金', '0.00', '撤1', '2016-03-14 12:51:34', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('59', null, 'admin', '现金', '1.23', '记1', '2016-03-14 14:20:46', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('60', null, 'admin', '现金', '1111.00', '撤1', '2016-03-14 14:20:55', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('61', null, 'admin', '现金', '1111.00', '记1', '2016-03-14 14:25:56', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('62', null, 'admin', '现金', '1111.00', '撤1', '2016-03-14 14:26:02', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('63', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-14 14:27:27', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('64', 'JS16030003', 'admin', '现金', '1.00', '撤1', '2016-03-14 14:27:31', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('65', 'JS16030003', 'admin', '现金', '22.00', '记2', '2016-03-14 14:27:34', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('66', 'JS16030003', 'admin', '现金', '22.00', '撤2', '2016-03-14 14:27:38', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('67', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-14 14:27:46', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('68', 'JS16030003', 'admin', '现金', '1.00', '撤1', '2016-03-14 14:29:21', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('69', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-14 14:29:27', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('70', null, 'admin', '现金', '111.00', '记1', '2016-03-22 16:19:32', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('71', null, 'admin', '现金', '0.00', '记2', '2016-03-22 16:26:40', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('72', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-22 16:29:04', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('73', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-22 16:29:04', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('74', null, 'admin', '现金', '111.00', '撤1', '2016-03-22 16:29:38', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('75', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-22 16:29:41', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('76', 'JS16030003', 'admin', '现金', '1.00', '撤1', '2016-03-22 16:29:45', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('77', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-22 16:29:53', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('78', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-22 16:29:53', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('79', null, 'admin', '现金', '111.00', '记1', '2016-03-22 16:29:53', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('80', 'JS16030003', 'admin', '现金', '1.00', '撤1', '2016-03-22 16:30:17', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('81', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-22 16:30:20', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('82', null, 'admin', '现金', '111.00', '撤1', '2016-03-22 16:30:23', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('83', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-22 16:30:30', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('84', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-22 16:30:30', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('85', null, 'admin', '现金', '111.00', '记1', '2016-03-22 16:30:30', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('86', null, 'admin', '现金', '111.00', '撤1', '2016-03-22 16:31:48', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('87', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-22 16:31:50', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('88', 'JS16030003', 'admin', '现金', '1.00', '撤1', '2016-03-22 16:31:52', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('89', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-22 16:31:59', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('90', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-22 16:31:59', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('91', null, 'admin', '现金', '111.00', '记1', '2016-03-22 16:31:59', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('92', 'JS16030003', 'admin', '现金', '1.00', '撤1', '2016-03-22 16:34:10', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('93', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-22 16:34:12', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('94', null, 'admin', '现金', '111.00', '撤1', '2016-03-22 16:34:14', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('95', 'JS16030003', 'admin', '现金', '1.00', '记1', '2016-03-22 16:34:28', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('96', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-22 16:34:28', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('97', null, 'admin', '现金', '111.00', '记1', '2016-03-22 16:34:28', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('98', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:36:17', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('99', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 16:36:17', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('100', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:36:55', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('101', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:39:07', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('102', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:40:56', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('103', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:43:11', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('104', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:44:37', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('105', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:47:54', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('106', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:50:37', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('107', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:52:02', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('108', null, 'admin', '现金', '0.00', '记1', '2016-03-22 16:55:39', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('109', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-22 17:03:48', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('110', 'JS16030003', 'admin', '现金', '1.00', '撤1', '2016-03-22 17:03:51', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('111', null, 'admin', '现金', '111.00', '撤1', '2016-03-22 17:03:56', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('112', 'JS16030004', 'admin', '现金', '22.00', '记1', '2016-03-22 17:04:02', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('113', 'JS16030004', 'admin', '现金', '22.00', '撤1', '2016-03-22 17:04:06', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('114', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:26:00', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('115', null, 'admin', '现金', '0.00', '撤1', '2016-03-22 17:26:05', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('116', null, 'admin', '现金', '1111.00', '撤1', '2016-03-22 17:26:07', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('117', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:26:10', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('118', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:26:30', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('119', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 17:26:30', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('120', null, 'admin', '现金', '1111.00', '撤1', '2016-03-22 17:26:38', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('121', null, 'admin', '现金', '0.00', '撤1', '2016-03-22 17:26:40', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('122', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:26:44', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('123', null, 'admin', '现金', '0.00', '撤1', '2016-03-22 17:27:50', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('124', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:27:59', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('125', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 17:27:59', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('126', null, 'admin', '现金', '0.00', '撤2', '2016-03-22 17:28:11', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('127', null, 'admin', '现金', '0.00', '记2', '2016-03-22 17:28:23', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('128', null, 'admin', '现金', '0.00', '记2', '2016-03-22 17:28:23', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('129', null, 'admin', '现金', '1111.00', '撤1', '2016-03-22 17:54:22', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('130', null, 'admin', '现金', '0.00', '撤1', '2016-03-22 17:54:24', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('131', null, 'admin', '现金', '0.00', '撤2', '2016-03-22 17:54:26', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('132', null, 'admin', '现金', '0.00', '撤2', '2016-03-22 17:54:28', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('133', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:54:35', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('134', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 17:54:35', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('135', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:54:49', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('136', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 17:54:49', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('137', null, 'admin', '现金', '1111.00', '撤1', '2016-03-22 17:55:20', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('138', null, 'admin', '现金', '0.00', '撤1', '2016-03-22 17:55:22', '无效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('139', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:57:49', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('140', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 17:57:49', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('141', null, 'admin', '现金', '0.00', '记1', '2016-03-22 17:58:51', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('142', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 17:58:51', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('143', null, 'admin', '现金', '0.00', '记1', '2016-03-22 18:00:48', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('144', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 18:00:48', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('145', null, 'admin', '现金', '0.00', '记1', '2016-03-22 18:01:25', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('146', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 18:01:25', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('147', null, 'admin', '现金', '0.00', '记1', '2016-03-22 18:05:06', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('148', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 18:05:06', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('149', null, 'admin', '现金', '0.00', '记1', '2016-03-22 18:06:54', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('150', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 18:06:54', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('151', null, 'admin', '现金', '0.00', '记1', '2016-03-22 18:07:18', '有效', 'admin', '管理员');
INSERT INTO `cwab` VALUES ('152', null, 'admin', '现金', '1111.00', '记1', '2016-03-22 18:07:18', '有效', 'admin', '管理员');

-- ----------------------------
-- Table structure for cxxm
-- ----------------------------
DROP TABLE IF EXISTS `cxxm`;
CREATE TABLE `cxxm` (
  `id` int(11) DEFAULT NULL COMMENT '编号',
  `chname` varchar(50) DEFAULT NULL COMMENT '中文名称',
  `enname` varchar(50) DEFAULT NULL COMMENT '英文名称',
  `lx` varchar(1) DEFAULT '1' COMMENT '查询类型',
  `primarykey` varchar(2) DEFAULT NULL COMMENT '主键',
  `virtualkey` varchar(2) DEFAULT NULL COMMENT '虚键',
  `tbname` varchar(30) DEFAULT NULL COMMENT '表名',
  `fieldtype` int(11) DEFAULT NULL COMMENT '字段类型',
  `virtualexp` varchar(2000) DEFAULT NULL COMMENT '虚键表达式',
  `tbchname` varchar(50) DEFAULT NULL COMMENT '表中文名',
  `coltype` varchar(20) DEFAULT NULL COMMENT '列类型',
  `colwidth` varchar(20) DEFAULT NULL COMMENT '列宽度',
  `combovaluetype` varchar(20) DEFAULT NULL COMMENT '下拉类型',
  `openclassid` varchar(20) DEFAULT NULL COMMENT '打开类编码',
  `bz` varchar(500) DEFAULT NULL COMMENT '备注',
  `opentype` int(11) DEFAULT NULL COMMENT '字段类型',
  `dateformat` varchar(20) DEFAULT NULL COMMENT '日期格式'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cxxm
-- ----------------------------

-- ----------------------------
-- Table structure for deptset
-- ----------------------------
DROP TABLE IF EXISTS `deptset`;
CREATE TABLE `deptset` (
  `deptID` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `depttext` varchar(200) DEFAULT '' COMMENT '部门名称',
  `ifmarket` varchar(5) DEFAULT '否' COMMENT '是否销售部门',
  `higherlevel` int(11) DEFAULT '0' COMMENT '上级部门',
  `level` int(10) DEFAULT '0' COMMENT '等级',
  PRIMARY KEY (`deptID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of deptset
-- ----------------------------
INSERT INTO `deptset` VALUES ('1', 'asdsad', '否', '0', '0');
INSERT INTO `deptset` VALUES ('2', '修改测试', '是', '1', '1');
INSERT INTO `deptset` VALUES ('3', '123', '是', '0', '0');
INSERT INTO `deptset` VALUES ('4', '测试123', '是', '0', '0');
INSERT INTO `deptset` VALUES ('5', '测试2', '否', '0', '0');
INSERT INTO `deptset` VALUES ('6', '测试33111', '否', '0', '0');
INSERT INTO `deptset` VALUES ('7', '测试1的测试1222', '否', '0', '1');
INSERT INTO `deptset` VALUES ('8', '测试1的测试23222', '否', '0', '1');
INSERT INTO `deptset` VALUES ('9', '测试1的测试1的测试1111', '否', '0', '2');
INSERT INTO `deptset` VALUES ('10', '最后测试~', '是', '1', '1');
INSERT INTO `deptset` VALUES ('11', '修改测试，最后测试', '是', '2', '2');
INSERT INTO `deptset` VALUES ('12', '33333111', '否', '0', '1');
INSERT INTO `deptset` VALUES ('13', '3111111', '否', '12', '2');
INSERT INTO `deptset` VALUES ('14', '321', '否', '0', '1');
INSERT INTO `deptset` VALUES ('15', '333222111', '否', '0', '1');
INSERT INTO `deptset` VALUES ('16', '2211', '否', '1', '1');
INSERT INTO `deptset` VALUES ('17', '事业一部', '是', '0', '1');
INSERT INTO `deptset` VALUES ('19', '3322', '否', '0', '0');
INSERT INTO `deptset` VALUES ('20', '公共组', '是', '0', '0');
INSERT INTO `deptset` VALUES ('21', '112233', '否', '20', '1');
INSERT INTO `deptset` VALUES ('22', '3333333', '否', '19', '1');

-- ----------------------------
-- Table structure for examine
-- ----------------------------
DROP TABLE IF EXISTS `examine`;
CREATE TABLE `examine` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ryid` int(10) unsigned DEFAULT NULL COMMENT '考核人员ID',
  `xmid` int(11) DEFAULT NULL COMMENT '考核项目ID',
  `khdate` date DEFAULT NULL COMMENT '考核日期',
  `remark` varchar(50) DEFAULT '' COMMENT '备注',
  `lrdate` date DEFAULT NULL COMMENT '记录日期',
  `setter` varchar(50) DEFAULT '' COMMENT '录入工号',
  PRIMARY KEY (`id`),
  KEY `rylistid` (`ryid`),
  KEY `khxmid` (`xmid`),
  CONSTRAINT `khxmid` FOREIGN KEY (`xmid`) REFERENCES `khxm` (`id`),
  CONSTRAINT `rylistid` FOREIGN KEY (`ryid`) REFERENCES `rylist` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of examine
-- ----------------------------

-- ----------------------------
-- Table structure for groupright
-- ----------------------------
DROP TABLE IF EXISTS `groupright`;
CREATE TABLE `groupright` (
  `groupname` varchar(50) DEFAULT '' COMMENT '权限组名称',
  `groupbh` varchar(30) NOT NULL COMMENT '编号',
  `systype` varchar(30) DEFAULT '' COMMENT '系统类型',
  `grouptype` varchar(30) DEFAULT '' COMMENT '组类型',
  `disabled` varchar(255) DEFAULT 'T' COMMENT '是否有效（T——有效，F无效）',
  `parentbh` varchar(30) DEFAULT '' COMMENT '上一级权限角色',
  `updatetime` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '信息更新时间',
  PRIMARY KEY (`groupbh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groupright
-- ----------------------------
INSERT INTO `groupright` VALUES ('超级管理员', 'gr15110010', '', '', 'T', '', '0000-00-00 00:00:00');
INSERT INTO `groupright` VALUES ('一线组长', 'gr15120011', '', '', 'T', '', '0000-00-00 00:00:00');
INSERT INTO `groupright` VALUES ('一线组员', 'gr15120012', '', '', 'T', '', '0000-00-00 00:00:00');
INSERT INTO `groupright` VALUES ('产品专员', 'gr15120013', '', '', 'T', '', '0000-00-00 00:00:00');
INSERT INTO `groupright` VALUES ('物流人员', 'gr15120014', '', '', 'T', '', '0000-00-00 00:00:00');
INSERT INTO `groupright` VALUES ('财务人员', 'gr15120015', '', '', 'T', '', '0000-00-00 00:00:00');
INSERT INTO `groupright` VALUES ('采购人员', 'gr15120016', '', '', 'T', '', '0000-00-00 00:00:00');
INSERT INTO `groupright` VALUES ('管理员', 'gr15120017', '', '', 'T', '', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for khaa
-- ----------------------------
DROP TABLE IF EXISTS `khaa`;
CREATE TABLE `khaa` (
  `khaa01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `khaa02` varchar(30) DEFAULT '' COMMENT '客户编号',
  `khaa03` varchar(50) DEFAULT '' COMMENT '客户姓名',
  `khaa04` varchar(2) DEFAULT '' COMMENT '客户性别(男,女,未知)',
  `khaa05` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '出生日期',
  `khaa06` varchar(11) DEFAULT '' COMMENT '手机',
  `khaa07` varchar(30) DEFAULT '' COMMENT '电话1',
  `khaa08` varchar(30) DEFAULT '' COMMENT '电话2',
  `khaa09` varchar(30) DEFAULT '' COMMENT 'QQ',
  `khaa10` varchar(50) DEFAULT '' COMMENT '微信',
  `khaa11` varchar(50) DEFAULT '' COMMENT '电子邮箱',
  `khaa12` varchar(255) DEFAULT '' COMMENT '联系地址',
  `khaa13` varchar(200) DEFAULT '' COMMENT '兴趣爱好',
  `khaa14` varchar(30) DEFAULT '' COMMENT '客户类型(散户,月结,年结)',
  `khaa15` varchar(10) DEFAULT '' COMMENT '婚否(未婚,已婚,未知)',
  `khaa16` varchar(200) DEFAULT '' COMMENT '从事行业(金融业,服务业,房地产,农林,牧渔)',
  `khaa17` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '创建时间',
  `khaa18` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '最新跟进时间',
  `khaa19` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '最新转单时间',
  `khaa20` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '最新签收时间',
  `khaa21` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '最新拒收时间',
  `khaa22` varchar(100) DEFAULT '' COMMENT '来源(电台,兵团电视)',
  `khaa23` varchar(30) DEFAULT '' COMMENT '等级(A,B,C,重要客户)',
  `khaa24` varchar(50) DEFAULT '' COMMENT '进线方式(短信,QQ,电话)',
  `khaa25` varchar(30) DEFAULT '' COMMENT '意向(保健,美容,祛斑等)',
  `khaa26` varchar(30) DEFAULT '' COMMENT '学历',
  `khaa27` varchar(30) DEFAULT '' COMMENT '年收入',
  `khaa28` decimal(10,2) DEFAULT '0.00' COMMENT '消费总金额',
  `khaa29` varchar(30) DEFAULT '' COMMENT '注册方式(电话,短信,旺旺)',
  `khaa30` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '注册时间',
  `khaa31` varchar(30) DEFAULT '' COMMENT '手机类型',
  `khaa32` varchar(30) DEFAULT '' COMMENT '归属账号',
  `khaa33` varchar(30) DEFAULT '' COMMENT '归属姓名',
  `khaa34` varchar(30) DEFAULT '' COMMENT '购买产品',
  `khaa35` decimal(10,2) DEFAULT '0.00' COMMENT '购买次数',
  `khaa36` decimal(10,2) DEFAULT '0.00' COMMENT '身高',
  `khaa37` decimal(10,2) DEFAULT '0.00' COMMENT '体重',
  `khaa38` varchar(30) DEFAULT '' COMMENT '是否成交',
  `khaa39` varchar(2000) DEFAULT '' COMMENT '备注',
  `khaa40` varchar(30) DEFAULT '' COMMENT '工号所在组',
  `khaa41` varchar(50) DEFAULT '' COMMENT '电话类型1',
  `khaa42` varchar(50) DEFAULT '' COMMENT '电话类型2',
  `khaa43` varchar(100) DEFAULT '' COMMENT '跟进标签',
  `khaa44` varchar(30) DEFAULT '' COMMENT '跟进人工号',
  `khaa45` varchar(30) DEFAULT '' COMMENT '跟进人姓名',
  `khaa46` varchar(30) DEFAULT '' COMMENT '上级工号',
  `khaa47` int(11) DEFAULT '0' COMMENT '年龄',
  `khaa48` varchar(50) DEFAULT '' COMMENT '开客户的所属工号(所属客户中转站)',
  PRIMARY KEY (`khaa01`)
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khaa
-- ----------------------------
INSERT INTO `khaa` VALUES ('301', 'KH16020001', '黄晓明', '男', '0000-00-00 00:00:00', '13826191927', '', '', '', '', '', '吉林省,通化市,东昌区,gvtfbg', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '492.00', '', '2016-02-14 15:29:54', '', 'admin', '管理员', '药测试,衣服1号！123,药测试,衣服1号！123,', '2.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('302', 'KH16020002', '邓超', '男', '0000-00-00 00:00:00', '13625451254', '', '', '', '', '', '北京市,北京市,朝阳区,tgretrg', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-14 15:32:40', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('303', 'KH16020003', '孙俪', '男', '1900-01-01 00:00:00', '13265985989', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:11:18', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('304', 'KH16020004', '郑恺', '男', '1900-01-01 00:00:00', '15695984879', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:11:34', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('305', 'KH16020005', '鹿晗', '男', '1900-01-01 00:00:00', '15895986598', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:11:45', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('306', 'KH16020006', '王祖蓝', '男', '1900-01-01 00:00:00', '15845845125', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '165.00', '', '2016-02-22 09:12:08', '', 'admin', '管理员', '药测试,药测试,药测试,', '3.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('307', 'KH16020007', '范冰冰', '男', '1900-01-01 00:00:00', '15847452156', '', '', '', '', '', '北京市,北京市,东城区,112233', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:12:29', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '销售部', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('308', 'KH16020008', '林更新', '男', '1900-01-01 00:00:00', '13521476958', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:12:49', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('309', 'KH16020009', '李晨', '男', '1900-01-01 00:00:00', '15845125584', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:13:08', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('310', 'KH16020010', '何炅', '男', '1900-01-01 00:00:00', '13362565655', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:13:36', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('311', 'KH16020011', '谢娜', '男', '1900-01-01 00:00:00', '13598978458', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:13:47', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'F', '0', '');
INSERT INTO `khaa` VALUES ('312', 'KH16020012', '吴昕', '男', '1900-01-01 00:00:00', '15963256547', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:14:05', '', 'admin', '管理员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('313', 'KH16020013', '陈坤', '男', '1900-01-01 00:00:00', '13625684584', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:14:41', '', 'admin', '管理员', '衣服1号！123,药测试,', '-1.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('314', 'KH16020014', '林心如', '女', '1900-01-01 00:00:00', '15232651548', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '2016-03-01 14:09:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 09:14:57', '', 'admin', '管理员', '衣服1号！123,玛莎玻尿酸原液250ml,碧生源减肥茶20', '-1.00', '0.00', '0.00', '未成交', '', '销售部', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('315', 'KH16020015', '一线客户1', '男', '1900-01-01 00:00:00', '13265145487', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 15:46:49', '', '1111', '一线组员', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('316', 'KH16020016', '一线客户2', '男', '1900-01-01 00:00:00', '13626548787', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 15:47:19', '', '2222', '一线组员2', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('317', 'KH16020017', 'weferf13', '男', '1900-01-01 00:00:00', '13262512452', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 16:52:49', '', '0000', '一线组长', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('318', 'KH16020018', '3w3', '男', '1900-01-01 00:00:00', '13265484444', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 16:53:28', '', '0000', '一线组长', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');
INSERT INTO `khaa` VALUES ('319', 'KH16020019', '一线客户3', '男', '1900-01-01 00:00:00', '13212101201', '', '', '', '', '', ',,,', '', '', '', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '', '', '', '', '', '', '0.00', '', '2016-02-22 17:22:24', '', '2222', '一线组员2', '', '0.00', '0.00', '0.00', '未成交', '', '', '', '', '', '', '', 'admin', '0', '');

-- ----------------------------
-- Table structure for khab
-- ----------------------------
DROP TABLE IF EXISTS `khab`;
CREATE TABLE `khab` (
  `khab01` varchar(30) NOT NULL DEFAULT '' COMMENT '客户编号',
  `khab02` varchar(30) DEFAULT '' COMMENT '地址类型(发票地址,收货地址)',
  `khab03` varchar(255) DEFAULT '' COMMENT '默认地址',
  `khab04` varchar(255) DEFAULT '' COMMENT '地址1',
  `khab05` varchar(255) DEFAULT '' COMMENT '地址2',
  `khab06` varchar(6) DEFAULT '' COMMENT '邮政编码',
  PRIMARY KEY (`khab01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khab
-- ----------------------------
INSERT INTO `khab` VALUES ('KH15120001', '', '山西省,阳泉市,矿　区,', '', '', '');
INSERT INTO `khab` VALUES ('KH15120002', '', '山西省,阳泉市,平定县,', '', '', '');
INSERT INTO `khab` VALUES ('KH15120003', '', '河北省,秦皇岛市,海港区,', '', '', '');
INSERT INTO `khab` VALUES ('KH16010001', '', ',,,', '', '', '');
INSERT INTO `khab` VALUES ('KH16010002', '', '河北省,唐山市,路北区,1111', '', '', '');
INSERT INTO `khab` VALUES ('KH16020001', '', '吉林省,通化市,东昌区,gvtfbg', '', '', '');

-- ----------------------------
-- Table structure for khac
-- ----------------------------
DROP TABLE IF EXISTS `khac`;
CREATE TABLE `khac` (
  `khac01` varchar(50) DEFAULT NULL COMMENT '客户编号',
  `khac02` varchar(100) DEFAULT '' COMMENT '投诉类型',
  `khac03` varchar(50) DEFAULT '' COMMENT '投诉工号',
  `khac04` varchar(50) DEFAULT '' COMMENT '跟进工号',
  `khac05` varchar(50) DEFAULT '' COMMENT '订单编号',
  `khac06` varchar(100) DEFAULT '' COMMENT '投诉产品',
  `khac07` varchar(500) DEFAULT '' COMMENT '备注',
  `khac08` varchar(50) DEFAULT '' COMMENT '处理结果(退款，退货)',
  `khac09` varchar(50) DEFAULT '' COMMENT '提交工号',
  `khac10` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '提交时间',
  `khac11` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '处理时间',
  `khac12` varchar(10) DEFAULT '' COMMENT '是否处理（已处理，未处理）',
  `khac13` varchar(30) DEFAULT '' COMMENT '客户姓名',
  `khac14` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  PRIMARY KEY (`khac14`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khac
-- ----------------------------
INSERT INTO `khac` VALUES ('KH15120001', '11111', 'dsc:dsc111', '99:恩安', '313', '', '312312', '', 'admin', '2016-02-02 10:41:04', '2016-02-02 10:41:04', '未处理', 'aaa', '1');
INSERT INTO `khac` VALUES ('KH16010001', '11111', 'admin:管理员', 'dscz:dengshaocong', '312312', '', '3123213123', '', 'admin', '2016-02-02 10:41:20', '2016-02-02 10:41:20', '未处理', 'dasda', '2');

-- ----------------------------
-- Table structure for khad
-- ----------------------------
DROP TABLE IF EXISTS `khad`;
CREATE TABLE `khad` (
  `khad01` varchar(50) DEFAULT NULL COMMENT '投诉编号（大分类）',
  `khad02` varchar(50) DEFAULT NULL COMMENT '投诉名称',
  `khad03` varchar(50) DEFAULT '' COMMENT '上级编号',
  `khad04` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `khad05` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`khad04`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khad
-- ----------------------------
INSERT INTO `khad` VALUES ('TS16020001', '11111', '', '1', '1000');
INSERT INTO `khad` VALUES ('TS16020002', '2222', '', '2', '2000');

-- ----------------------------
-- Table structure for khae
-- ----------------------------
DROP TABLE IF EXISTS `khae`;
CREATE TABLE `khae` (
  `khae01` varchar(30) DEFAULT '' COMMENT '客户编号',
  `khae02` varchar(100) DEFAULT '' COMMENT '跟进标签(意向客户,电话非常配合,无故挂断,不需要,新进客户)',
  `khae03` varchar(500) DEFAULT '' COMMENT '内容',
  `khae04` varchar(30) DEFAULT '' COMMENT '安排人工号',
  `khae05` varchar(30) DEFAULT '' COMMENT '安排人姓名',
  `khae06` varchar(30) DEFAULT '' COMMENT '跟进人工号',
  `khae07` varchar(50) DEFAULT '' COMMENT '跟进人姓名',
  `khae08` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '记录时间',
  `khae09` datetime DEFAULT '1901-01-01 00:00:00' COMMENT '待办时间',
  `khae10` varchar(20) DEFAULT '' COMMENT '是否完成(未完成,已完成)',
  `khae11` varchar(20) DEFAULT '' COMMENT '所属分组（销售部，二线一组。。。）',
  `khae12` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  PRIMARY KEY (`khae12`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khae
-- ----------------------------
INSERT INTO `khae` VALUES ('KH16010001', '新进客户', '新进客户', 'admin', '管理员', 'admin', '管理员', '2016-01-06 09:49:00', '2016-01-06 09:49:00', '', '', '1');
INSERT INTO `khae` VALUES ('KH16010002', '新进客户', '新进客户', 'admin', '管理员', 'admin', '管理员', '2016-01-20 14:41:00', '2016-01-20 14:41:00', '', '', '2');
INSERT INTO `khae` VALUES ('KH16020001', '新进客户', '新进客户', 'admin', '管理员', 'admin', '管理员', '2016-02-03 16:45:00', '2016-02-03 16:45:00', '', '', '3');
INSERT INTO `khae` VALUES ('KH16020014', '', '321321', 'admin', '管理员', 'admin', '管理员', '2016-02-29 15:13:00', '0000-00-00 00:00:00', '', '', '4');
INSERT INTO `khae` VALUES ('KH16020014', '', '1111', 'admin', '管理员', 'admin', '管理员', '2016-03-01 14:09:00', '0000-00-00 00:00:00', '', '', '5');

-- ----------------------------
-- Table structure for khaf
-- ----------------------------
DROP TABLE IF EXISTS `khaf`;
CREATE TABLE `khaf` (
  `khaf01` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `khaf02` varchar(30) DEFAULT '' COMMENT '接收、发送号码',
  `khaf03` varchar(30) DEFAULT '' COMMENT '短信类型（接收、发送）',
  `khaf04` varchar(20) DEFAULT '' COMMENT '操作工号',
  `khaf05` varchar(20) DEFAULT '' COMMENT '短信内容',
  `khaf06` datetime DEFAULT '1901-01-01 00:00:00' COMMENT '短信时间',
  `khaf07` varchar(30) DEFAULT '1901-01-01 00:00:00' COMMENT '所属分组',
  `khaf08` varchar(30) DEFAULT '' COMMENT '端口',
  PRIMARY KEY (`khaf01`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khaf
-- ----------------------------
INSERT INTO `khaf` VALUES ('1', '13295874586', '接收', 'admin', '内容', '2016-03-03 00:00:00', '销售组', '8080');
INSERT INTO `khaf` VALUES ('2', '13254887434', '发送', 'admin', '内容', '2016-03-03 00:00:00', '销售组', '8080');
INSERT INTO `khaf` VALUES ('3', '13251215454', '接收', 'admin', '内容', '2016-03-03 00:00:00', '销售组', '8080');
INSERT INTO `khaf` VALUES ('4', '13625451254', '接收', 'admin', '内容', '2016-03-03 00:00:00', '销售组', '8080');

-- ----------------------------
-- Table structure for khag
-- ----------------------------
DROP TABLE IF EXISTS `khag`;
CREATE TABLE `khag` (
  `khag01` varchar(30) DEFAULT '' COMMENT '发信人工号',
  `khag02` varchar(30) DEFAULT '' COMMENT '发信人姓名',
  `khag03` varchar(30) DEFAULT '' COMMENT '收信人工号',
  `khag04` varchar(30) DEFAULT '' COMMENT '收信人姓名',
  `khag05` varchar(30) DEFAULT '' COMMENT '标题',
  `khag06` varchar(200) DEFAULT NULL,
  `khag07` datetime DEFAULT NULL COMMENT '''1900-01-01 00:00:00''',
  `khag08` varchar(20) DEFAULT '' COMMENT '状态（未读，已读）',
  `khag09` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  PRIMARY KEY (`khag09`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khag
-- ----------------------------

-- ----------------------------
-- Table structure for khai
-- ----------------------------
DROP TABLE IF EXISTS `khai`;
CREATE TABLE `khai` (
  `khai01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `khai02` varchar(30) DEFAULT NULL COMMENT '编号',
  `khai03` varchar(30) DEFAULT NULL COMMENT '手机',
  PRIMARY KEY (`khai01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khai
-- ----------------------------

-- ----------------------------
-- Table structure for khxm
-- ----------------------------
DROP TABLE IF EXISTS `khxm`;
CREATE TABLE `khxm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `khxm` varchar(50) NOT NULL,
  `type` varchar(5) NOT NULL DEFAULT 'T' COMMENT '奖罚类型 T为奖 F为罚',
  `score` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of khxm
-- ----------------------------
INSERT INTO `khxm` VALUES ('2', '迟到', 'F', '-2');
INSERT INTO `khxm` VALUES ('3', '早退', 'F', '-2');
INSERT INTO `khxm` VALUES ('4', '唱歌', 'T', '2');
INSERT INTO `khxm` VALUES ('7', '输入项目名称', 'F', '-1');
INSERT INTO `khxm` VALUES ('8', '输入项目名称', 'T', '1');
INSERT INTO `khxm` VALUES ('9', '详细信息', 'F', '-1');
INSERT INTO `khxm` VALUES ('10', '1', 'T', '22');
INSERT INTO `khxm` VALUES ('11', '全勤', 'T', '3');
INSERT INTO `khxm` VALUES ('12', '哈哈', 'F', '-2');
INSERT INTO `khxm` VALUES ('13', '呵呵', 'F', '-10');
INSERT INTO `khxm` VALUES ('14', '迟到', 'F', '-2');

-- ----------------------------
-- Table structure for knowledgebase
-- ----------------------------
DROP TABLE IF EXISTS `knowledgebase`;
CREATE TABLE `knowledgebase` (
  `id` varchar(11) NOT NULL DEFAULT '' COMMENT 'ID',
  `type` varchar(50) DEFAULT '' COMMENT '知识分类',
  `title` varchar(20) DEFAULT '' COMMENT '知识标题',
  `private` varchar(5) DEFAULT '否' COMMENT '是否私有',
  `tag` varchar(20) DEFAULT '' COMMENT '标签',
  `source` varchar(50) DEFAULT '' COMMENT '知识来源',
  `iftop` varchar(5) DEFAULT '否' COMMENT '是否置顶',
  `text` varchar(100) DEFAULT '' COMMENT '知识内容',
  `attachment` varchar(100) DEFAULT '' COMMENT '附件地址',
  `zsktime` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '添加时间',
  `viewtime` int(10) DEFAULT '0' COMMENT '浏览次数',
  `setter` varchar(50) DEFAULT '' COMMENT '操作人',
  `opetime` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of knowledgebase
-- ----------------------------
INSERT INTO `knowledgebase` VALUES ('ZS16010001', '测试123', 'ceshi 123', '否', '123', '123', '否', '123123', '', '2016-01-08 16:46:43', '0', '', '2016-01-08 16:46:43');
INSERT INTO `knowledgebase` VALUES ('ZS16010002', '测试44', '123123', '否', '', '', '否', '1432134134', '', '2016-01-08 17:02:00', '0', 'dengshaocong', '2016-01-08 17:02:00');
INSERT INTO `knowledgebase` VALUES ('ZS16010003', '1', '私有测试', '否', '132', '123', '否', '123254', '', '2016-01-11 09:32:13', '0', 'dengshaocong', '2016-01-11 09:32:13');
INSERT INTO `knowledgebase` VALUES ('ZS16010004', '测试123', '123123', '是', '123', '', '是', '123', '', '2016-01-11 10:21:40', '0', 'dengshaocong', '2016-01-11 11:35:13');

-- ----------------------------
-- Table structure for knowledgetype
-- ----------------------------
DROP TABLE IF EXISTS `knowledgetype`;
CREATE TABLE `knowledgetype` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `typename` varchar(50) DEFAULT '' COMMENT '类型名称',
  `operylist` varchar(200) DEFAULT '' COMMENT '操作工号（用,隔开，存储有操作权限的工号ID）',
  `viewrylist` varchar(200) DEFAULT '' COMMENT '浏览工号（用,隔开，存储有浏览权限的工号ID）',
  `typetext` varchar(200) DEFAULT '' COMMENT '分类描述',
  `higherlevel` int(10) DEFAULT '0' COMMENT '上一级分类的ID',
  `level` int(10) DEFAULT '0' COMMENT '级别，用于层级关系',
  `opetime` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of knowledgetype
-- ----------------------------
INSERT INTO `knowledgetype` VALUES ('1', '测试123', '', '', '撒旦法撒旦发送到发送到发送到', '0', '0', '2016-01-07 14:58:29');
INSERT INTO `knowledgetype` VALUES ('3', '测试44', '', '', '撒旦法asdf', '1', '1', '2016-01-07 16:02:25');
INSERT INTO `knowledgetype` VALUES ('4', '测试123', '123123', '', '1234213', '3', '2', '2016-01-08 10:36:04');

-- ----------------------------
-- Table structure for loginset
-- ----------------------------
DROP TABLE IF EXISTS `loginset`;
CREATE TABLE `loginset` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` varchar(30) DEFAULT '' COMMENT '登录人员工号',
  `loginip` varchar(50) DEFAULT '' COMMENT '登录IP',
  `loginmac` varchar(50) DEFAULT '' COMMENT '登录MAC',
  `loginfj` varchar(50) DEFAULT '' COMMENT '登录分机',
  `logintime` datetime DEFAULT '1990-01-01 00:00:00' COMMENT '登录时间',
  `ifself` varchar(10) DEFAULT 'Y' COMMENT '是否本人登录',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of loginset
-- ----------------------------
INSERT INTO `loginset` VALUES ('1', 'aaa', '127.0.0.1', '', '', '2015-11-27 10:10:16', 'Y');
INSERT INTO `loginset` VALUES ('2', 'aaa', '127.0.0.1', '', '', '2015-11-27 11:08:12', 'Y');
INSERT INTO `loginset` VALUES ('3', 'aaa', '127.0.0.1', '', '', '2015-11-30 09:54:51', 'Y');
INSERT INTO `loginset` VALUES ('4', 'aaa', '127.0.0.1', '', '', '2015-12-01 14:15:15', 'Y');
INSERT INTO `loginset` VALUES ('5', 'aaa', '127.0.0.1', '', '', '2015-12-02 09:17:26', 'Y');
INSERT INTO `loginset` VALUES ('6', 'aaa', '127.0.0.1', '', '', '2015-12-03 09:25:26', 'Y');
INSERT INTO `loginset` VALUES ('7', 'bbb', '127.0.0.1', '', '', '2015-12-03 09:25:34', 'Y');
INSERT INTO `loginset` VALUES ('8', 'aaa', '127.0.0.1', '', '', '2015-12-04 09:18:39', 'Y');
INSERT INTO `loginset` VALUES ('9', 'admin', '127.0.0.1', '', '', '2015-12-07 10:04:32', 'Y');
INSERT INTO `loginset` VALUES ('10', 'admin', '127.0.0.1', '', '', '2015-12-14 10:19:59', 'Y');
INSERT INTO `loginset` VALUES ('11', 'admin', '127.0.0.1', '', '', '2015-12-15 09:50:30', 'Y');
INSERT INTO `loginset` VALUES ('12', 'admin', '127.0.0.1', '', '', '2015-12-16 09:42:21', 'Y');
INSERT INTO `loginset` VALUES ('13', 'admin', '127.0.0.1', '', '', '2015-12-17 09:28:28', 'Y');
INSERT INTO `loginset` VALUES ('14', 'admin', '127.0.0.1', '', '', '2015-12-18 10:18:57', 'Y');
INSERT INTO `loginset` VALUES ('15', 'admin', '127.0.0.1', '', '', '2015-12-21 09:53:38', 'Y');
INSERT INTO `loginset` VALUES ('16', 'admin', '127.0.0.1', '', '', '2015-12-21 13:05:58', 'Y');
INSERT INTO `loginset` VALUES ('17', 'admin', '127.0.0.1', '', '', '2015-12-22 09:30:59', 'Y');
INSERT INTO `loginset` VALUES ('18', 'admin', '127.0.0.1', '', '', '2015-12-22 10:10:06', 'Y');
INSERT INTO `loginset` VALUES ('19', 'waa', '127.0.0.1', '', '', '2015-12-22 10:15:53', 'Y');
INSERT INTO `loginset` VALUES ('20', 'admin', '127.0.0.1', '', '', '2015-12-22 10:28:27', 'Y');
INSERT INTO `loginset` VALUES ('21', 'admin', '127.0.0.1', '', '', '2015-12-22 10:37:08', 'Y');
INSERT INTO `loginset` VALUES ('22', 'admin', '127.0.0.1', '', '', '2015-12-22 10:41:31', 'Y');
INSERT INTO `loginset` VALUES ('23', 'admin', '127.0.0.1', '', '', '2015-12-23 09:48:38', 'Y');
INSERT INTO `loginset` VALUES ('24', 'admin', '127.0.0.1', '', '', '2015-12-23 11:33:44', 'Y');
INSERT INTO `loginset` VALUES ('25', 'admin', '127.0.0.1', '', '', '2015-12-23 17:31:37', 'Y');
INSERT INTO `loginset` VALUES ('26', 'waa', '127.0.0.1', '', '', '2015-12-23 17:32:53', 'Y');
INSERT INTO `loginset` VALUES ('27', 'admin', '127.0.0.1', '', '', '2015-12-23 18:40:01', 'Y');
INSERT INTO `loginset` VALUES ('28', 'admin', '127.0.0.1', '', '', '2015-12-24 09:32:37', 'Y');
INSERT INTO `loginset` VALUES ('29', 'admin', '127.0.0.1', '', '', '2015-12-24 16:31:50', 'Y');
INSERT INTO `loginset` VALUES ('30', 'admin', '127.0.0.1', '', '', '2015-12-24 17:22:28', 'Y');
INSERT INTO `loginset` VALUES ('31', 'admin', '127.0.0.1', '', '', '2015-12-24 17:24:00', 'Y');
INSERT INTO `loginset` VALUES ('32', 'admin', '127.0.0.1', '', '', '2015-12-25 09:32:11', 'Y');
INSERT INTO `loginset` VALUES ('33', 'admin', '127.0.0.1', '', '', '2015-12-28 09:16:38', 'Y');
INSERT INTO `loginset` VALUES ('34', 'admin', '127.0.0.1', '', '', '2015-12-28 17:43:27', 'Y');
INSERT INTO `loginset` VALUES ('35', 'admin', '127.0.0.1', '', '', '2015-12-29 09:28:39', 'Y');
INSERT INTO `loginset` VALUES ('36', 'admin', '127.0.0.1', '', '', '2015-12-29 14:46:25', 'Y');
INSERT INTO `loginset` VALUES ('37', 'admin', '127.0.0.1', '', '', '2015-12-29 14:52:15', 'Y');
INSERT INTO `loginset` VALUES ('38', 'admin', '127.0.0.1', '', '', '2015-12-30 09:16:18', 'Y');
INSERT INTO `loginset` VALUES ('39', 'admin', '::1', '', '', '2015-12-30 11:10:14', 'Y');
INSERT INTO `loginset` VALUES ('40', 'admin', '127.0.0.1', '', '', '2015-12-31 09:45:26', 'Y');
INSERT INTO `loginset` VALUES ('41', 'admin', '127.0.0.1', '', '', '2016-01-04 16:50:32', 'Y');
INSERT INTO `loginset` VALUES ('42', 'admin', '127.0.0.1', '', '', '2016-01-05 09:46:48', 'Y');
INSERT INTO `loginset` VALUES ('43', 'admin', '127.0.0.1', '', '', '2016-01-06 09:26:30', 'Y');
INSERT INTO `loginset` VALUES ('44', 'admin', '127.0.0.1', '', '', '2016-01-07 09:17:09', 'Y');
INSERT INTO `loginset` VALUES ('45', 'admin', '127.0.0.1', '', '', '2016-01-07 11:17:29', 'Y');
INSERT INTO `loginset` VALUES ('46', 'admin', '127.0.0.1', '', '', '2016-01-08 09:42:18', 'Y');
INSERT INTO `loginset` VALUES ('47', 'admin', '127.0.0.1', '', '', '2016-01-09 18:04:42', 'Y');
INSERT INTO `loginset` VALUES ('48', 'admin', '127.0.0.1', '', '', '2016-01-11 09:14:23', 'Y');
INSERT INTO `loginset` VALUES ('49', 'admin', '127.0.0.1', '', '', '2016-01-11 11:22:19', 'Y');
INSERT INTO `loginset` VALUES ('50', 'waa', '127.0.0.1', '', '', '2016-01-11 12:02:34', 'Y');
INSERT INTO `loginset` VALUES ('51', 'admin', '127.0.0.1', '', '', '2016-01-11 12:02:50', 'Y');
INSERT INTO `loginset` VALUES ('52', 'admin', '127.0.0.1', '', '', '2016-01-11 12:03:58', 'Y');
INSERT INTO `loginset` VALUES ('53', 'admin', '127.0.0.1', '', '', '2016-01-11 12:14:38', 'Y');
INSERT INTO `loginset` VALUES ('54', 'admin', '127.0.0.1', '', '', '2016-01-11 12:28:07', 'Y');
INSERT INTO `loginset` VALUES ('55', 'admin', '127.0.0.1', '', '', '2016-01-11 12:51:50', 'Y');
INSERT INTO `loginset` VALUES ('56', 'waa', '127.0.0.1', '', '', '2016-01-11 12:53:56', 'Y');
INSERT INTO `loginset` VALUES ('57', 'admin', '127.0.0.1', '', '', '2016-01-11 12:54:06', 'Y');
INSERT INTO `loginset` VALUES ('58', 'admin', '127.0.0.1', '', '', '2016-01-12 09:27:50', 'Y');
INSERT INTO `loginset` VALUES ('59', 'admin', '127.0.0.1', '', '', '2016-01-12 12:05:47', 'Y');
INSERT INTO `loginset` VALUES ('60', 'admin', '127.0.0.1', '', '', '2016-01-13 09:36:14', 'Y');
INSERT INTO `loginset` VALUES ('61', 'admin', '127.0.0.1', '', '', '2016-01-13 14:57:30', 'Y');
INSERT INTO `loginset` VALUES ('62', 'admin', '127.0.0.1', '', '', '2016-01-13 15:01:41', 'Y');
INSERT INTO `loginset` VALUES ('63', 'admin', '127.0.0.1', '', '', '2016-01-13 15:56:01', 'Y');
INSERT INTO `loginset` VALUES ('64', 'admin', '127.0.0.1', '', '', '2016-01-13 16:00:04', 'Y');
INSERT INTO `loginset` VALUES ('65', 'admin', '127.0.0.1', '', '', '2016-01-13 16:00:52', 'Y');
INSERT INTO `loginset` VALUES ('66', 'admin', '127.0.0.1', '', '', '2016-01-13 17:09:13', 'Y');
INSERT INTO `loginset` VALUES ('67', 'admin', '127.0.0.1', '', '', '2016-01-13 17:11:04', 'Y');
INSERT INTO `loginset` VALUES ('68', 'admin', '127.0.0.1', '', '', '2016-01-13 17:12:20', 'Y');
INSERT INTO `loginset` VALUES ('69', 'admin', '127.0.0.1', '', '', '2016-01-14 09:34:28', 'Y');
INSERT INTO `loginset` VALUES ('70', 'admin', '127.0.0.1', '', '', '2016-01-15 09:30:54', 'Y');
INSERT INTO `loginset` VALUES ('71', 'admin', '127.0.0.1', '', '', '2016-01-15 11:10:45', 'Y');
INSERT INTO `loginset` VALUES ('72', 'admin', '127.0.0.1', '', '', '2016-01-18 09:58:25', 'Y');
INSERT INTO `loginset` VALUES ('73', 'admin', '::1', '', '', '2016-01-18 14:41:41', 'Y');
INSERT INTO `loginset` VALUES ('74', 'admin', '127.0.0.1', '', '', '2016-01-18 14:51:38', 'Y');
INSERT INTO `loginset` VALUES ('75', 'admin', '127.0.0.1', '', '', '2016-01-18 15:07:47', 'Y');
INSERT INTO `loginset` VALUES ('76', 'admin', '127.0.0.1', '', '', '2016-01-18 15:26:16', 'Y');
INSERT INTO `loginset` VALUES ('77', 'admin', '127.0.0.1', '', '', '2016-01-19 10:11:56', 'Y');
INSERT INTO `loginset` VALUES ('78', 'admin', '127.0.0.1', '', '', '2016-01-19 14:51:53', 'Y');
INSERT INTO `loginset` VALUES ('79', 'admin', '127.0.0.1', '', '', '2016-01-19 15:30:57', 'Y');
INSERT INTO `loginset` VALUES ('80', 'admin', '127.0.0.1', '', '', '2016-01-20 09:21:12', 'Y');
INSERT INTO `loginset` VALUES ('81', 'admin', '127.0.0.1', '', '', '2016-01-21 09:49:30', 'Y');
INSERT INTO `loginset` VALUES ('82', 'admin', '127.0.0.1', '', '', '2016-01-21 10:55:41', 'Y');
INSERT INTO `loginset` VALUES ('83', 'admin', '127.0.0.1', '', '', '2016-01-21 16:17:19', 'Y');
INSERT INTO `loginset` VALUES ('84', 'admin', '127.0.0.1', '', '', '2016-01-22 09:20:31', 'Y');
INSERT INTO `loginset` VALUES ('85', 'admin', '127.0.0.1', '', '', '2016-01-23 10:02:01', 'Y');
INSERT INTO `loginset` VALUES ('86', 'admin', '127.0.0.1', '', '', '2016-01-25 09:20:42', 'Y');
INSERT INTO `loginset` VALUES ('87', 'admin', '127.0.0.1', '', '', '2016-01-26 09:15:32', 'Y');
INSERT INTO `loginset` VALUES ('88', 'admin', '127.0.0.1', '', '', '2016-01-26 15:26:40', 'Y');
INSERT INTO `loginset` VALUES ('89', 'admin', '127.0.0.1', '', '', '2016-01-27 09:45:06', 'Y');
INSERT INTO `loginset` VALUES ('90', 'admin', '127.0.0.1', '', '', '2016-01-27 11:07:26', 'Y');
INSERT INTO `loginset` VALUES ('91', 'admin', '127.0.0.1', '', '', '2016-01-27 13:40:01', 'Y');
INSERT INTO `loginset` VALUES ('92', 'admin', '192.168.10.188', '', '', '2016-01-27 17:30:40', 'Y');
INSERT INTO `loginset` VALUES ('93', 'admin', '127.0.0.1', '', '', '2016-01-28 09:30:57', 'Y');
INSERT INTO `loginset` VALUES ('94', 'admin', '127.0.0.1', '', '', '2016-01-28 09:45:28', 'Y');
INSERT INTO `loginset` VALUES ('95', 'admin', '127.0.0.1', '', '', '2016-01-28 14:56:09', 'Y');
INSERT INTO `loginset` VALUES ('96', 'admin', '127.0.0.1', '', '', '2016-01-29 13:38:29', 'Y');
INSERT INTO `loginset` VALUES ('97', 'admin', '127.0.0.1', '', '', '2016-02-01 09:17:56', 'Y');
INSERT INTO `loginset` VALUES ('98', 'admin', '127.0.0.1', '', '', '2016-02-02 09:26:49', 'Y');
INSERT INTO `loginset` VALUES ('99', 'admin', '127.0.0.1', '', '', '2016-02-03 09:47:13', 'Y');
INSERT INTO `loginset` VALUES ('100', 'admin', '127.0.0.1', '', '', '2016-02-03 10:57:22', 'Y');
INSERT INTO `loginset` VALUES ('101', 'admin', '127.0.0.1', '', '', '2016-02-04 10:01:50', 'Y');
INSERT INTO `loginset` VALUES ('102', 'admin', '::1', '', '', '2016-02-04 18:06:52', 'Y');
INSERT INTO `loginset` VALUES ('103', 'admin', '::1', '', '', '2016-02-04 18:08:14', 'Y');
INSERT INTO `loginset` VALUES ('104', 'admin', '::1', '', '', '2016-02-04 18:10:34', 'Y');
INSERT INTO `loginset` VALUES ('105', 'admin', '127.0.0.1', '', '', '2016-02-04 18:26:55', 'Y');
INSERT INTO `loginset` VALUES ('106', 'admin', '127.0.0.1', '', '', '2016-02-04 18:26:56', 'Y');
INSERT INTO `loginset` VALUES ('107', 'admin', '127.0.0.1', '', '', '2016-02-14 10:33:46', 'Y');
INSERT INTO `loginset` VALUES ('108', 'admin', '127.0.0.1', '', '', '2016-02-14 10:47:43', 'Y');
INSERT INTO `loginset` VALUES ('109', 'admin', '127.0.0.1', '', '', '2016-02-14 11:05:19', 'Y');
INSERT INTO `loginset` VALUES ('110', 'admin', '127.0.0.1', '', '', '2016-02-14 11:06:08', 'Y');
INSERT INTO `loginset` VALUES ('111', 'admin', '192.168.10.188', '', '', '2016-02-14 17:01:20', 'Y');
INSERT INTO `loginset` VALUES ('112', 'admin', '127.0.0.1', '', '', '2016-02-15 09:14:35', 'Y');
INSERT INTO `loginset` VALUES ('113', 'admin', '127.0.0.1', '', '', '2016-02-15 09:31:17', 'Y');
INSERT INTO `loginset` VALUES ('114', 'admin', '127.0.0.1', '', '', '2016-02-15 09:32:43', 'Y');
INSERT INTO `loginset` VALUES ('115', 'admin', '192.168.10.188', '', '', '2016-02-15 16:10:41', 'Y');
INSERT INTO `loginset` VALUES ('116', 'admin', '127.0.0.1', '', '', '2016-02-17 09:35:02', 'Y');
INSERT INTO `loginset` VALUES ('117', 'admin', '127.0.0.1', '', '', '2016-02-18 09:30:55', 'Y');
INSERT INTO `loginset` VALUES ('118', 'admin', '::1', '', '', '2016-02-18 15:10:08', 'Y');
INSERT INTO `loginset` VALUES ('119', 'admin', '::1', '', '', '2016-02-18 16:22:07', 'Y');
INSERT INTO `loginset` VALUES ('120', 'admin', '127.0.0.1', '', '', '2016-02-18 16:50:20', 'Y');
INSERT INTO `loginset` VALUES ('121', 'admin', '127.0.0.1', '', '', '2016-02-18 17:11:33', 'Y');
INSERT INTO `loginset` VALUES ('122', 'admin', '127.0.0.1', '', '', '2016-02-18 19:27:08', 'Y');
INSERT INTO `loginset` VALUES ('123', 'admin', '127.0.0.1', '', '', '2016-02-19 09:19:21', 'Y');
INSERT INTO `loginset` VALUES ('124', 'admin', '127.0.0.1', '', '', '2016-02-19 14:27:31', 'Y');
INSERT INTO `loginset` VALUES ('125', 'admin', '::1', '', '', '2016-02-19 14:31:39', 'Y');
INSERT INTO `loginset` VALUES ('126', 'admin', '::1', '', '', '2016-02-19 17:07:13', 'Y');
INSERT INTO `loginset` VALUES ('127', 'admin', '127.0.0.1', '', '', '2016-02-22 09:46:21', 'Y');
INSERT INTO `loginset` VALUES ('128', 'admin', '127.0.0.1', '', '', '2016-02-22 13:54:12', 'Y');
INSERT INTO `loginset` VALUES ('129', 'admin', '::1', '', '', '2016-02-22 16:01:40', 'Y');
INSERT INTO `loginset` VALUES ('130', 'admin', '127.0.0.1', '', '', '2016-02-22 16:01:55', 'Y');
INSERT INTO `loginset` VALUES ('131', 'admin', '127.0.0.1', '', '', '2016-02-23 09:15:41', 'Y');
INSERT INTO `loginset` VALUES ('132', '0000', '127.0.0.1', '', '', '2016-02-23 15:42:16', 'Y');
INSERT INTO `loginset` VALUES ('133', 'admin', '127.0.0.1', '', '', '2016-02-23 16:26:02', 'Y');
INSERT INTO `loginset` VALUES ('134', 'admin', '127.0.0.1', '', '', '2016-02-24 09:11:24', 'Y');
INSERT INTO `loginset` VALUES ('135', 'admin', '127.0.0.1', '', '', '2016-02-24 09:38:49', 'Y');
INSERT INTO `loginset` VALUES ('136', '1111', '127.0.0.1', '', '', '2016-02-24 16:27:07', 'Y');
INSERT INTO `loginset` VALUES ('137', 'admin', '127.0.0.1', '', '', '2016-02-24 16:27:37', 'Y');
INSERT INTO `loginset` VALUES ('138', '1111', '127.0.0.1', '', '', '2016-02-24 16:29:06', 'Y');
INSERT INTO `loginset` VALUES ('139', 'admin', '127.0.0.1', '', '', '2016-02-25 09:16:33', 'Y');
INSERT INTO `loginset` VALUES ('140', 'admin', '127.0.0.1', '', '', '2016-02-25 15:01:00', 'Y');
INSERT INTO `loginset` VALUES ('141', 'admin', '127.0.0.1', '', '', '2016-02-25 15:58:24', 'Y');
INSERT INTO `loginset` VALUES ('142', 'admin', '127.0.0.1', '', '', '2016-02-25 19:36:41', 'Y');
INSERT INTO `loginset` VALUES ('143', 'admin', '127.0.0.1', '', '', '2016-02-26 09:40:16', 'Y');
INSERT INTO `loginset` VALUES ('144', 'admin', '127.0.0.1', '', '', '2016-02-26 09:57:39', 'Y');
INSERT INTO `loginset` VALUES ('145', 'admin', '127.0.0.1', '', '', '2016-02-26 09:57:52', 'Y');
INSERT INTO `loginset` VALUES ('146', 'admin', '127.0.0.1', '', '', '2016-02-26 09:59:05', 'Y');
INSERT INTO `loginset` VALUES ('147', 'admin', '127.0.0.1', '', '', '2016-02-26 10:16:44', 'Y');
INSERT INTO `loginset` VALUES ('148', 'admin', '127.0.0.1', '', '', '2016-02-26 11:42:42', 'Y');
INSERT INTO `loginset` VALUES ('149', 'admin', '127.0.0.1', '', '', '2016-02-26 13:57:09', 'Y');
INSERT INTO `loginset` VALUES ('150', 'admin', '127.0.0.1', '', '', '2016-02-26 14:36:08', 'Y');
INSERT INTO `loginset` VALUES ('151', 'admin', '::1', '', '', '2016-02-26 14:38:55', 'Y');
INSERT INTO `loginset` VALUES ('152', 'admin', '::1', '', '', '2016-02-26 15:49:20', 'Y');
INSERT INTO `loginset` VALUES ('153', 'admin', '127.0.0.1', '', '', '2016-02-26 16:35:45', 'Y');
INSERT INTO `loginset` VALUES ('154', 'admin', '127.0.0.1', '', '', '2016-02-29 09:23:39', 'Y');
INSERT INTO `loginset` VALUES ('155', 'admin', '127.0.0.1', '', '', '2016-02-29 10:48:08', 'Y');
INSERT INTO `loginset` VALUES ('156', 'admin', '127.0.0.1', '', '', '2016-02-29 11:38:48', 'Y');
INSERT INTO `loginset` VALUES ('157', 'admin', '127.0.0.1', '', '', '2016-02-29 11:38:53', 'Y');
INSERT INTO `loginset` VALUES ('158', 'admin', '127.0.0.1', '', '', '2016-02-29 11:42:30', 'Y');
INSERT INTO `loginset` VALUES ('159', 'admin', '127.0.0.1', '', '', '2016-02-29 11:42:40', 'Y');
INSERT INTO `loginset` VALUES ('160', 'admin', '127.0.0.1', '', '', '2016-03-01 09:47:00', 'Y');
INSERT INTO `loginset` VALUES ('161', 'admin', '127.0.0.1', '', '', '2016-03-01 11:13:56', 'Y');
INSERT INTO `loginset` VALUES ('162', 'admin', '127.0.0.1', '', '', '2016-03-02 09:08:19', 'Y');
INSERT INTO `loginset` VALUES ('163', 'admin', '127.0.0.1', '', '', '2016-03-02 09:09:47', 'Y');
INSERT INTO `loginset` VALUES ('164', 'admin', '127.0.0.1', '', '', '2016-03-03 09:24:16', 'Y');
INSERT INTO `loginset` VALUES ('165', 'admin', '127.0.0.1', '', '', '2016-03-03 14:49:35', 'Y');
INSERT INTO `loginset` VALUES ('166', 'admin', '127.0.0.1', '', '', '2016-03-04 09:05:18', 'Y');
INSERT INTO `loginset` VALUES ('167', 'admin', '127.0.0.1', '', '', '2016-03-07 09:17:58', 'Y');
INSERT INTO `loginset` VALUES ('168', 'admin', '127.0.0.1', '', '', '2016-03-07 16:54:42', 'Y');
INSERT INTO `loginset` VALUES ('169', 'admin', '127.0.0.1', '', '', '2016-03-08 09:23:10', 'Y');
INSERT INTO `loginset` VALUES ('170', 'admin', '127.0.0.1', '', '', '2016-03-08 17:49:29', 'Y');
INSERT INTO `loginset` VALUES ('171', 'admin', '127.0.0.1', '', '', '2016-03-08 17:51:46', 'Y');
INSERT INTO `loginset` VALUES ('172', 'admin', '127.0.0.1', '', '', '2016-03-08 18:04:02', 'Y');
INSERT INTO `loginset` VALUES ('173', 'admin', '127.0.0.1', '', '', '2016-03-08 18:08:02', 'Y');
INSERT INTO `loginset` VALUES ('174', 'admin', '127.0.0.1', '', '', '2016-03-08 18:08:46', 'Y');
INSERT INTO `loginset` VALUES ('175', 'admin', '127.0.0.1', '', '', '2016-03-09 10:06:04', 'Y');
INSERT INTO `loginset` VALUES ('176', 'admin', '127.0.0.1', '', '', '2016-03-10 09:41:44', 'Y');
INSERT INTO `loginset` VALUES ('177', 'admin', '127.0.0.1', '', '', '2016-03-11 09:22:53', 'Y');
INSERT INTO `loginset` VALUES ('178', 'admin', '127.0.0.1', '', '', '2016-03-11 11:30:06', 'Y');
INSERT INTO `loginset` VALUES ('179', 'admin', '127.0.0.1', '', '', '2016-03-14 09:17:41', 'Y');
INSERT INTO `loginset` VALUES ('180', 'admin', '::1', '', '', '2016-03-14 11:17:56', 'Y');
INSERT INTO `loginset` VALUES ('181', 'admin', '127.0.0.1', '', '', '2016-03-14 11:26:01', 'Y');
INSERT INTO `loginset` VALUES ('182', 'admin', '127.0.0.1', '', '', '2016-03-15 08:53:00', 'Y');
INSERT INTO `loginset` VALUES ('183', 'admin', '::1', '', '', '2016-03-15 14:35:10', 'Y');
INSERT INTO `loginset` VALUES ('184', 'admin', '127.0.0.1', '', '', '2016-03-15 14:44:52', 'Y');
INSERT INTO `loginset` VALUES ('185', 'admin', '127.0.0.1', '', '', '2016-03-16 09:03:09', 'Y');
INSERT INTO `loginset` VALUES ('186', 'admin', '127.0.0.1', '', '', '2016-03-17 09:19:05', 'Y');
INSERT INTO `loginset` VALUES ('187', 'admin', '127.0.0.1', '', '', '2016-03-17 16:30:15', 'Y');
INSERT INTO `loginset` VALUES ('188', 'admin', '127.0.0.1', '', '', '2016-03-17 16:33:56', 'Y');
INSERT INTO `loginset` VALUES ('189', 'admin', '127.0.0.1', '', '', '2016-03-18 09:54:57', 'Y');
INSERT INTO `loginset` VALUES ('190', 'admin', '::1', '', '', '2016-03-18 10:35:07', 'Y');
INSERT INTO `loginset` VALUES ('191', 'admin', '127.0.0.1', '', '', '2016-03-21 09:26:04', 'Y');
INSERT INTO `loginset` VALUES ('192', 'admin', '::1', '', '', '2016-03-21 18:11:00', 'Y');
INSERT INTO `loginset` VALUES ('193', 'admin', '::1', '', '', '2016-03-21 18:42:01', 'Y');
INSERT INTO `loginset` VALUES ('194', 'admin', '127.0.0.1', '', '', '2016-03-21 18:51:31', 'Y');
INSERT INTO `loginset` VALUES ('195', 'admin', '127.0.0.1', '', '', '2016-03-22 10:07:01', 'Y');
INSERT INTO `loginset` VALUES ('196', 'admin', '127.0.0.1', '', '', '2016-03-23 09:10:11', 'Y');
INSERT INTO `loginset` VALUES ('197', 'admin', '127.0.0.1', '', '', '2016-03-24 10:26:08', 'Y');
INSERT INTO `loginset` VALUES ('198', 'admin', '127.0.0.1', '', '', '2016-03-25 09:09:32', 'Y');
INSERT INTO `loginset` VALUES ('199', 'admin', '127.0.0.1', '', '', '2016-03-25 09:10:39', 'Y');
INSERT INTO `loginset` VALUES ('200', 'admin', '::1', '', '', '2016-03-25 11:20:24', 'Y');
INSERT INTO `loginset` VALUES ('201', 'admin', '127.0.0.1', '', '', '2016-03-25 11:33:17', 'Y');
INSERT INTO `loginset` VALUES ('202', 'admin', '127.0.0.1', '', '', '2016-03-25 15:53:07', 'Y');
INSERT INTO `loginset` VALUES ('203', 'admin', '127.0.0.1', '', '', '2016-03-25 17:15:16', 'Y');
INSERT INTO `loginset` VALUES ('204', 'admin', '127.0.0.1', '', '', '2016-03-25 17:25:50', 'Y');
INSERT INTO `loginset` VALUES ('205', 'admin', '127.0.0.1', '', '', '2016-03-25 17:35:56', 'Y');
INSERT INTO `loginset` VALUES ('206', 'admin', '127.0.0.1', '', '', '2016-03-25 17:52:56', 'Y');
INSERT INTO `loginset` VALUES ('207', 'admin', '127.0.0.1', '', '', '2016-03-25 18:57:04', 'Y');
INSERT INTO `loginset` VALUES ('208', 'admin', '127.0.0.1', '', '', '2016-03-25 20:00:27', 'Y');
INSERT INTO `loginset` VALUES ('209', 'admin', '127.0.0.1', '', '', '2016-03-28 09:42:29', 'Y');
INSERT INTO `loginset` VALUES ('210', 'admin', '127.0.0.1', '', '', '2016-03-28 09:43:38', 'Y');
INSERT INTO `loginset` VALUES ('211', 'admin', '::1', '', '', '2016-03-28 15:15:50', 'Y');
INSERT INTO `loginset` VALUES ('212', 'admin', '127.0.0.1', '', '', '2016-03-29 10:08:48', 'Y');
INSERT INTO `loginset` VALUES ('213', 'admin', '127.0.0.1', '', '', '2016-03-29 10:27:42', 'Y');
INSERT INTO `loginset` VALUES ('214', 'admin', '127.0.0.1', '', '', '2016-03-29 10:31:27', 'Y');
INSERT INTO `loginset` VALUES ('215', 'admin', '127.0.0.1', '', '', '2016-03-29 11:30:46', 'Y');
INSERT INTO `loginset` VALUES ('216', 'admin', '127.0.0.1', '', '', '2016-03-29 11:31:01', 'Y');
INSERT INTO `loginset` VALUES ('217', 'admin', '127.0.0.1', '', '', '2016-03-29 11:40:31', 'Y');
INSERT INTO `loginset` VALUES ('218', 'admin', '127.0.0.1', '', '', '2016-03-29 11:42:37', 'Y');
INSERT INTO `loginset` VALUES ('219', 'admin', '127.0.0.1', '', '', '2016-03-29 11:46:17', 'Y');
INSERT INTO `loginset` VALUES ('220', 'admin', '127.0.0.1', '', '', '2016-03-29 11:47:19', 'Y');
INSERT INTO `loginset` VALUES ('221', 'admin', '127.0.0.1', '', '', '2016-03-29 19:33:53', 'Y');
INSERT INTO `loginset` VALUES ('222', 'admin', '127.0.0.1', '', '', '2016-03-30 09:40:13', 'Y');
INSERT INTO `loginset` VALUES ('223', 'admin', '::1', '', '', '2016-03-30 10:41:10', 'Y');
INSERT INTO `loginset` VALUES ('224', 'admin', '127.0.0.1', '', '', '2016-03-30 10:41:28', 'Y');
INSERT INTO `loginset` VALUES ('225', 'admin', '127.0.0.1', '', '', '2016-03-31 09:15:15', 'Y');
INSERT INTO `loginset` VALUES ('226', 'admin', '::1', '', '', '2016-03-31 11:57:27', 'Y');
INSERT INTO `loginset` VALUES ('227', 'admin', '::1', '', '', '2016-03-31 11:57:27', 'Y');
INSERT INTO `loginset` VALUES ('228', 'admin', '127.0.0.1', '', '', '2016-03-31 12:04:31', 'Y');
INSERT INTO `loginset` VALUES ('229', 'admin', '127.0.0.1', '', '', '2016-04-01 10:26:38', 'Y');

-- ----------------------------
-- Table structure for mediaset
-- ----------------------------
DROP TABLE IF EXISTS `mediaset`;
CREATE TABLE `mediaset` (
  `mediaid` varchar(20) DEFAULT '' COMMENT '媒体渠道ID',
  `mediatext` varchar(50) DEFAULT '' COMMENT '媒体渠道名称',
  `type` varchar(20) DEFAULT '' COMMENT '分类（电视，杂志，网络，其他）',
  `mtfl` varchar(20) DEFAULT '' COMMENT '对应商品分类',
  `phone` varchar(20) DEFAULT '' COMMENT '媒体电话',
  `xh` varchar(10) DEFAULT '' COMMENT '排序',
  `display` varchar(10) DEFAULT '显示' COMMENT '是否显示（显示隐藏）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mediaset
-- ----------------------------
INSERT INTO `mediaset` VALUES ('MT15120001', '超级网络', '网络', '美容', '25142231', '', '显示');
INSERT INTO `mediaset` VALUES ('MT15120002', '超级电视', '电视', '燕麦', '', '', '显示');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `MENU_NAME` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称（自身编号）',
  `ILLUSTRATE` varchar(50) DEFAULT '' COMMENT '菜单说明',
  `MENU_BH` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单上级编号',
  `RIGHT_ID` varchar(11) DEFAULT '' COMMENT '权限位（外键）',
  `DISPLAY_NUM` varchar(11) DEFAULT '' COMMENT '显示序号',
  `WEB` varchar(50) DEFAULT '' COMMENT '菜单连接的网站',
  PRIMARY KEY (`MENU_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('A01', '客户管理', '', '1', '001000', '');
INSERT INTO `menu` VALUES ('A01001', '添加客户资料', 'A01', '15', '001001', 'index.php?r=khgl/GetTjkhzlHtml');
INSERT INTO `menu` VALUES ('A01002', '查询客户资料', 'A01', '16', '001002', 'index.php?r=khgl/GetCxkhzlHtml');
INSERT INTO `menu` VALUES ('A01003', '我的客户资料', 'A01', '17', '001003', 'index.php?r=khgl/GetWdkhzlHtml');
INSERT INTO `menu` VALUES ('A01004', '下属客户资料', 'A01', '18', '001004', 'index.php?r=khgl/GetXskhzlHtml');
INSERT INTO `menu` VALUES ('A01005', '客户跟进记录', 'A01', '19', '001005', 'index.php?r=khgl/GetKhgjjlHtml');
INSERT INTO `menu` VALUES ('A01006', '客户投诉', 'A01', '21', '001006', 'index.php?r=khgl/GetKhtsHtml');
INSERT INTO `menu` VALUES ('A01007', '客户黑名单', 'A01', '94', '001007', 'index.php?r=khgl/GetkhhmdHtml');
INSERT INTO `menu` VALUES ('A02', '订单管理', '', '2', '002000', '');
INSERT INTO `menu` VALUES ('A02002', '客户订单', 'A02', '23', '002001', 'index.php?r=ddgl/GetKhddHtml');
INSERT INTO `menu` VALUES ('A02003', '订单审核', 'A02', '24', '002002', 'index.php?r=ddgl/GetDdshHtml');
INSERT INTO `menu` VALUES ('A03', '物流管理', '', '3', '003000', '');
INSERT INTO `menu` VALUES ('A03001', '物流发货', 'A03', '25', '003001', 'index.php?r=wlgl/GetWlfhHtml');
INSERT INTO `menu` VALUES ('A03002', '产品入库', 'A03', '26', '003002', 'index.php?r=wlgl/GetCprkHtml');
INSERT INTO `menu` VALUES ('A03003', '库存明细', 'A03', '27', '003003', 'index.php?r=wlgl/GetKcmxHtml');
INSERT INTO `menu` VALUES ('A03004', '销售退货', 'A03', '28', '003004', 'index.php?r=wlgl/GetCpthrcHtml');
INSERT INTO `menu` VALUES ('A03005', '打印条形码', 'A03', '29', '003006', 'index.php?r=wlgl/GetDytxmHtml');
INSERT INTO `menu` VALUES ('A03006', '库存异动明细', 'A03', '30', '003007', 'index.php?r=wlgl/GetKcydmxlHtml');
INSERT INTO `menu` VALUES ('A03007', '退货供应商记录', 'A03', '31', '003009', 'index.php?r=wlgl/GetThgysxqHtml');
INSERT INTO `menu` VALUES ('A03008', '库存盘点', 'A03', '32', '003011', 'index.php?r=wlgl/GetScpddhHtml');
INSERT INTO `menu` VALUES ('A03009', '库存盘点记录', 'A03', '33', '003012', 'index.php?r=wlgl/GetKcpdjlHtml');
INSERT INTO `menu` VALUES ('A03010', '导入订单处理', 'A03', '34', '003013', 'index.php?r=wlgl/GetDrddclHtml');
INSERT INTO `menu` VALUES ('A03011', '退货订单记录', 'A03', '35', '003005', 'index.php?r=wlgl/GetThrcHtml');
INSERT INTO `menu` VALUES ('A03012', '退货供应商', 'A03', '117', '003008', 'index.php?r=wlgl/GetThgysHtml');
INSERT INTO `menu` VALUES ('A03013', '仓库报废', 'A03', '118', '003010', 'index.php?r=wlgl/GetCkbfHtml');
INSERT INTO `menu` VALUES ('A04', '采购管理', '', '4', '004000', '');
INSERT INTO `menu` VALUES ('A04001', '采购单列表', 'A04', '36', '004001', 'index.php?r=cggl/GetCgdlbHtml');
INSERT INTO `menu` VALUES ('A04002', '下采购单', 'A04', '37', '004002', 'index.php?r=cggl/GetXcgdHtml');
INSERT INTO `menu` VALUES ('A04003', '供应商列表', 'A04', '38', '004003', 'index.php?r=cggl/GetGyslbHtml');
INSERT INTO `menu` VALUES ('A04004', '供应商统计报表', 'A04', '39', '004004', 'index.php?r=cggl/GetGystjbbHtml');
INSERT INTO `menu` VALUES ('A05', '财务管理', '', '5', '005000', '');
INSERT INTO `menu` VALUES ('A05002', '财务审核', 'A05', '41', '005002', 'index.php?r=cwgl/GetCwshHtml');
INSERT INTO `menu` VALUES ('A05003', '出货订单', 'A05', '42', '005003', 'index.php?r=cwgl/GetChddHtml');
INSERT INTO `menu` VALUES ('A05004', '款号出货汇总', 'A05', '43', '005004', 'index.php?r=cwgl/GetKhchhzHtml');
INSERT INTO `menu` VALUES ('A05006', '供应商往来明细', 'A05', '45', '005006', 'index.php?r=cwgl/GetGyswlmxHtml');
INSERT INTO `menu` VALUES ('A05007', '赠品统计报表', 'A05', '46', '005007', 'index.php?r=cwgl/GetZptjbbHtml');
INSERT INTO `menu` VALUES ('A05008', '退换货订单', 'A05', '47', '005008', 'index.php?r=cwgl/GetThhddHtml');
INSERT INTO `menu` VALUES ('A05009', '款号进销存报表', 'A05', '48', '005009', 'index.php?r=cwgl/GetMyjxcHtml');
INSERT INTO `menu` VALUES ('A05010', '供应商进销存报表', 'A05', '49', '005010', 'index.php?r=cwgl/GetMygysjxcHtml');
INSERT INTO `menu` VALUES ('A05011', '每月盘点报表', 'A05', '50', '005011', 'index.php?r=cwgl/GetMypdbbHtml');
INSERT INTO `menu` VALUES ('A06', '分类报表', '', '6', '006000', '');
INSERT INTO `menu` VALUES ('A06001', '员工业绩统计报表', 'A06', '51', '006001', 'index.php?r=flbb/GetYgyjtjbbHtml');
INSERT INTO `menu` VALUES ('A06002', '销售分组统计报表', 'A06', '52', '006002', 'index.php?r=flbb/GetFztjbbHtml');
INSERT INTO `menu` VALUES ('A06003', '意向统计报表', 'A06', '53', '006003', 'index.php?r=flbb/GetYxtjbbHtml');
INSERT INTO `menu` VALUES ('A06004', '进线时段分析报表', 'A06', '54', '006004', 'index.php?r=flbb/GetJxsdfxbbHtml');
INSERT INTO `menu` VALUES ('A06005', '订单追踪统计', 'A06', '55', '006005', 'index.php?r=flbb/GetDdzztjHtml');
INSERT INTO `menu` VALUES ('A06006', '地域统计报表', 'A06', '56', '006006', 'index.php?r=flbb/GetDytjbbHtml');
INSERT INTO `menu` VALUES ('A06007', '进线方式统计报表', 'A06', '57', '006007', 'index.php?r=flbb/GetJxfstjbbHtml');
INSERT INTO `menu` VALUES ('A06008', '投诉统计报表', 'A06', '58', '006008', 'index.php?r=flbb/GetTstjbbHtml');
INSERT INTO `menu` VALUES ('A06009', '每日出库报表', 'A06', '59', '006009', 'index.php?r=flbb/GetMrckbbHtml');
INSERT INTO `menu` VALUES ('A06010', '快递拒收统计', 'A06', '60', '006010', 'index.php?r=flbb/GetKdjstjHtml');
INSERT INTO `menu` VALUES ('A06011', '产品销售统计', 'A06', '61', '006011', 'index.php?r=flbb/GetCpxstjHtml');
INSERT INTO `menu` VALUES ('A06012', '退货原因统计', 'A06', '62', '006012', 'index.php?r=flbb/GetThyytjHtml');
INSERT INTO `menu` VALUES ('A06013', '退货产品统计', 'A06', '63', '006013', 'index.php?r=flbb/GetThcptjHtml');
INSERT INTO `menu` VALUES ('A06014', '产品类别统计报表', 'A06', '64', '006014', 'index.php?r=flbb/GetCplbtjbbHtml');
INSERT INTO `menu` VALUES ('A06015', '接线有效率报表', 'A06', '65', '006015', 'index.php?r=flbb/GetJxyxlbbHtml');
INSERT INTO `menu` VALUES ('A06016', '接线业绩报表', 'A06', '66', '006016', 'index.php?r=flbb/GetJxyjbbHtml');
INSERT INTO `menu` VALUES ('A06017', '员工考核报表', 'A06', '67', '006017', 'index.php?r=flbb/GetYgkhtjbbHtml');
INSERT INTO `menu` VALUES ('A06018', '工号客户数统计报表', 'A06', '68', '006018', 'index.php?r=flbb/GetGhkhstjbbHtml');
INSERT INTO `menu` VALUES ('A07', '产品管理', '', '7', '007000', '');
INSERT INTO `menu` VALUES ('A07001', '添加新产品', 'A07', '69', '007001', 'index.php?r=cpgl/GetTjxcpHtml');
INSERT INTO `menu` VALUES ('A07002', '产品列表', 'A07', '70', '007002', 'index.php?r=cpgl/GetCplbHtml');
INSERT INTO `menu` VALUES ('A07003', '产品分类', 'A07', '71', '007003', 'index.php?r=cpgl/GetCpflHtml');
INSERT INTO `menu` VALUES ('A07004', '产品品牌', 'A07', '72', '007004', 'index.php?r=cpgl/GetCpppHtml');
INSERT INTO `menu` VALUES ('A07005', '产品属性', 'A07', '73', '007005', 'index.php?r=cpgl/GetCpsxHtml');
INSERT INTO `menu` VALUES ('A07006', '批量修改', 'A07', '74', '007006', 'index.php?r=cpgl/GetPlxgHtml');
INSERT INTO `menu` VALUES ('A07007', '批量上传', 'A07', '75', '007007', 'index.php?r=cpgl/GetPlscHtml');
INSERT INTO `menu` VALUES ('A08', '通话管理', '', '8', '008000', '');
INSERT INTO `menu` VALUES ('A08001', '全部通话记录', 'A08', '76', '008001', 'index.php?r=thgl/GetQbthjlHtml');
INSERT INTO `menu` VALUES ('A08002', '分机通话统计报表', 'A08', '77', '008002', 'index.php?r=thgl/GetFjthtjbbHtml');
INSERT INTO `menu` VALUES ('A08003', '呼损分析报表', 'A08', '78', '008003', 'index.php?r=thgl/GetHsfxbbHtml');
INSERT INTO `menu` VALUES ('A09', '媒体管理', '', '9', '009000', '');
INSERT INTO `menu` VALUES ('A09001', '媒体渠道管理', 'A09', '79', '009001', 'index.php?r=mtgl/GetMtqdglHtml');
INSERT INTO `menu` VALUES ('A09002', '关键字分析报表', 'A09', '80', '009002', 'index.php?r=mtgl/GetGjzfxbbHtml');
INSERT INTO `menu` VALUES ('A09003', '广告效果分析报表', 'A09', '81', '009003', 'index.php?r=mtgl/GetGgxgfxbbHtml');
INSERT INTO `menu` VALUES ('A09004', '广告投放计划', 'A09', '82', '009004', 'index.php?r=mtgl/GetGgtfjhHtml');
INSERT INTO `menu` VALUES ('A10', '知识库', '', '10', '010000', '');
INSERT INTO `menu` VALUES ('A10001', '知识列表', 'A10', '83', '010001', 'index.php?r=zsk/GetZslbHtml');
INSERT INTO `menu` VALUES ('A10002', '知识分类', 'A10', '84', '010002', 'index.php?r=zsk/GetZsflHtml');
INSERT INTO `menu` VALUES ('A11', '系统设置', '', '11', '011000', '');
INSERT INTO `menu` VALUES ('A11001', '员工考核', 'A11', '85', '011001', 'index.php?r=xtsz/GetYgkhHtml');
INSERT INTO `menu` VALUES ('A11002', '权限角色', 'A11', '86', '011002', 'index.php?r=xtsz/GetQxjsHtml');
INSERT INTO `menu` VALUES ('A11003', '工号管理', 'A11', '87', '011003', 'index.php?r=xtsz/GetGhglHtml');
INSERT INTO `menu` VALUES ('A11004', '修改密码', 'A11', '88', '011004', 'index.php?r=xtsz/GetXgmmHtml');
INSERT INTO `menu` VALUES ('A11005', '客户资料导入', 'A11', '89', '011005', 'index.php?r=xtsz/GetKhzldrHtml');
INSERT INTO `menu` VALUES ('A11006', '选项设置', 'A11', '90', '011006', 'index.php?r=xtsz/GetKdgsHtml');
INSERT INTO `menu` VALUES ('A11007', '发布公告', 'A11', '91', '011007', 'index.php?r=xtsz/GetFbggHtml');
INSERT INTO `menu` VALUES ('A11008', '数据清理', 'A11', '92', '011008', 'index.php?r=xtsz/GetSjqlHtml');
INSERT INTO `menu` VALUES ('A11009', '操作记录', 'A11', '93', '011009', 'index.php?r=xtsz/GetCzjlHtml');
INSERT INTO `menu` VALUES ('A11010', '部门管理', 'A11', '95', '011010', 'index.php?r=xtsz/GetBmglHtml');
INSERT INTO `menu` VALUES ('A11011', '公司信息', 'A11', '96', '011011', 'index.php?r=xtsz/GetGsxxHtml');
INSERT INTO `menu` VALUES ('A11012', '库位管理', 'A11', '103', '011012', 'index.php?r=xtsz/GetKwglHtml');
INSERT INTO `menu` VALUES ('A11013', '数据备份与还原', 'A11', '116', '011013', 'index.php?r=xtsz/GetSjbfyhyHtml');
INSERT INTO `menu` VALUES ('A12', '话务管理', '', '12', '012000', '');
INSERT INTO `menu` VALUES ('A12001', '座席状态', 'A12', '108', '012001', 'index.php?r=hwgl/GetZxztHtml');
INSERT INTO `menu` VALUES ('A12002', '队列状态', 'A12', '104', '012002', 'index.php?r=hwgl/GetDlztHtml');
INSERT INTO `menu` VALUES ('A12003', '队列监控', 'A12', '105', '012003', 'index.php?r=hwgl/GetDljkHtml');
INSERT INTO `menu` VALUES ('A12004', '今日动态', 'A12', '106', '012004', 'index.php?r=hwgl/GetJrdtHtml');
INSERT INTO `menu` VALUES ('A12005', '强制注销', 'A12', '107', '012005', 'index.php?r=hwgl/GetQzzxHtml');
INSERT INTO `menu` VALUES ('A13', '外呼管理', '', '13', '013000', '');
INSERT INTO `menu` VALUES ('A13001', '任务列表', 'A13', '109', '013001', 'index.php?r=whgl/GetRwlbHtml');
INSERT INTO `menu` VALUES ('A13002', '回访任务', 'A13', '110', '013002', 'index.php?r=whgl/GetHfrwHtml');
INSERT INTO `menu` VALUES ('A13003', '我的任务', 'A13', '111', '013003', 'index.php?r=whgl/GetWdrwHtml');
INSERT INTO `menu` VALUES ('A13004', '问卷列表', 'A13', '112', '013004', 'index.php?r=whgl/GetWjlbHtml');
INSERT INTO `menu` VALUES ('A13005', '外呼报表', 'A13', '113', '013005', 'index.php?r=whgl/GetWhbbHtml');
INSERT INTO `menu` VALUES ('A14', '短信平台', '', '14', '014000', '');
INSERT INTO `menu` VALUES ('A14001', '内部短信', 'A14', '114', '014001', 'index.php?r=dxgl/GetFsnbdxHtml');
INSERT INTO `menu` VALUES ('A14002', '外部短信', 'A14', '115', '014002', 'index.php?r=dxgl/GetFswbdxHtml');

-- ----------------------------
-- Table structure for pdaa
-- ----------------------------
DROP TABLE IF EXISTS `pdaa`;
CREATE TABLE `pdaa` (
  `pdaa01` varchar(50) NOT NULL COMMENT '盘点单号',
  `pdaa02` varchar(30) DEFAULT '' COMMENT '盘点人',
  `pdaa03` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '盘点日期',
  `pdaa04` varchar(10) DEFAULT '' COMMENT '盘点状态[盘点入库后,改为盘点完结]',
  PRIMARY KEY (`pdaa01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pdaa
-- ----------------------------
INSERT INTO `pdaa` VALUES ('PD15120001', '', '1900-01-01 00:00:00', '盘点作废');
INSERT INTO `pdaa` VALUES ('PD15120002', '', '1900-01-01 00:00:00', '盘点完结');
INSERT INTO `pdaa` VALUES ('PD15120003', '', '1900-01-01 00:00:00', '盘点作废');
INSERT INTO `pdaa` VALUES ('PD15120004', '', '1900-01-01 00:00:00', '盘点完结');
INSERT INTO `pdaa` VALUES ('PD15120005', '', '1900-01-01 00:00:00', '盘点完结');
INSERT INTO `pdaa` VALUES ('PD15120006', 'aaa', '2015-12-01 17:00:06', '盘点完结');
INSERT INTO `pdaa` VALUES ('PD15120007', 'bbb', '2015-12-03 12:31:52', '盘点完结');
INSERT INTO `pdaa` VALUES ('PD15120008', 'admin', '2016-03-03 10:20:43', '盘点完结');
INSERT INTO `pdaa` VALUES ('PD16030001', 'admin', '2016-03-03 10:21:49', '盘点完结');

-- ----------------------------
-- Table structure for pdab
-- ----------------------------
DROP TABLE IF EXISTS `pdab`;
CREATE TABLE `pdab` (
  `pdab01` varchar(50) DEFAULT '' COMMENT '盘点单号',
  `pdab02` varchar(30) DEFAULT '' COMMENT '批次',
  `pdab03` int(11) DEFAULT '0' COMMENT '商品款号',
  `pdab04` varchar(50) DEFAULT '' COMMENT '规格',
  `pdab05` decimal(10,2) DEFAULT '0.00' COMMENT '正品库存量',
  `pdab06` decimal(10,2) DEFAULT '0.00' COMMENT '次品库存量',
  `pdab07` varchar(10) DEFAULT '' COMMENT '单位',
  `pdab08` decimal(10,2) DEFAULT '0.00' COMMENT '盘点量',
  `pdab09` varchar(20) DEFAULT '' COMMENT '仓库',
  `pdab10` varchar(20) DEFAULT '' COMMENT '仓位',
  `pdab11` varchar(30) DEFAULT '' COMMENT '商品名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pdab
-- ----------------------------
INSERT INTO `pdab` VALUES ('PD15120001', '1511260001', '7', '', '30.00', '0.00', '', '0.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120002', '1511260001', '7', '', '30.00', '0.00', '', '0.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120003', '1511260001', '7', '', '30.00', '0.00', '', '0.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120004', '1511260001', '4', '', '40.00', '0.00', '', '0.00', '', '44444', 'aaa');
INSERT INTO `pdab` VALUES ('PD15120005', '1511260001', '9', '', '7.00', '0.00', '', '0.00', '', '99999', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120005', '1511260001', '8', '', '18.00', '0.00', '', '0.00', '', '88888', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120005', '1511260001', '7', '', '30.00', '0.00', '', '0.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120005', '1511260001', '4', '', '40.00', '0.00', '', '0.00', '', '44444', 'aaa');
INSERT INTO `pdab` VALUES ('PD15120005', '1511180002', '7', '', '10.00', '0.00', '', '0.00', '', '', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120006', '1511260001', '9', '', '7.00', '0.00', '', '0.00', '', '99999', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120007', '1511260001', '9', '', '7.00', '0.00', '', '0.00', '', '99999', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120007', '1511260001', '8', '', '18.00', '0.00', '', '222.00', '', '88888', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120007', '1511260001', '7', '', '30.00', '0.00', '', '111.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120007', '1511260001', '4', '', '40.00', '0.00', '', '21.00', '', '44444', 'aaa');
INSERT INTO `pdab` VALUES ('PD15120007', '1511180002', '7', '', '10.00', '0.00', '', '222.00', '', '', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120007', '1511180002', '4', '', '22.00', '0.00', '', '0.00', '', '', 'aaa');
INSERT INTO `pdab` VALUES ('PD15120007', '1511180001', '7', '', '3.00', '0.00', '', '3.00', '', '', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1512160001', '12', '', '288.00', '0.00', '', '0.00', '', '', 'dadas12321');
INSERT INTO `pdab` VALUES ('PD15120008', '1512160001', '10', '', '100.00', '0.00', '', '0.00', '', '', 'aaaa');
INSERT INTO `pdab` VALUES ('PD15120008', '1512150001', '11', '', '1112.00', '0.00', '', '0.00', '', '2323', 'aaa');
INSERT INTO `pdab` VALUES ('PD15120008', '1512030002', '8', '', '204.00', '0.00', '', '0.00', '', '88888', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1512030002', '7', '', '81.00', '0.00', '', '0.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1512030001', '8', '', '204.00', '0.00', '', '0.00', '', '88888', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1512030001', '7', '', '81.00', '0.00', '', '0.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1511260001', '9', '', '135.00', '0.00', '', '0.00', '', '99999', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1511260001', '8', '', '226.00', '0.00', '', '0.00', '', '88888', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1511260001', '7', '', '111.00', '0.00', '', '0.00', '', '77777', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1511260001', '4', '', '22.00', '0.00', '', '0.00', '', '44444', 'aaa');
INSERT INTO `pdab` VALUES ('PD15120008', '1511180002', '7', '', '222.00', '0.00', '', '0.00', '', '', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD15120008', '1511180001', '7', '', '2.00', '0.00', '', '0.00', '', '', 'bbbbb');
INSERT INTO `pdab` VALUES ('PD16030001', '1603020004', '15', '500g/盒', '22.00', '0.00', '', '0.00', '', '1001', '药测试');
INSERT INTO `pdab` VALUES ('PD16030001', '1603020004', '14', '', '11.00', '0.00', '', '0.00', '', '123', '衣服1号！123');
INSERT INTO `pdab` VALUES ('PD16030001', '1603020003', '16', '100g/盒', '11.00', '0.00', '', '0.00', '', '1001', '测试1123');
INSERT INTO `pdab` VALUES ('PD16030001', '1603020002', '26', '瓶', '1312.00', '0.00', '', '0.00', '', '1001', '玛莎玻尿酸原液250ml');
INSERT INTO `pdab` VALUES ('PD16030001', '1603020002', '25', '瓶', '1111.00', '0.00', '', '0.00', '', '123', '碧生源减肥茶2012');
INSERT INTO `pdab` VALUES ('PD16030001', '1601250011', '15', '500g/盒', '1.00', '0.00', '', '0.00', '', '1001', '药测试');
INSERT INTO `pdab` VALUES ('PD16030001', '1601250011', '10', '', '222.00', '0.00', '', '0.00', '', '123', 'aaaa');
INSERT INTO `pdab` VALUES ('PD16030001', '1601250009', '15', '500g/盒', '1.00', '0.00', '', '0.00', '', '1001', '药测试');
INSERT INTO `pdab` VALUES ('PD16030001', '1601250009', '10', '', '9.00', '0.00', '', '0.00', '', '123', 'aaaa');
INSERT INTO `pdab` VALUES ('PD16030001', '1601250008', '15', '500g/盒', '1.00', '0.00', '', '0.00', '', '1001', '药测试');

-- ----------------------------
-- Table structure for rightset
-- ----------------------------
DROP TABLE IF EXISTS `rightset`;
CREATE TABLE `rightset` (
  `rightID` int(11) NOT NULL AUTO_INCREMENT COMMENT ' 权限id',
  `righttext` varchar(50) DEFAULT '' COMMENT '权限名称',
  `rightparent` varchar(30) DEFAULT '' COMMENT '所在权限组编号',
  `systemid` varchar(30) DEFAULT '' COMMENT '系统id',
  PRIMARY KEY (`rightID`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rightset
-- ----------------------------
INSERT INTO `rightset` VALUES ('1', '客户管理', '0', '');
INSERT INTO `rightset` VALUES ('2', '订单管理', '0', '');
INSERT INTO `rightset` VALUES ('3', '物流管理', '0', '');
INSERT INTO `rightset` VALUES ('4', '采购管理', '0', '');
INSERT INTO `rightset` VALUES ('5', '财务管理', '0', '');
INSERT INTO `rightset` VALUES ('6', '分类报表', '0', '');
INSERT INTO `rightset` VALUES ('7', '产品管理', '0', '');
INSERT INTO `rightset` VALUES ('8', '通话管理', '0', '');
INSERT INTO `rightset` VALUES ('9', '媒体管理', '0', '');
INSERT INTO `rightset` VALUES ('10', '知识库', '0', '');
INSERT INTO `rightset` VALUES ('11', '系统设置', '0', '');
INSERT INTO `rightset` VALUES ('12', '话务管理', '0', '');
INSERT INTO `rightset` VALUES ('13', '外呼管理', '0', '');
INSERT INTO `rightset` VALUES ('14', '短信平台', '0', '');
INSERT INTO `rightset` VALUES ('15', '添加客户资料', '1', '');
INSERT INTO `rightset` VALUES ('16', '查询客户资料', '1', '');
INSERT INTO `rightset` VALUES ('17', '我的客户资料', '1', '');
INSERT INTO `rightset` VALUES ('18', '下属客户资料', '1', '');
INSERT INTO `rightset` VALUES ('19', '客户跟进记录', '1', '');
INSERT INTO `rightset` VALUES ('21', '客户投诉', '1', '');
INSERT INTO `rightset` VALUES ('23', '客户订单', '2', '');
INSERT INTO `rightset` VALUES ('24', '订单审核', '2', '');
INSERT INTO `rightset` VALUES ('25', '物流发货', '3', '');
INSERT INTO `rightset` VALUES ('26', '产品入库', '3', '');
INSERT INTO `rightset` VALUES ('27', '库存明细', '3', '');
INSERT INTO `rightset` VALUES ('28', '销售退货', '3', '');
INSERT INTO `rightset` VALUES ('29', '打印条形码', '3', '');
INSERT INTO `rightset` VALUES ('30', '入库记录', '3', '');
INSERT INTO `rightset` VALUES ('31', '退货供应商记录', '3', '');
INSERT INTO `rightset` VALUES ('32', '库存盘点', '3', '');
INSERT INTO `rightset` VALUES ('33', '库存盘点记录', '3', '');
INSERT INTO `rightset` VALUES ('34', '导入订单处理', '3', '');
INSERT INTO `rightset` VALUES ('35', '调仓记录', '3', '');
INSERT INTO `rightset` VALUES ('36', '采购单列表', '4', '');
INSERT INTO `rightset` VALUES ('37', '下采购单', '4', '');
INSERT INTO `rightset` VALUES ('38', '供应商列表', '4', '');
INSERT INTO `rightset` VALUES ('39', '供应商统计报表', '4', '');
INSERT INTO `rightset` VALUES ('40', 'K币操作', '5', '');
INSERT INTO `rightset` VALUES ('41', '财务审核', '5', '');
INSERT INTO `rightset` VALUES ('42', '出货订单', '5', '');
INSERT INTO `rightset` VALUES ('43', '款号出货汇总', '5', '');
INSERT INTO `rightset` VALUES ('44', 'K币明细记录', '5', '');
INSERT INTO `rightset` VALUES ('45', '供应商往来明细', '5', '');
INSERT INTO `rightset` VALUES ('46', '赠品统计报表', '5', '');
INSERT INTO `rightset` VALUES ('47', '退换货订单', '5', '');
INSERT INTO `rightset` VALUES ('48', '款号进销存报表', '5', '');
INSERT INTO `rightset` VALUES ('49', '供应商进销存报表', '5', '');
INSERT INTO `rightset` VALUES ('50', '每月盘点报表', '5', '');
INSERT INTO `rightset` VALUES ('51', '员工业绩统计报表', '6', '');
INSERT INTO `rightset` VALUES ('52', '销售分组统计报表', '6', '');
INSERT INTO `rightset` VALUES ('53', '意向统计报表', '6', '');
INSERT INTO `rightset` VALUES ('54', '进线时段分析报表', '6', '');
INSERT INTO `rightset` VALUES ('55', '订单追踪统计', '6', '');
INSERT INTO `rightset` VALUES ('56', '地域统计报表', '6', '');
INSERT INTO `rightset` VALUES ('57', '进线方式统计报表', '6', '');
INSERT INTO `rightset` VALUES ('58', '投诉统计报表', '6', '');
INSERT INTO `rightset` VALUES ('59', '每日出库报表', '6', '');
INSERT INTO `rightset` VALUES ('60', '快递拒收统计', '6', '');
INSERT INTO `rightset` VALUES ('61', '产品销售统计', '6', '');
INSERT INTO `rightset` VALUES ('62', '退货原因统计', '6', '');
INSERT INTO `rightset` VALUES ('63', '退货产品统计', '6', '');
INSERT INTO `rightset` VALUES ('64', '产品类别统计报表', '6', '');
INSERT INTO `rightset` VALUES ('65', '接线有效率报表', '6', '');
INSERT INTO `rightset` VALUES ('66', '接线业绩报表', '6', '');
INSERT INTO `rightset` VALUES ('67', '员工考核报表', '6', '');
INSERT INTO `rightset` VALUES ('68', '工号客户数统计报表', '6', '');
INSERT INTO `rightset` VALUES ('69', '添加新产品', '7', '');
INSERT INTO `rightset` VALUES ('70', '产品列表', '7', '');
INSERT INTO `rightset` VALUES ('71', '产品分类', '7', '');
INSERT INTO `rightset` VALUES ('72', '产品品牌', '7', '');
INSERT INTO `rightset` VALUES ('73', '产品属性', '7', '');
INSERT INTO `rightset` VALUES ('74', '批量修改', '7', '');
INSERT INTO `rightset` VALUES ('75', '批量上传', '7', '');
INSERT INTO `rightset` VALUES ('76', '全部通话记录', '8', '');
INSERT INTO `rightset` VALUES ('77', '分级通话统计报表', '8', '');
INSERT INTO `rightset` VALUES ('78', '呼损分析报表', '8', '');
INSERT INTO `rightset` VALUES ('79', '媒体渠道管理', '9', '');
INSERT INTO `rightset` VALUES ('80', '关键字分析报表', '9', '');
INSERT INTO `rightset` VALUES ('81', '广告效果分析报表', '9', '');
INSERT INTO `rightset` VALUES ('82', '广告投放计划', '9', '');
INSERT INTO `rightset` VALUES ('83', '知识列表', '10', '');
INSERT INTO `rightset` VALUES ('84', '知识分类', '10', '');
INSERT INTO `rightset` VALUES ('85', '员工考核', '11', '');
INSERT INTO `rightset` VALUES ('86', '权限角色', '11', '');
INSERT INTO `rightset` VALUES ('87', '工号管理', '11', '');
INSERT INTO `rightset` VALUES ('88', '修改密码', '11', '');
INSERT INTO `rightset` VALUES ('89', '客户资料导入', '11', '');
INSERT INTO `rightset` VALUES ('90', '选项设置', '11', '');
INSERT INTO `rightset` VALUES ('91', '发布公告', '11', '');
INSERT INTO `rightset` VALUES ('92', '数据清理', '11', '');
INSERT INTO `rightset` VALUES ('93', '操作记录', '11', '');
INSERT INTO `rightset` VALUES ('94', '客户黑名单', '1', '');
INSERT INTO `rightset` VALUES ('95', '部门管理', '11', '');
INSERT INTO `rightset` VALUES ('96', '公司信息', '11', '');
INSERT INTO `rightset` VALUES ('97', '话务明细表', '6', '');
INSERT INTO `rightset` VALUES ('98', '考勤报表', '6', '');
INSERT INTO `rightset` VALUES ('99', '话务量报表', '6', '');
INSERT INTO `rightset` VALUES ('100', '队列报表', '6', '');
INSERT INTO `rightset` VALUES ('101', '质检报表', '6', '');
INSERT INTO `rightset` VALUES ('102', '通话报表', '6', '');
INSERT INTO `rightset` VALUES ('103', '库位管理', '11', '');
INSERT INTO `rightset` VALUES ('104', '队列状态', '12', '');
INSERT INTO `rightset` VALUES ('105', '队列监控', '12', '');
INSERT INTO `rightset` VALUES ('106', '今日动态', '12', '');
INSERT INTO `rightset` VALUES ('107', '强制注销', '12', '');
INSERT INTO `rightset` VALUES ('108', '坐席状态', '12', '');
INSERT INTO `rightset` VALUES ('109', '任务列表', '13', '');
INSERT INTO `rightset` VALUES ('110', '回访任务', '13', '');
INSERT INTO `rightset` VALUES ('111', '我的任务', '13', '');
INSERT INTO `rightset` VALUES ('112', '问卷列表', '13', '');
INSERT INTO `rightset` VALUES ('113', '外呼报表', '13', '');
INSERT INTO `rightset` VALUES ('114', '内部短信', '14', '');
INSERT INTO `rightset` VALUES ('115', '外部短信', '14', '');
INSERT INTO `rightset` VALUES ('116', '数据备份与还原', '11', '');
INSERT INTO `rightset` VALUES ('117', '退货供应商', '3', '');
INSERT INTO `rightset` VALUES ('118', '仓库报废', '3', '');

-- ----------------------------
-- Table structure for rylist
-- ----------------------------
DROP TABLE IF EXISTS `rylist`;
CREATE TABLE `rylist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` varchar(30) DEFAULT '' COMMENT '登录账号',
  `pwd` varchar(50) DEFAULT '' COMMENT '登录密码',
  `personname` varchar(30) DEFAULT '' COMMENT '登录姓名',
  `loginIp` varchar(20) DEFAULT '127.0.0.1' COMMENT '登录IP',
  `post` varchar(50) DEFAULT '' COMMENT '岗位',
  `postID` varchar(200) DEFAULT '' COMMENT '角色编号',
  `department` varchar(100) DEFAULT '' COMMENT '所属部门',
  `company` varchar(300) DEFAULT '' COMMENT '所属公司',
  `operatePower` varchar(30) DEFAULT '' COMMENT '操作权限',
  `managerPower` varchar(500) DEFAULT '' COMMENT '管理权限',
  `loginTime` datetime DEFAULT '2015-01-01 23:59:59' COMMENT '登录时间',
  `zctime` datetime DEFAULT NULL COMMENT '注册时间',
  `limitIp` varchar(20) DEFAULT '' COMMENT '限定ip',
  `limitMAC` varchar(50) DEFAULT '' COMMENT '限定MAC',
  `isonline` varchar(1) DEFAULT 'F' COMMENT '是否在线(T为在线,F为离线,默认为F)',
  `enabled` varchar(1) DEFAULT 'T' COMMENT '是否启用(T为启用,F为禁用,默认为T)',
  `fenji` varchar(10) DEFAULT '' COMMENT '分机号码',
  `phone` varchar(20) DEFAULT '' COMMENT '座机号码',
  `telephone` varchar(11) DEFAULT '' COMMENT '手机号码',
  `opetime` datetime DEFAULT '1991-01-01 23:59:59' COMMENT '最后操作时间',
  `higherlevel` int(10) DEFAULT NULL COMMENT '直属上级编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rylist
-- ----------------------------
INSERT INTO `rylist` VALUES ('9', 'admin', '21232f297a57a5a743894a0e4a801fc3', '管理员', '127.0.0.1', 'gr15110010', 'gr15110010', '1', 'gr15110010', '', '123', '2016-04-01 18:11:38', null, '蛤', '和', 'F', 'T', '8041', '', '', '2016-04-01 18:11:38', null);
INSERT INTO `rylist` VALUES ('24', 'wac', '96e79218965eb72c92a549dd5a330112', 'w产品专员', '127.0.0.1', 'gr15120013', '', '1', 'gr15120013', '', '', '2015-01-01 23:59:59', null, '', '', 'F', 'T', '', '', '', '1991-01-01 23:59:59', null);
INSERT INTO `rylist` VALUES ('25', 'wad', '96e79218965eb72c92a549dd5a330112', 'w物流人员', '127.0.0.1', 'gr15120014', '', '3', 'gr15120014', '', '', '2015-01-01 23:59:59', null, '', '', 'F', 'T', '', '', '', '1991-01-01 23:59:59', null);
INSERT INTO `rylist` VALUES ('26', 'wae', '96e79218965eb72c92a549dd5a330112', 'w财务人员', '127.0.0.1', 'gr15120015', '', '6', 'gr15120015', '', '', '2015-01-01 23:59:59', null, '', '', 'F', 'T', '', '', '', '1991-01-01 23:59:59', null);
INSERT INTO `rylist` VALUES ('27', 'waf', '96e79218965eb72c92a549dd5a330112', 'w采购员', '127.0.0.1', 'gr15120016', '', '6', 'gr15120016', '', '', '2015-01-01 23:59:59', null, '', '', 'F', 'T', '', '', '', '1991-01-01 23:59:59', null);
INSERT INTO `rylist` VALUES ('36', '0218', '670b14728ad9902aecba32e22fa4f6bd', 'huyan', '127.0.0.1', '超级管理员', 'gr15110010', '管理员', 'gr15110010', '', '', '2016-02-26 11:51:43', null, '', '', 'F', 'T', '8054', '', '', '2016-02-26 11:51:43', '0');
INSERT INTO `rylist` VALUES ('37', '0000', 'e10adc3949ba59abbe56e057f20f883e', '一线组长', '127.0.0.1', '一线组长', 'gr15110010', '事业一部', 'gr15110010', '', '', '2016-02-23 16:25:58', '2016-02-22 14:20:21', '', '', 'F', 'T', '', '', '', '2016-02-22 14:51:57', '24');
INSERT INTO `rylist` VALUES ('40', '1111', 'e10adc3949ba59abbe56e057f20f883e', '一线组员', '127.0.0.1', '一线组员', 'gr15120012', '事业一部', 'gr15110010', '', '', '2016-02-24 16:27:26', '2016-02-22 14:38:20', '', '', 'F', 'T', '', '', '', '2016-02-23 15:05:36', '37');
INSERT INTO `rylist` VALUES ('41', '2222', 'e10adc3949ba59abbe56e057f20f883e', '一线组员2', '127.0.0.1', '一线组员', 'gr15120012', '事业一部', 'gr15110010', '', '', '2015-01-01 23:59:59', '2016-02-22 14:39:13', '', '', 'F', 'T', '', '', '', '2016-02-23 15:08:23', '37');

-- ----------------------------
-- Table structure for sy400dhset
-- ----------------------------
DROP TABLE IF EXISTS `sy400dhset`;
CREATE TABLE `sy400dhset` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '400电话ID',
  `orphone` varchar(30) DEFAULT '' COMMENT '400电话',
  `realphone` varchar(30) DEFAULT '' COMMENT '实际电话',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sy400dhset
-- ----------------------------

-- ----------------------------
-- Table structure for sycompanyset
-- ----------------------------
DROP TABLE IF EXISTS `sycompanyset`;
CREATE TABLE `sycompanyset` (
  `id` varchar(11) DEFAULT '' COMMENT '公司ID',
  `number` varchar(20) DEFAULT '' COMMENT '公司编号',
  `name` varchar(50) DEFAULT '' COMMENT '公司名称',
  `address` varchar(200) DEFAULT '' COMMENT '公司地址',
  `logo` varchar(100) DEFAULT '' COMMENT '公司标志LOGO',
  `phone` varchar(20) DEFAULT '' COMMENT '公司电话',
  `email` varchar(50) DEFAULT '' COMMENT '公司电子邮箱',
  `type` varchar(20) DEFAULT '' COMMENT '公司类型',
  `linkman` varchar(10) DEFAULT '' COMMENT '联系人',
  `summary` varchar(200) DEFAULT '' COMMENT '公司简介'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sycompanyset
-- ----------------------------
INSERT INTO `sycompanyset` VALUES ('1', 'GS001', '广州锦新通信设备有限公司', '广州市天河区龙口西路221号聚龙阁401-405', 'public/template/images/upload/2015/12/1603371688799.jpg', '020-28128056', 'gzjxtx@163.com', '0', '', '锦新汇集了一批怀有强烈使命感、社会责任感的通信行业专业人士，锦新人坚信，通过我们的智慧和坚定，一定能为企业提供最优质的通信系统智能化解决方案。锦新始终以“从心开始，成长共赢”为经营理念，锦新人不断成长的同时为客户创造价值与客户成长共赢，我们立志为引领和普及通信网络现代化而奋斗终身。');

-- ----------------------------
-- Table structure for sykdgsset
-- ----------------------------
DROP TABLE IF EXISTS `sykdgsset`;
CREATE TABLE `sykdgsset` (
  `kdgsid` int(11) NOT NULL AUTO_INCREMENT COMMENT '快递公司ID',
  `kdgstext` varchar(30) DEFAULT '' COMMENT '快递公司名称',
  `ifuse` varchar(30) DEFAULT 'T' COMMENT '是否启用',
  PRIMARY KEY (`kdgsid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sykdgsset
-- ----------------------------
INSERT INTO `sykdgsset` VALUES ('5', 'EMS', 'T');
INSERT INTO `sykdgsset` VALUES ('6', '顺丰快递', 'T');
INSERT INTO `sykdgsset` VALUES ('7', '圆通快递', 'T');
INSERT INTO `sykdgsset` VALUES ('8', '天天快递', 'T');
INSERT INTO `sykdgsset` VALUES ('9', '韵达快递', 'T');
INSERT INTO `sykdgsset` VALUES ('10', '中通快递', 'T');
INSERT INTO `sykdgsset` VALUES ('11', '申通快递', 'T');

-- ----------------------------
-- Table structure for sysopeset
-- ----------------------------
DROP TABLE IF EXISTS `sysopeset`;
CREATE TABLE `sysopeset` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type` varchar(50) DEFAULT '' COMMENT '操作类型（客户，产品）',
  `thingid` varchar(10) DEFAULT '' COMMENT '操作的内容的ID，如产品ID',
  `difference` varchar(100) DEFAULT '' COMMENT '操作的内容',
  `ry` varchar(20) DEFAULT '' COMMENT '操作人信息（工号:姓名）',
  `opetime` datetime DEFAULT '1990-01-01 23:59:59' COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sysopeset
-- ----------------------------
INSERT INTO `sysopeset` VALUES ('1', '删除产品', '16', '哈哈哈', 'dscz:dengshaocong', '2015-12-02 17:34:50');
INSERT INTO `sysopeset` VALUES ('2', '删除产品', '16', '哈哈哈', 'dscz:dengshaocong', '2015-12-02 17:35:15');
INSERT INTO `sysopeset` VALUES ('3', '删除产品', '16', '哈哈哈', 'dscz:dengshaocong', '2015-12-02 17:35:51');

-- ----------------------------
-- Table structure for sysserver
-- ----------------------------
DROP TABLE IF EXISTS `sysserver`;
CREATE TABLE `sysserver` (
  `refSigns` varchar(50) NOT NULL COMMENT '引用标识',
  `serverIp` varchar(300) DEFAULT '' COMMENT '服务器ip',
  `dbName` varchar(30) DEFAULT '' COMMENT '数据库名',
  `dbAccount` varchar(30) DEFAULT '' COMMENT '数据库账号',
  `dbPwd` varchar(30) DEFAULT '' COMMENT '数据库密码',
  PRIMARY KEY (`refSigns`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sysserver
-- ----------------------------

-- ----------------------------
-- Table structure for sysset
-- ----------------------------
DROP TABLE IF EXISTS `sysset`;
CREATE TABLE `sysset` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `typeencode` varchar(30) DEFAULT '' COMMENT '类型编码',
  `valuetype1` varchar(100) DEFAULT '' COMMENT '类型对应的值1',
  `valuetype2` varchar(200) DEFAULT '' COMMENT '类型对应的值2',
  `valuetype3` varchar(200) DEFAULT '' COMMENT '是否显示',
  `valuetype4` varchar(100) DEFAULT '' COMMENT '操作工号',
  `valuetype5` varchar(100) DEFAULT '' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=797 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sysset
-- ----------------------------
INSERT INTO `sysset` VALUES ('1', 'A012', 'A', '', '', '', '');
INSERT INTO `sysset` VALUES ('2', 'A012', 'B', '', '', '', '');
INSERT INTO `sysset` VALUES ('3', 'A012', 'C', '', '', '', '');
INSERT INTO `sysset` VALUES ('4', 'A012', '无效资料', '', '', '', '');
INSERT INTO `sysset` VALUES ('5', 'A012', '无人接听', '', '', '', '');
INSERT INTO `sysset` VALUES ('6', 'A012', '缺货', '', '', '', '');
INSERT INTO `sysset` VALUES ('7', 'A012', '空号', '', '', '', '');
INSERT INTO `sysset` VALUES ('8', 'A012', '成交', '', '', '', '');
INSERT INTO `sysset` VALUES ('9', 'A012', '测试', '', '', '', '');
INSERT INTO `sysset` VALUES ('10', 'A012', '区号缺0', '', '', '', '');
INSERT INTO `sysset` VALUES ('11', 'A012', '主要客户', '', '', '', '');
INSERT INTO `sysset` VALUES ('12', 'A012', '已定', '', '', '', '');
INSERT INTO `sysset` VALUES ('13', 'A012', '新发书客户', '', '', '', '');
INSERT INTO `sysset` VALUES ('14', 'A012', '电视二卖成单', '', '', '', '');
INSERT INTO `sysset` VALUES ('15', 'A012', '电台成交数据', '', '', '', '');
INSERT INTO `sysset` VALUES ('16', 'A012', '蜂胶未成交', '', '', '', '');
INSERT INTO `sysset` VALUES ('17', 'A012', '骨病成交', '', '', '', '');
INSERT INTO `sysset` VALUES ('18', 'A012', '蜂胶复购', '', '', '', '');
INSERT INTO `sysset` VALUES ('19', 'A012', '减肥未成交', '', '', '', '');
INSERT INTO `sysset` VALUES ('20', 'A012', '农机茶未成交', '', '', '', '');
INSERT INTO `sysset` VALUES ('21', 'A012', '无人接听/挂电话', '', '', '', '');
INSERT INTO `sysset` VALUES ('22', 'A012', '不承认/空号/停机', '', '', '', '');
INSERT INTO `sysset` VALUES ('23', 'A016', '骨病', '', '', '', '');
INSERT INTO `sysset` VALUES ('24', 'A016', '老人保健', '', '', '', '');
INSERT INTO `sysset` VALUES ('25', 'A016', '减肥', '', '', '', '');
INSERT INTO `sysset` VALUES ('26', 'A016', '麦片', '', '', '', '');
INSERT INTO `sysset` VALUES ('27', 'A016', '美容', '', '', '', '');
INSERT INTO `sysset` VALUES ('28', 'A016', '燕麦', 'F', '', '', '');
INSERT INTO `sysset` VALUES ('30', 'A005', '销售部', '', '', '', '');
INSERT INTO `sysset` VALUES ('31', 'A005', '销售回访一', '', '', '', '');
INSERT INTO `sysset` VALUES ('32', 'A005', '二线一组', '', '', '', '');
INSERT INTO `sysset` VALUES ('33', 'A005', '二线二组', '', '', '', '');
INSERT INTO `sysset` VALUES ('34', 'A005', '二线三组', '', '', '', '');
INSERT INTO `sysset` VALUES ('35', 'A005', '二线四组', '', '', '', '');
INSERT INTO `sysset` VALUES ('36', 'A005', '公共组', '', '', '', '');
INSERT INTO `sysset` VALUES ('37', 'A023', '首选', '', '', '', '');
INSERT INTO `sysset` VALUES ('38', 'A023', '停用', '', '', '', '');
INSERT INTO `sysset` VALUES ('39', 'A023', '本人', '', '', '', '');
INSERT INTO `sysset` VALUES ('40', 'A023', '老公', '', '', '', '');
INSERT INTO `sysset` VALUES ('41', 'A023', '老婆', '', '', '', '');
INSERT INTO `sysset` VALUES ('42', 'A023', '家人', '', '', '', '');
INSERT INTO `sysset` VALUES ('43', 'A023', '朋友', '', '', '', '');
INSERT INTO `sysset` VALUES ('44', 'A023', '其他', '', '', '', '');
INSERT INTO `sysset` VALUES ('45', 'A008', '短信', '', '', '', '');
INSERT INTO `sysset` VALUES ('46', 'A008', '电话', '', '', '', '');
INSERT INTO `sysset` VALUES ('47', 'A008', '商务通', '', '', '', '');
INSERT INTO `sysset` VALUES ('48', 'A008', 'QQMSN', '', '', '', '');
INSERT INTO `sysset` VALUES ('49', 'A008', '旺旺', '', '', '', '');
INSERT INTO `sysset` VALUES ('50', 'A008', '主动', '', '', '', '');
INSERT INTO `sysset` VALUES ('51', 'A008', '其他', '', '', '', '');
INSERT INTO `sysset` VALUES ('52', 'A013', '内蒙古卫视', '', '', '', '');
INSERT INTO `sysset` VALUES ('53', 'A013', '电台', '', '', '', '');
INSERT INTO `sysset` VALUES ('54', 'A013', '兵团卫视', '', '', '', '');
INSERT INTO `sysset` VALUES ('55', 'A015', '小学', '', '', '', '');
INSERT INTO `sysset` VALUES ('56', 'A015', '初中', '', '', '', '');
INSERT INTO `sysset` VALUES ('57', 'A015', '高中', '', '', '', '');
INSERT INTO `sysset` VALUES ('58', 'A015', '大专', '', '', '', '');
INSERT INTO `sysset` VALUES ('59', 'A015', '中专', '', '', '', '');
INSERT INTO `sysset` VALUES ('60', 'A015', '本科', '', '', '', '');
INSERT INTO `sysset` VALUES ('61', 'A015', '硕士', '', '', '', '');
INSERT INTO `sysset` VALUES ('62', 'A015', '博士以上', '', '', '', '');
INSERT INTO `sysset` VALUES ('63', 'khzy', '学生', '', '', '', '');
INSERT INTO `sysset` VALUES ('81', 'A014', '3万以下', '', '', '', '');
INSERT INTO `sysset` VALUES ('82', 'A014', '3-6万', '', '', '', '');
INSERT INTO `sysset` VALUES ('83', 'A014', '6-10万', '', '', '', '');
INSERT INTO `sysset` VALUES ('84', 'A014', '10-20万', '', '', '', '');
INSERT INTO `sysset` VALUES ('85', 'A014', '20-50万', '', '', '', '');
INSERT INTO `sysset` VALUES ('86', 'A014', '50万以上', '', '', '', '');
INSERT INTO `sysset` VALUES ('87', 'A002', '正常单', '', '', '', '');
INSERT INTO `sysset` VALUES ('88', 'A002', '换货单', '', '', '', '');
INSERT INTO `sysset` VALUES ('89', 'A002', '重发单', '', '', '', '');
INSERT INTO `sysset` VALUES ('90', 'A002', '异常单', '', '', '', '');
INSERT INTO `sysset` VALUES ('91', 'A002', '急发单', '', '', '', '');
INSERT INTO `sysset` VALUES ('92', 'A002', '其他单', '', '', '', '');
INSERT INTO `sysset` VALUES ('93', 'A011', 'EMS', '', '', '', '');
INSERT INTO `sysset` VALUES ('94', 'A011', '顺丰', '', '', '', '');
INSERT INTO `sysset` VALUES ('95', 'A011', '圆通', '', '', '', '');
INSERT INTO `sysset` VALUES ('96', 'A011', '中通', '', '', '', '');
INSERT INTO `sysset` VALUES ('97', 'A011', '申通', '', '', '', '');
INSERT INTO `sysset` VALUES ('98', 'A011', '国通', '', '', '', '');
INSERT INTO `sysset` VALUES ('99', 'A011', '韵达', '', '', '', '');
INSERT INTO `sysset` VALUES ('100', 'A011', '国通', '', '', '', '');
INSERT INTO `sysset` VALUES ('101', 'A011', '汇通', '', '', '', '');
INSERT INTO `sysset` VALUES ('102', 'A011', '天天', '', '', '', '');
INSERT INTO `sysset` VALUES ('103', 'A011', '德邦', '', '', '', '');
INSERT INTO `sysset` VALUES ('104', 'A024', '支付宝', '', '', '', '');
INSERT INTO `sysset` VALUES ('105', 'A024', '财付通', '', '', '', '');
INSERT INTO `sysset` VALUES ('106', 'A024', '现金支付', '', '', '', '');
INSERT INTO `sysset` VALUES ('107', 'A024', '货到付款', '', '', '', '');
INSERT INTO `sysset` VALUES ('108', 'A024', '银行转账', '', '', '', '');
INSERT INTO `sysset` VALUES ('109', 'A024', '免费已付', '', '', '', '');
INSERT INTO `sysset` VALUES ('110', 'A004', '无发票', '', '', '', '');
INSERT INTO `sysset` VALUES ('111', 'A004', '增值发票', '', '', '', '');
INSERT INTO `sysset` VALUES ('112', 'A004', '普通发票', '', '', '', '');
INSERT INTO `sysset` VALUES ('113', 'A003', '全部', '', '', '', '');
INSERT INTO `sysset` VALUES ('114', 'A003', '交易成功', '', '', '', '');
INSERT INTO `sysset` VALUES ('115', 'A003', '未确认', '', '', '', '');
INSERT INTO `sysset` VALUES ('116', 'A003', '等待支付', '', '', '', '');
INSERT INTO `sysset` VALUES ('117', 'A003', '已确认', '', '', '', '');
INSERT INTO `sysset` VALUES ('118', 'A003', '已支付', '', '', '', '');
INSERT INTO `sysset` VALUES ('119', 'A003', '待发货', '', '', '', '');
INSERT INTO `sysset` VALUES ('120', 'A003', '已发货', '', '', '', '');
INSERT INTO `sysset` VALUES ('121', 'A003', '拒收', '', '', '', '');
INSERT INTO `sysset` VALUES ('122', 'A003', '已作废', '', '', '', '');
INSERT INTO `sysset` VALUES ('123', 'A022', '已确认', '', '', '', '');
INSERT INTO `sysset` VALUES ('124', 'A022', '已客审', '', '', '', '');
INSERT INTO `sysset` VALUES ('125', 'A022', '已财审', '', '', '', '');
INSERT INTO `sysset` VALUES ('126', 'A020', '全未记账', '', '', '', '');
INSERT INTO `sysset` VALUES ('127', 'A020', '全已记账', '', '', '', '');
INSERT INTO `sysset` VALUES ('128', 'A020', '未记账1', '', '', '', '');
INSERT INTO `sysset` VALUES ('129', 'A020', '未记账2', '', '', '', '');
INSERT INTO `sysset` VALUES ('130', 'A020', '已记账1', '', '', '', '');
INSERT INTO `sysset` VALUES ('131', 'A020', '已记账2', '', '', '', '');
INSERT INTO `sysset` VALUES ('132', 'A001', '未打印', '', '', '', '');
INSERT INTO `sysset` VALUES ('133', 'A001', '已打印', '', '', '', '');
INSERT INTO `sysset` VALUES ('134', 'A010', '未打印', '', '', '', '');
INSERT INTO `sysset` VALUES ('135', 'A010', '已打印', '', '', '', '');
INSERT INTO `sysset` VALUES ('137', 'A009', '>', '', '', '', '');
INSERT INTO `sysset` VALUES ('138', 'A009', '=', '', '', '', '');
INSERT INTO `sysset` VALUES ('139', 'A009', '<', '', '', '', '');
INSERT INTO `sysset` VALUES ('141', 'A006', '电话非常配合', '', '45612', '', '');
INSERT INTO `sysset` VALUES ('143', 'A006', '已经使用了其他产品', '', '', '', '');
INSERT INTO `sysset` VALUES ('144', 'A006', '情况好了不需要', '', '', '', '');
INSERT INTO `sysset` VALUES ('145', 'A006', '明确表态，不会再买', '', '', '', '');
INSERT INTO `sysset` VALUES ('146', 'A006', '已经没在用了', '', '', '', '');
INSERT INTO `sysset` VALUES ('147', 'A006', '无故挂断', '', '', '', '');
INSERT INTO `sysset` VALUES ('148', 'A006', '停机或空号', '', '', '', '');
INSERT INTO `sysset` VALUES ('149', 'A006', '不是本人', '', '', '', '');
INSERT INTO `sysset` VALUES ('150', 'A006', '对身份有怀疑', '', '', '', '');
INSERT INTO `sysset` VALUES ('151', 'A006', '公司的服务差', '', '', '', '');
INSERT INTO `sysset` VALUES ('152', 'A006', '对公司产品不放心', '', '', '', '');
INSERT INTO `sysset` VALUES ('153', 'A006', '刚购买过产品', '', '', '', '');
INSERT INTO `sysset` VALUES ('154', 'A006', '需要考虑 ', '', '', '', '');
INSERT INTO `sysset` VALUES ('155', 'A006', '担心效果', '', '', '', '');
INSERT INTO `sysset` VALUES ('156', 'A006', '价格太贵', '', '', '', '');
INSERT INTO `sysset` VALUES ('157', 'A006', '使用后有问题', '', '', '', '');
INSERT INTO `sysset` VALUES ('158', 'A006', '转秘书台', '', '', '', '');
INSERT INTO `sysset` VALUES ('159', 'A006', '关机', '', '', '', '');
INSERT INTO `sysset` VALUES ('160', 'A006', '暂时无法接通', '', '', '', '');
INSERT INTO `sysset` VALUES ('161', 'A006', '现在忙，不方便', '', '', '', '');
INSERT INTO `sysset` VALUES ('162', 'A006', '呼入限制', '', '', '', '');
INSERT INTO `sysset` VALUES ('163', 'A006', '\r\n\r\n无人接听', '', '', '', '');
INSERT INTO `sysset` VALUES ('171', 'A007', '0次', '', '', '', '');
INSERT INTO `sysset` VALUES ('172', 'A007', '1次', '', '', '', '');
INSERT INTO `sysset` VALUES ('173', 'A007', '2次', '', '', '', '');
INSERT INTO `sysset` VALUES ('174', 'A007', '3次', '', '', '', '');
INSERT INTO `sysset` VALUES ('175', 'A007', '4次', '', '', '', '');
INSERT INTO `sysset` VALUES ('176', 'A007', '5次', '', '', '', '');
INSERT INTO `sysset` VALUES ('177', 'A007', '5次以上', '', '', '', '');
INSERT INTO `sysset` VALUES ('178', 'A021', '未完成', '', '', '', '');
INSERT INTO `sysset` VALUES ('179', 'A021', '已完成', '', '', '', '');
INSERT INTO `sysset` VALUES ('180', 'A018', '未成交', '', '', '', '');
INSERT INTO `sysset` VALUES ('181', 'A018', '已成交', '', '', '', '');
INSERT INTO `sysset` VALUES ('182', 'A019', '未处理', '', '', '', '');
INSERT INTO `sysset` VALUES ('183', 'A019', '已处理', '', '', '', '');
INSERT INTO `sysset` VALUES ('184', 'A025', '上海天龙生物科技有限公司', '', '', '', '');
INSERT INTO `sysset` VALUES ('185', 'A025', '广州锦新', '', '', '', '');
INSERT INTO `sysset` VALUES ('186', 'A025', '中国联通', '', '', '', '');
INSERT INTO `sysset` VALUES ('187', 'A026', '未审核', '', '', '', '');
INSERT INTO `sysset` VALUES ('188', 'A026', '已审核', '', '', '', '');
INSERT INTO `sysset` VALUES ('189', 'A027', '上架', '', '', '', '');
INSERT INTO `sysset` VALUES ('190', 'A027', '下架', '', '', '', '');
INSERT INTO `sysset` VALUES ('191', 'A029', '在校学生', '', '', '', '');
INSERT INTO `sysset` VALUES ('192', 'A029', '计算机/互联网/IT', '', '', '', '');
INSERT INTO `sysset` VALUES ('193', 'A029', '通讯/电子/仪表仪器', '', '', '', '');
INSERT INTO `sysset` VALUES ('194', 'A029', '销售/市场', '', '', '', '');
INSERT INTO `sysset` VALUES ('195', 'A029', '公关/商务', '', '', '', '');
INSERT INTO `sysset` VALUES ('196', 'A029', '采购/贸易', '', '', '', '');
INSERT INTO `sysset` VALUES ('197', 'A029', '行政/人事/文员', '', '', '', '');
INSERT INTO `sysset` VALUES ('198', 'A029', '高级管理', '', '', '', '');
INSERT INTO `sysset` VALUES ('199', 'A029', '私营业主', '', '', '', '');
INSERT INTO `sysset` VALUES ('200', 'A029', '公务员/国家干部', '', '', '', '');
INSERT INTO `sysset` VALUES ('201', 'A029', '金融/保险/地产', '', '', '', '');
INSERT INTO `sysset` VALUES ('202', 'A029', '教育/培训', '', '', '', '');
INSERT INTO `sysset` VALUES ('203', 'A029', '军人/警察', '', '', '', '');
INSERT INTO `sysset` VALUES ('204', 'A029', '服务行业', '', '', '', '');
INSERT INTO `sysset` VALUES ('205', 'A029', '农林牧渔', '', '', '', '');
INSERT INTO `sysset` VALUES ('206', 'A029', '医疗美容', '', '', '', '');
INSERT INTO `sysset` VALUES ('207', 'A029', '自由职业', '', '', '', '');
INSERT INTO `sysset` VALUES ('208', 'A029', '其他职业', '', '', '', '');
INSERT INTO `sysset` VALUES ('210', 'A028', '13800138000', '', '', 'dscz', '2015-12-24 15:11:07');
INSERT INTO `sysset` VALUES ('211', 'A028', '15412421112', '', '', 'dscz', '2015-12-24 15:11:31');
INSERT INTO `sysset` VALUES ('212', 'A006', '无解', '', '', '', '');
INSERT INTO `sysset` VALUES ('252', 'A028', '15424875644', '', '', 'admin', '2015-12-25 15:50:38');
INSERT INTO `sysset` VALUES ('291', 'A017', '计算机/互联网/IT', '', '', '', '');
INSERT INTO `sysset` VALUES ('292', 'A017', '通讯/电子/仪表仪器', '', '', '', '');
INSERT INTO `sysset` VALUES ('293', 'A017', '销售/市场', '', '', '', '');
INSERT INTO `sysset` VALUES ('294', 'A017', '公关/商务', '', '', '', '');
INSERT INTO `sysset` VALUES ('295', 'A017', '采购/贸易', '', '', '', '');
INSERT INTO `sysset` VALUES ('296', 'A017', '行政/人事/文员', '', '', '', '');
INSERT INTO `sysset` VALUES ('297', 'A017', '高级管理', '', '', '', '');
INSERT INTO `sysset` VALUES ('298', 'A017', '私营企业', '', '', '', '');
INSERT INTO `sysset` VALUES ('299', 'A017', '公务员/国家干部', '', '', '', '');
INSERT INTO `sysset` VALUES ('300', 'A017', '金融/保险/地产', '', '', '', '');
INSERT INTO `sysset` VALUES ('301', 'A017', '教育/培训', '', '', '', '');
INSERT INTO `sysset` VALUES ('302', 'A017', '军人/警察', '', '', '', '');
INSERT INTO `sysset` VALUES ('303', 'A017', '服务行业', '', '', '', '');
INSERT INTO `sysset` VALUES ('304', 'A017', '农林牧业', '', '', '', '');
INSERT INTO `sysset` VALUES ('305', 'A017', '医疗美容', '', '', '', '');
INSERT INTO `sysset` VALUES ('306', 'A017', '自由职业', '', '', '', '');
INSERT INTO `sysset` VALUES ('307', 'A017', '其他', '', '', '', '');
INSERT INTO `sysset` VALUES ('332', 'A030', '色情', '', '', '', '');
INSERT INTO `sysset` VALUES ('333', 'A030', '傻逼', '', '', '', '');
INSERT INTO `sysset` VALUES ('334', 'A030', '呵呵', '', '', '', '');
INSERT INTO `sysset` VALUES ('335', 'A030', '哈哈', '', '', '', '');
INSERT INTO `sysset` VALUES ('336', 'A030', '什么鬼', '', '', '', '');
INSERT INTO `sysset` VALUES ('337', 'A030', '搞笑', '', '', '', '');
INSERT INTO `sysset` VALUES ('338', 'A032', '0', '2016-02-22 10:16:41', '', '', '');
INSERT INTO `sysset` VALUES ('340', 'A033', 'hmddr', 'khai03', '号码', '001', 'N');
INSERT INTO `sysset` VALUES ('342', 'A033', 'khzl', 'khaa02', '客户ID', '002', 'N');
INSERT INTO `sysset` VALUES ('343', 'A033', 'khzl', 'khaa03', '客户姓名', '003', 'N');
INSERT INTO `sysset` VALUES ('344', 'A033', 'khzl', 'khaa04', '性别', '004', 'N');
INSERT INTO `sysset` VALUES ('345', 'A033', 'khzl', 'khaa05', '出生日期', '', '');
INSERT INTO `sysset` VALUES ('346', 'A033', 'khzl', 'khaa06', '手机', '', '');
INSERT INTO `sysset` VALUES ('347', 'A033', 'khzl', 'khaa07', '电话1', '', '');
INSERT INTO `sysset` VALUES ('348', 'A033', 'khzl', 'khaa08', '电话2', '', '');
INSERT INTO `sysset` VALUES ('349', 'A033', 'khzl', 'khaa09', 'QQ', '', '');
INSERT INTO `sysset` VALUES ('350', 'A033', 'khzl', 'khaa10', '微信', '', '');
INSERT INTO `sysset` VALUES ('351', 'A033', 'khzl', 'khaa11', '电子邮箱', '', '');
INSERT INTO `sysset` VALUES ('352', 'A033', 'khzl', 'khaa12', '联系地址', '014', 'N');
INSERT INTO `sysset` VALUES ('353', 'A033', 'khzl', 'khaa13', '兴趣爱好', '', '');
INSERT INTO `sysset` VALUES ('354', 'A033', 'khzl', 'khaa14', '客户类型', '', '');
INSERT INTO `sysset` VALUES ('355', 'A033', 'khzl', 'khaa15', '婚姻状况', '', '');
INSERT INTO `sysset` VALUES ('356', 'A033', 'khzl', 'khaa16', '从事事业', '', '');
INSERT INTO `sysset` VALUES ('357', 'A033', 'khzl', 'khaa17', '创建时间', '', '');
INSERT INTO `sysset` VALUES ('358', 'A033', 'khzl', 'khaa18', '最新跟进时间', '008', 'N');
INSERT INTO `sysset` VALUES ('359', 'A033', 'khzl', 'khaa19', '转单时间', '009', 'N');
INSERT INTO `sysset` VALUES ('360', 'A033', 'khzl', 'khaa20', '最新签收时间', '010', 'N');
INSERT INTO `sysset` VALUES ('361', 'A033', 'khzl', 'khaa21', '最新拒收时间', '', '');
INSERT INTO `sysset` VALUES ('362', 'A033', 'khzl', 'khaa22', '来源', '013', 'N');
INSERT INTO `sysset` VALUES ('363', 'A033', 'khzl', 'khaa23', '等级', '005', 'N');
INSERT INTO `sysset` VALUES ('364', 'A033', 'khzl', 'khaa24', '进线方式', '', '');
INSERT INTO `sysset` VALUES ('365', 'A033', 'khzl', 'khaa25', '客户意向', '012', 'N');
INSERT INTO `sysset` VALUES ('366', 'A033', 'khzl', 'khaa26', '学历', '', '');
INSERT INTO `sysset` VALUES ('367', 'A033', 'khzl', 'khaa27', '年收入', '', '');
INSERT INTO `sysset` VALUES ('368', 'A033', 'khzl', 'khaa28', '消费金额', '011', 'N');
INSERT INTO `sysset` VALUES ('369', 'A033', 'khzl', 'khaa29', '注册方式', '', '');
INSERT INTO `sysset` VALUES ('370', 'A033', 'khzl', 'khaa30', '注册时间', '007', 'N');
INSERT INTO `sysset` VALUES ('371', 'A033', 'khzl', 'khaa31', '手机类型', '', '');
INSERT INTO `sysset` VALUES ('372', 'A033', 'khzl', 'khaa32', '所属工号', '015', 'N');
INSERT INTO `sysset` VALUES ('373', 'A033', 'khzl', 'khaa33', '工号姓名', '016', 'N');
INSERT INTO `sysset` VALUES ('374', 'A033', 'khzl', 'khaa34', '购买产品', '', '');
INSERT INTO `sysset` VALUES ('375', 'A033', 'khzl', 'khaa35', '购买次数', '', '');
INSERT INTO `sysset` VALUES ('376', 'A033', 'khzl', 'khaa36', '身高', '', '');
INSERT INTO `sysset` VALUES ('377', 'A033', 'khzl', 'khaa37', '体重', '', '');
INSERT INTO `sysset` VALUES ('378', 'A033', 'khzl', 'khaa38', '是否成交', '006', 'N');
INSERT INTO `sysset` VALUES ('379', 'A033', 'khzl', 'khaa39', '备注', '', '');
INSERT INTO `sysset` VALUES ('380', 'A033', 'khzl', 'khaa40', '所属组', '', '');
INSERT INTO `sysset` VALUES ('381', 'A033', 'khzl', 'khaa41', '电话类型1', '', '');
INSERT INTO `sysset` VALUES ('382', 'A033', 'khzl', 'khaa42', '电话类型2', '', '');
INSERT INTO `sysset` VALUES ('383', 'A033', 'khzl', 'khaa43', '跟进标签', '', '');
INSERT INTO `sysset` VALUES ('384', 'A033', 'khzl', 'khaa44', '跟进人工号', '', '');
INSERT INTO `sysset` VALUES ('385', 'A033', 'khzl', 'khaa45', '跟进人姓名', '', '');
INSERT INTO `sysset` VALUES ('387', 'A033', 'khzl', 'khaa47', '年龄', '', '');
INSERT INTO `sysset` VALUES ('414', 'A033', 'good', 'cpaa01', '产品编号', '', '');
INSERT INTO `sysset` VALUES ('415', 'A033', 'good', 'cpaa02', '产品名', '001', 'N');
INSERT INTO `sysset` VALUES ('416', 'A033', 'good', 'cpaa03', '分类ID', '002', 'N');
INSERT INTO `sysset` VALUES ('417', 'A033', 'good', 'cpaa04', '产品子分类ID', '', '');
INSERT INTO `sysset` VALUES ('418', 'A033', 'good', 'cpaa05', '品牌', '006', 'N');
INSERT INTO `sysset` VALUES ('419', 'A033', 'good', 'cpaa06', '销售价', '003', 'N');
INSERT INTO `sysset` VALUES ('420', 'A033', 'good', 'cpaa07', '创建时间', '', '');
INSERT INTO `sysset` VALUES ('421', 'A033', 'good', 'cpaa08', '是否上架', '007', 'N');
INSERT INTO `sysset` VALUES ('422', 'A033', 'good', 'cpaa09', '是否促销', '004', 'N');
INSERT INTO `sysset` VALUES ('423', 'A033', 'good', 'cpaa10', '规格', '011', 'N');
INSERT INTO `sysset` VALUES ('424', 'A033', 'good', 'cpaa11', '产品属性', '', '');
INSERT INTO `sysset` VALUES ('425', 'A033', 'good', 'cpaa12', '介绍', '005', 'N');
INSERT INTO `sysset` VALUES ('426', 'A033', 'good', 'cpaa14', '部门标示', '', '');
INSERT INTO `sysset` VALUES ('427', 'A033', 'good', 'cpaa15', '条码', '', '');
INSERT INTO `sysset` VALUES ('428', 'A033', 'good', 'cpaa16', '厂家货号', '008', 'N');
INSERT INTO `sysset` VALUES ('429', 'A033', 'good', 'cpaa17', '套用明细', '', '');
INSERT INTO `sysset` VALUES ('430', 'A033', 'good', 'cpaa18', '供应商编号', '', '');
INSERT INTO `sysset` VALUES ('431', 'A033', 'good', 'cpae03', '正品库存', '009', 'N');
INSERT INTO `sysset` VALUES ('432', 'A033', 'good', 'cpae07', '均价', '010', 'N');
INSERT INTO `sysset` VALUES ('433', 'A033', 'khgj', 'khae01', '客户编号', '001', 'N');
INSERT INTO `sysset` VALUES ('434', 'A033', 'khgj', 'khae02', '跟进标签', '003', 'N');
INSERT INTO `sysset` VALUES ('435', 'A033', 'khgj', 'khae03', '内容', '004', 'N');
INSERT INTO `sysset` VALUES ('436', 'A033', 'khgj', 'khae04', '安排人工号', '005', 'N');
INSERT INTO `sysset` VALUES ('437', 'A033', 'khgj', 'khae05', '安排人姓名', '006', 'N');
INSERT INTO `sysset` VALUES ('438', 'A033', 'khgj', 'khae06', '跟进人工号', '007', 'N');
INSERT INTO `sysset` VALUES ('439', 'A033', 'khgj', 'khae07', '跟进人姓名', '008', 'N');
INSERT INTO `sysset` VALUES ('440', 'A033', 'khgj', 'khae08', '记录时间', '009', 'N');
INSERT INTO `sysset` VALUES ('441', 'A033', 'khgj', 'khae09', '待办时间', '010', 'N');
INSERT INTO `sysset` VALUES ('442', 'A033', 'khgj', 'khae10', '是否完成', '011', 'N');
INSERT INTO `sysset` VALUES ('443', 'A033', 'khgj', 'khaa03', '姓名', '002', 'N');
INSERT INTO `sysset` VALUES ('444', 'A033', 'khts', 'khac01', '客户编号', '001', 'N');
INSERT INTO `sysset` VALUES ('445', 'A033', 'khts', 'khac02', '投诉类型', '003', 'N');
INSERT INTO `sysset` VALUES ('446', 'A033', 'khts', 'khac03', '投诉工号', '006', 'N');
INSERT INTO `sysset` VALUES ('447', 'A033', 'khts', 'khac04', '跟进工号', '008', 'N');
INSERT INTO `sysset` VALUES ('448', 'A033', 'khts', 'khac05', '订单ID', '004', 'N');
INSERT INTO `sysset` VALUES ('449', 'A033', 'khts', 'khac06', '投诉产品', '005', 'N');
INSERT INTO `sysset` VALUES ('450', 'A033', 'khts', 'khac07', '备注', '012', 'N');
INSERT INTO `sysset` VALUES ('451', 'A033', 'khts', 'khac08', '处理结果', '011', 'N');
INSERT INTO `sysset` VALUES ('452', 'A033', 'khts', 'khac09', '提交工号', '007', 'N');
INSERT INTO `sysset` VALUES ('453', 'A033', 'khts', 'khac10', '提交时间', '009', 'N');
INSERT INTO `sysset` VALUES ('454', 'A033', 'khts', 'khac11', '处理时间', '010', 'N');
INSERT INTO `sysset` VALUES ('455', 'A033', 'khts', 'khac13', '姓名', '002', 'N');
INSERT INTO `sysset` VALUES ('456', 'A033', 'khdd', 'xsaa02', '订单ID', '001', 'N');
INSERT INTO `sysset` VALUES ('457', 'A033', 'khdd', 'xsaa03', '快递单号', '014', 'N');
INSERT INTO `sysset` VALUES ('458', 'A033', 'khdd', 'xsaa04', '客户ID', '002', 'N');
INSERT INTO `sysset` VALUES ('459', 'A033', 'khdd', 'xsaa05', '客户姓名', '003', 'N');
INSERT INTO `sysset` VALUES ('460', 'A033', 'khdd', 'xsaa06', '客户手机', '', '');
INSERT INTO `sysset` VALUES ('461', 'A033', 'khdd', 'xsaa08', '客户意向', '011', 'N');
INSERT INTO `sysset` VALUES ('462', 'A033', 'khdd', 'xsaa09', '送货地址', '', '');
INSERT INTO `sysset` VALUES ('463', 'A033', 'khdd', 'xsaa10', '邮编', '', '');
INSERT INTO `sysset` VALUES ('464', 'A033', 'khdd', 'xsaa11', '订单类型', '', '');
INSERT INTO `sysset` VALUES ('465', 'A033', 'khdd', 'xsaa13', '支付方式', '004', 'N');
INSERT INTO `sysset` VALUES ('466', 'A033', 'khdd', 'xsaa16', '运费', '', '');
INSERT INTO `sysset` VALUES ('467', 'A033', 'khdd', 'xsaa19', '总金额', '005', 'N');
INSERT INTO `sysset` VALUES ('468', 'A033', 'khdd', 'xsaa20', '已收金额', '006', 'N');
INSERT INTO `sysset` VALUES ('469', 'A033', 'khdd', 'xsaa23', '下单时间', '007', 'N');
INSERT INTO `sysset` VALUES ('470', 'A033', 'khdd', 'xsaa25', '审核时间', '', '');
INSERT INTO `sysset` VALUES ('471', 'A033', 'khdd', 'xsaa26', '支付时间', '', '');
INSERT INTO `sysset` VALUES ('472', 'A033', 'khdd', 'xsaa27', '发货时间', '', '');
INSERT INTO `sysset` VALUES ('473', 'A033', 'khdd', 'xsaa28', '签收时间', '', '');
INSERT INTO `sysset` VALUES ('474', 'A033', 'khdd', 'xsaa29', '订单状态', '010', 'N');
INSERT INTO `sysset` VALUES ('475', 'A033', 'khdd', 'xsaa30', '审核状态', '', '');
INSERT INTO `sysset` VALUES ('476', 'A033', 'khdd', 'xsaa33', '业绩分配', '009', 'N');
INSERT INTO `sysset` VALUES ('477', 'A033', 'khdd', 'xsaa48', '下单人', '008', 'N');
INSERT INTO `sysset` VALUES ('478', 'A033', 'khdd', 'xsaa39', '最新跟进时间', '012', 'N');
INSERT INTO `sysset` VALUES ('479', 'A033', 'khdd', 'xsaa36', '备注', '013', 'N');
INSERT INTO `sysset` VALUES ('480', 'A033', 'khdd', 'xsaa41', '快递名称', '015', 'N');
INSERT INTO `sysset` VALUES ('481', 'A033', 'wlfh', 'xsaa02', '订单ID', '001', 'N');
INSERT INTO `sysset` VALUES ('482', 'A033', 'wlfh', 'xsaa05', '客户姓名', '002', 'N');
INSERT INTO `sysset` VALUES ('483', 'A033', 'wlfh', 'xsaa23', '下单时间', '003', 'N');
INSERT INTO `sysset` VALUES ('484', 'A033', 'wlfh', 'xsaa25', '审核时间', '004', 'N');
INSERT INTO `sysset` VALUES ('485', 'A033', 'wlfh', 'xsaa29', '订单状态', '005', 'N');
INSERT INTO `sysset` VALUES ('486', 'A033', 'wlfh', 'xsaa41', '快递公司', '006', 'N');
INSERT INTO `sysset` VALUES ('487', 'A033', 'wlfh', 'xsaa03', '快递单号', '007', 'N');
INSERT INTO `sysset` VALUES ('488', 'A033', 'wlfh', 'xsaa13', '付款方式', '008', 'N');
INSERT INTO `sysset` VALUES ('489', 'A033', 'wlfh', 'xsaa19', '订单总额', '009', 'N');
INSERT INTO `sysset` VALUES ('490', 'A033', 'wlfh', 'xsaa36', '备注', '010', 'N');
INSERT INTO `sysset` VALUES ('492', 'A033', 'kcmx', 'cpaa01', '产品编号', '002', 'N');
INSERT INTO `sysset` VALUES ('493', 'A033', 'kcmx', 'cpaa02', '产品名称', '003', 'N');
INSERT INTO `sysset` VALUES ('494', 'A033', 'kcmx', 'cpaa10', '规格', '004', 'N');
INSERT INTO `sysset` VALUES ('495', 'A033', 'kcmx', 'cpae06', '库位', '005', 'N');
INSERT INTO `sysset` VALUES ('496', 'A033', 'kcmx', 'cpae03', '正品库存量', '006', 'N');
INSERT INTO `sysset` VALUES ('497', 'A033', 'kcmx', 'cpae04', '次品库存量', '007', 'N');
INSERT INTO `sysset` VALUES ('498', 'A033', 'kcmx', 'cpae09', '预警', '008', 'N');
INSERT INTO `sysset` VALUES ('499', 'A033', 'kcmx', 'cpae07', '价格', '009', 'N');
INSERT INTO `sysset` VALUES ('500', 'A033', 'kcmx', 'cpae13', '总额', '010', 'N');
INSERT INTO `sysset` VALUES ('501', 'A033', 'kcmx', 'cpaa15', '条码', '011', 'N');
INSERT INTO `sysset` VALUES ('502', 'A033', 'kcmx', 'cpaa08', '是否上架', '012', 'N');
INSERT INTO `sysset` VALUES ('503', 'A033', 'kcmx', 'cpae21', '供应商', '013', 'N');
INSERT INTO `sysset` VALUES ('504', 'A033', 'thddjl', 'xsaa02', '订单ID', '001', 'N');
INSERT INTO `sysset` VALUES ('505', 'A033', 'thddjl', 'xsaa13', '付款方式', '002', 'N');
INSERT INTO `sysset` VALUES ('506', 'A033', 'thddjl', 'xsaa29', '订单状态', '003', 'N');
INSERT INTO `sysset` VALUES ('507', 'A033', 'thddjl', 'xsaa44', '退货金额', '004', 'N');
INSERT INTO `sysset` VALUES ('508', 'A033', 'thddjl', 'xsaa23', '下单时间', '005', 'N');
INSERT INTO `sysset` VALUES ('509', 'A033', 'thddjl', 'xsaa41', '快递公司', '006', 'N');
INSERT INTO `sysset` VALUES ('510', 'A033', 'thddjl', 'xsaa03', '快递单号', '007', 'N');
INSERT INTO `sysset` VALUES ('511', 'A033', 'thddjl', 'xsaa48', '销售工号', '008', 'N');
INSERT INTO `sysset` VALUES ('512', 'A033', 'thddjl', 'xsaa22', '操作人', '009', 'N');
INSERT INTO `sysset` VALUES ('513', 'A033', 'thddjl', 'xsaa43', '入仓时间', '010', 'N');
INSERT INTO `sysset` VALUES ('514', 'A033', 'thkhhz', 'xsab03', '产品款号', '001', 'N');
INSERT INTO `sysset` VALUES ('515', 'A033', 'thkhhz', 'xsab02', '产品名称', '002', 'N');
INSERT INTO `sysset` VALUES ('516', 'A033', 'thkhhz', 'sum(xsab14) as xsab14', '入库数', '003', 'N');
INSERT INTO `sysset` VALUES ('517', 'A033', 'thkhhz', 'sum(xsab15) as xsab15', '总额', '004', 'N');
INSERT INTO `sysset` VALUES ('518', 'A033', 'thkhhz', 'xsab19', '成本', '005', 'N');
INSERT INTO `sysset` VALUES ('519', 'A033', 'thkhmx', 'xsab01', '订单号', '001', 'N');
INSERT INTO `sysset` VALUES ('520', 'A033', 'thkhmx', 'xsab03', '产品款号', '002', 'N');
INSERT INTO `sysset` VALUES ('521', 'A033', 'thkhmx', 'xsab02', '产品名称', '003', 'N');
INSERT INTO `sysset` VALUES ('522', 'A033', 'thkhmx', 'xsab14', '入库数', '004', 'N');
INSERT INTO `sysset` VALUES ('523', 'A033', 'thkhmx', 'xsab15', '总额', '005', 'N');
INSERT INTO `sysset` VALUES ('524', 'A033', 'thkhmx', 'xsab19', '成本', '006', 'N');
INSERT INTO `sysset` VALUES ('525', 'A033', 'thkhmx', 'xsab17', '入库时间', '007', 'N');
INSERT INTO `sysset` VALUES ('526', 'A033', 'kcydmx', 'cpaf02', '批次', '001', 'N');
INSERT INTO `sysset` VALUES ('527', 'A033', 'kcydmx', 'cpaa01', '款号', '002', 'N');
INSERT INTO `sysset` VALUES ('530', 'A033', 'kcydmx', 'cpaf16', '操作人', '005', 'N');
INSERT INTO `sysset` VALUES ('531', 'A033', 'kcydmx', 'cpaf08', '出/入库数量', '006', 'N');
INSERT INTO `sysset` VALUES ('532', 'A033', 'kcydmx', 'cpaf05', '库位', '007', 'N');
INSERT INTO `sysset` VALUES ('533', 'A033', 'kcydmx', 'cpaf07', '出/入库时间', '008', 'N');
INSERT INTO `sysset` VALUES ('534', 'A033', 'kcydmx', 'cpaf09', '出/入库类型', '009', 'N');
INSERT INTO `sysset` VALUES ('535', 'A033', 'kcydmx', 'cpaf14', '供应商', '010', 'N');
INSERT INTO `sysset` VALUES ('536', 'A033', 'kcydmx', 'cpaf12', '运费', '011', 'N');
INSERT INTO `sysset` VALUES ('537', 'A033', 'kcydmx', 'cpaf10', '备注', '012', 'N');
INSERT INTO `sysset` VALUES ('538', 'A033', 'pdmx', 'pdab01', '盘点单号', '001', 'N');
INSERT INTO `sysset` VALUES ('539', 'A033', 'pdmx', 'pdab02', '批次', '002', 'N');
INSERT INTO `sysset` VALUES ('540', 'A033', 'pdmx', 'pdab03', '款号', '003', 'N');
INSERT INTO `sysset` VALUES ('541', 'A033', 'pdmx', 'pdab11', '商品名称', '004', 'N');
INSERT INTO `sysset` VALUES ('542', 'A033', 'pdmx', 'pdab04', '规格', '005', 'N');
INSERT INTO `sysset` VALUES ('543', 'A033', 'pdmx', 'pdab07', '单位', '006', 'N');
INSERT INTO `sysset` VALUES ('544', 'A033', 'pdmx', 'pdab05', '正品库存量', '007', 'N');
INSERT INTO `sysset` VALUES ('545', 'A033', 'pdmx', 'pdab06', '次品库存量', '008', 'N');
INSERT INTO `sysset` VALUES ('546', 'A033', 'pdmx', 'pdab10', '库位', '009', 'N');
INSERT INTO `sysset` VALUES ('547', 'A033', 'kcpdjl', 'pdaa01', '盘点单号', '001', 'N');
INSERT INTO `sysset` VALUES ('548', 'A033', 'kcpdjl', 'cpaa01', '产品款号', '002', 'N');
INSERT INTO `sysset` VALUES ('549', 'A033', 'kcpdjl', 'cpaa16', '货号', '003', 'N');
INSERT INTO `sysset` VALUES ('550', 'A033', 'kcpdjl', 'cpaa02', '产品名称', '004', 'N');
INSERT INTO `sysset` VALUES ('551', 'A033', 'kcpdjl', 'pdab08', '盘点库存', '005', 'N');
INSERT INTO `sysset` VALUES ('552', 'A033', 'kcpdjl', 'pdaa02', '操作人员', '006', 'N');
INSERT INTO `sysset` VALUES ('553', 'A033', 'kcpdjl', 'pdaa03', '盘点日期', '007', 'N');
INSERT INTO `sysset` VALUES ('554', 'A033', 'chdd', 'xsaa02', '订单号', '001', 'N');
INSERT INTO `sysset` VALUES ('555', 'A033', 'chdd', 'xsaa13', '支付方式', '002', 'N');
INSERT INTO `sysset` VALUES ('556', 'A033', 'chdd', 'xsaa19', '总金额', '003', 'N');
INSERT INTO `sysset` VALUES ('557', 'A033', 'chdd', 'xsaa16', '运费', '004', 'N');
INSERT INTO `sysset` VALUES ('558', 'A033', 'chdd', 'xsaa27', '发货时间', '005', 'N');
INSERT INTO `sysset` VALUES ('559', 'A033', 'chdd', 'xsaa29', '订单状态', '006', 'N');
INSERT INTO `sysset` VALUES ('560', 'A033', 'chdd', 'xsaa41', '快递公司', '007', 'N');
INSERT INTO `sysset` VALUES ('561', 'A033', 'chdd', 'xsaa03', '快递单号', '008', 'N');
INSERT INTO `sysset` VALUES ('562', 'A033', 'chdd', 'xsaa48', '销售工号', '009', 'N');
INSERT INTO `sysset` VALUES ('563', 'A033', 'chdd', 'xsaa33', '业绩工号', '010', 'N');
INSERT INTO `sysset` VALUES ('564', 'A033', 'chdd', 'xsaa57', '快递费', '011', 'N');
INSERT INTO `sysset` VALUES ('565', 'A033', 'chdd', 'xsaa58', '手续费', '012', 'N');
INSERT INTO `sysset` VALUES ('566', 'A033', 'chdd', 'xsaa59', '其他费', '013', 'N');
INSERT INTO `sysset` VALUES ('567', 'A033', 'chdd', 'xsaa54', '是否记账1', '014', '');
INSERT INTO `sysset` VALUES ('568', 'A033', 'chdd', 'xsaa55', '是否记账2', '015', '');
INSERT INTO `sysset` VALUES ('569', 'A033', 'khchhz', 'xsab03', '产品款号', '001', 'N');
INSERT INTO `sysset` VALUES ('570', 'A033', 'khchhz', 'xsab02', '产品名称', '002', 'N');
INSERT INTO `sysset` VALUES ('571', 'A033', 'khchhz', 'sum(xsab04) as xsab04', '销售数量', '003', 'N');
INSERT INTO `sysset` VALUES ('572', 'A033', 'khchhz', 'sum(xsab06) as xsab06', '销售金额', '004', 'N');
INSERT INTO `sysset` VALUES ('573', 'A033', 'khchhz', 'xsab19', '成本金额', '005', 'N');
INSERT INTO `sysset` VALUES ('574', 'A033', 'khchmx', 'xsab01', '订单号', '001', 'N');
INSERT INTO `sysset` VALUES ('575', 'A033', 'khchmx', 'xsab03', '产品款号', '002', 'N');
INSERT INTO `sysset` VALUES ('576', 'A033', 'khchmx', 'xsab02', '产品名称', '003', 'N');
INSERT INTO `sysset` VALUES ('577', 'A033', 'khchmx', 'xsab04', '销售数量', '004', 'N');
INSERT INTO `sysset` VALUES ('578', 'A033', 'khchmx', 'xsab06', '销售金额', '005', 'N');
INSERT INTO `sysset` VALUES ('579', 'A033', 'khchmx', 'xsab19', '成本金额', '006', 'N');
INSERT INTO `sysset` VALUES ('580', 'A033', 'thhddhz', 'xsaa02', '订单号', '001', 'N');
INSERT INTO `sysset` VALUES ('581', 'A033', 'thhddhz', 'xsaa04', '客户ID', '002', 'N');
INSERT INTO `sysset` VALUES ('582', 'A033', 'thhddhz', 'xsaa13', '支付方式', '003', 'N');
INSERT INTO `sysset` VALUES ('583', 'A033', 'thhddhz', 'xsaa19', '金额', '004', 'N');
INSERT INTO `sysset` VALUES ('584', 'A033', 'thhddhz', 'xsaa16', '运费', '005', 'N');
INSERT INTO `sysset` VALUES ('585', 'A033', 'thhddhz', 'xsaa44', '退金额', '006', 'N');
INSERT INTO `sysset` VALUES ('586', 'A033', 'thhddhz', 'xsaa51', '退货时间', '007', 'N');
INSERT INTO `sysset` VALUES ('587', 'A033', 'thhddhz', 'xsaa29', '订单状态', '008', 'N');
INSERT INTO `sysset` VALUES ('588', 'A033', 'thhddhz', 'xsaa41', '快递公司', '009', 'N');
INSERT INTO `sysset` VALUES ('589', 'A033', 'thhddhz', 'xsaa03', '快递单号', '010', 'N');
INSERT INTO `sysset` VALUES ('590', 'A033', 'thhddhz', 'xsaa48', '销售工号', '011', 'N');
INSERT INTO `sysset` VALUES ('591', 'A033', 'thhddhz', 'xsaa60', '来源', '012', 'N');
INSERT INTO `sysset` VALUES ('592', 'A033', 'thhddhz', 'xsaa57', '快递费', '013', 'N');
INSERT INTO `sysset` VALUES ('593', 'A033', 'thhddhz', 'xsaa58', '手续费', '014', 'N');
INSERT INTO `sysset` VALUES ('594', 'A033', 'thhddhz', 'xsaa59', '其他费', '015', 'N');
INSERT INTO `sysset` VALUES ('595', 'A033', 'thhddhz', 'xsaa56', '是否已退款', '016', '');
INSERT INTO `sysset` VALUES ('596', 'A033', 'thhddmx', 'xsaa02', '订单ID', '001', 'N');
INSERT INTO `sysset` VALUES ('597', 'A033', 'thhddmx', 'xsaa51', '退货时间', '002', 'N');
INSERT INTO `sysset` VALUES ('598', 'A033', 'thhddmx', 'xsaa13', '支付方式', '003', 'N');
INSERT INTO `sysset` VALUES ('599', 'A033', 'thhddmx', 'xsaa41', '快递公司', '004', 'N');
INSERT INTO `sysset` VALUES ('600', 'A033', 'thhddmx', 'xsaa03', '快递单号', '005', 'N');
INSERT INTO `sysset` VALUES ('601', 'A033', 'thhddmx', 'xsaa15', '退金额', '006', 'N');
INSERT INTO `sysset` VALUES ('602', 'A033', 'thhddmx', 'xsab03', '款号', '007', 'N');
INSERT INTO `sysset` VALUES ('603', 'A033', 'thhddmx', 'xsab02', '产品名称', '008', 'N');
INSERT INTO `sysset` VALUES ('604', 'A033', 'thhddmx', 'xsab14', '数量', '009', 'N');
INSERT INTO `sysset` VALUES ('605', 'A033', 'thhddmx', 'xsaa49', '状态', '010', 'N');
INSERT INTO `sysset` VALUES ('606', 'A033', 'thhddmx', 'xsab20', '是否入库', '011', 'N');
INSERT INTO `sysset` VALUES ('607', 'A033', 'cplb', 'cpaa01', '款号', '001', 'N');
INSERT INTO `sysset` VALUES ('608', 'A033', 'cplb', 'cpaa02', '商品名称', '002', 'N');
INSERT INTO `sysset` VALUES ('609', 'A033', 'cplb', 'cpaa10', '规格', '003', 'N');
INSERT INTO `sysset` VALUES ('610', 'A033', 'cplb', 'cpab02', '产品分类', '004', 'N');
INSERT INTO `sysset` VALUES ('611', 'A033', 'cplb', 'cpaa14', '标示', '005', 'N');
INSERT INTO `sysset` VALUES ('612', 'A033', 'cplb', 'cpaa16', '厂家货号', '006', 'N');
INSERT INTO `sysset` VALUES ('613', 'A033', 'cplb', 'cpaa06', '销售价', '007', 'N');
INSERT INTO `sysset` VALUES ('614', 'A033', 'cplb', 'cpaa08', '是否上架', '008', 'N');
INSERT INTO `sysset` VALUES ('615', 'A033', 'cplb', 'cpaa07', '添加时间', '009', 'N');
INSERT INTO `sysset` VALUES ('616', 'A033', 'ghlb', 'username', '工号', '001', 'N');
INSERT INTO `sysset` VALUES ('617', 'A033', 'ghlb', 'personname', '姓名', '002', 'N');
INSERT INTO `sysset` VALUES ('618', 'A033', 'ghlb', 'post', '所属角色', '003', 'N');
INSERT INTO `sysset` VALUES ('619', 'A033', 'ghlb', 'loginTime', '最后登录时间', '004', 'N');
INSERT INTO `sysset` VALUES ('620', 'A033', 'ghlb', 'loginIp', '登录IP', '005', 'N');
INSERT INTO `sysset` VALUES ('621', 'A033', 'ghlb', 'fenji', '分机', '006', 'N');
INSERT INTO `sysset` VALUES ('622', 'A033', 'ghlb', 'telephone', '手机号码', '007', 'N');
INSERT INTO `sysset` VALUES ('623', 'A033', 'ghlb', 'managerPower', '可看组别', '008', '');
INSERT INTO `sysset` VALUES ('624', 'A033', 'ghlb', 'limitIp', '限定IP', '009', '');
INSERT INTO `sysset` VALUES ('625', 'A033', 'ghlb', 'limitMAC', '限定MAC', '010', '');
INSERT INTO `sysset` VALUES ('626', 'A033', 'ghlb', 'isonline', '是否在线', '011', 'N');
INSERT INTO `sysset` VALUES ('627', 'A033', 'ghlb', 'enabled', '是否禁用', '012', 'N');
INSERT INTO `sysset` VALUES ('628', 'A031', '全额退款', '', '', '', '');
INSERT INTO `sysset` VALUES ('629', 'A031', '部分退款', '', '', '', '');
INSERT INTO `sysset` VALUES ('630', 'A031', '退货', '', '', '', '');
INSERT INTO `sysset` VALUES ('631', 'A031', '换货', '', '', '', '');
INSERT INTO `sysset` VALUES ('632', 'A031', '产品赠送', '', '', '', '');
INSERT INTO `sysset` VALUES ('633', 'A031', '赠品赠送', '', '', '', '');
INSERT INTO `sysset` VALUES ('634', 'A031', '补发', '', '', '', '');
INSERT INTO `sysset` VALUES ('635', 'A031', '处理中', '', '', '', '');
INSERT INTO `sysset` VALUES ('636', 'A031', '已处理', '', '', '', '');
INSERT INTO `sysset` VALUES ('637', 'A033', 'kcmx', 'cpae01', '批次', '001', 'N');
INSERT INTO `sysset` VALUES ('638', 'A035', '直接入库', '', '', '', '');
INSERT INTO `sysset` VALUES ('639', 'A035', '采购单入库', '', '', '', '');
INSERT INTO `sysset` VALUES ('640', 'A035', '出库', '', '', '', '');
INSERT INTO `sysset` VALUES ('641', 'A035', '退货入仓', '', '', '', '');
INSERT INTO `sysset` VALUES ('642', 'A035', '盘盈', '', '', '', '');
INSERT INTO `sysset` VALUES ('643', 'A035', '盘亏', '', '', '', '');
INSERT INTO `sysset` VALUES ('644', 'A035', '退货供应商', '', '', '', '');
INSERT INTO `sysset` VALUES ('645', 'A034', '440000.广东省-440100.广州市-.选择区/县', '开', '2016-03-25 18:25:45', '', '');
INSERT INTO `sysset` VALUES ('647', 'A028', '13522454487', '', '', 'admin', '2016-03-18 11:54:01');
INSERT INTO `sysset` VALUES ('648', 'A028', '13832132111', '', '', 'admin', '2016-03-18 14:23:32');
INSERT INTO `sysset` VALUES ('649', 'A033', 'drkdd', 'xsaa02', '订单号', '001', '');
INSERT INTO `sysset` VALUES ('650', 'A033', 'drkdd', 'xsaa41', '快递公司', '002', '');
INSERT INTO `sysset` VALUES ('651', 'A033', 'drkdd', 'xsaa03', '快递单号', '003', '');
INSERT INTO `sysset` VALUES ('652', 'A033', 'drkdd', 'xsaa36', '备注', '004', '');
INSERT INTO `sysset` VALUES ('653', 'A033', 'wckdd', 'xsaa02', '订单号', '001', '');
INSERT INTO `sysset` VALUES ('654', 'A033', 'wckdd', 'xsaa03', '快递单号', '002', '');
INSERT INTO `sysset` VALUES ('655', 'A033', 'wckdd', 'xsaa28', '签收时间', '003', '');
INSERT INTO `sysset` VALUES ('656', 'A033', 'wckdd', 'xsaa29', '状态', '004', '');
INSERT INTO `sysset` VALUES ('657', 'A033', 'ygyjtjbb', 'personname', '工号', '001', '');
INSERT INTO `sysset` VALUES ('658', 'A033', 'ygyjtjbb', 'peopleNum', '新进客户', '002', '');
INSERT INTO `sysset` VALUES ('659', 'A033', 'ygyjtjbb', 'xdOrders', '下单', '003', '');
INSERT INTO `sysset` VALUES ('660', 'A033', 'ygyjtjbb', 'xdMoney', '下单金额', '004', '');
INSERT INTO `sysset` VALUES ('661', 'A033', 'ygyjtjbb', 'xdratio', '成交率', '005', '');
INSERT INTO `sysset` VALUES ('662', 'A033', 'ygyjtjbb', 'sdOrders', '审单', '006', '');
INSERT INTO `sysset` VALUES ('663', 'A033', 'ygyjtjbb', 'sdMoney', '审单金额', '007', '');
INSERT INTO `sysset` VALUES ('664', 'A033', 'ygyjtjbb', 'sdratio', '核单率', '008', '');
INSERT INTO `sysset` VALUES ('665', 'A033', 'ygyjtjbb', 'fhOrders', '发货', '009', '');
INSERT INTO `sysset` VALUES ('666', 'A033', 'ygyjtjbb', 'fhMoney', '发货金额', '010', '');
INSERT INTO `sysset` VALUES ('667', 'A033', 'ygyjtjbb', 'jsOrders', '拒收', '011', '');
INSERT INTO `sysset` VALUES ('668', 'A033', 'ygyjtjbb', 'jsMoney', '拒收金额', '012', '');
INSERT INTO `sysset` VALUES ('669', 'A033', 'ygyjtjbb', 'qsOrders', '签收', '013', '');
INSERT INTO `sysset` VALUES ('670', 'A033', 'ygyjtjbb', 'qsMoney', '签收金额', '014', '');
INSERT INTO `sysset` VALUES ('671', 'A033', 'ygyjtjbb', 'qsratio', '签收率', '015', '');
INSERT INTO `sysset` VALUES ('672', 'A033', 'fzxstjbb', 'depttext', '分组', '001', '');
INSERT INTO `sysset` VALUES ('673', 'A033', 'fzxstjbb', 'peopleNum', '新进客户', '002', '');
INSERT INTO `sysset` VALUES ('674', 'A033', 'fzxstjbb', 'xdOrders', '下单', '003', '');
INSERT INTO `sysset` VALUES ('675', 'A033', 'fzxstjbb', 'xdMoney', '下单金额', '004', '');
INSERT INTO `sysset` VALUES ('676', 'A033', 'fzxstjbb', 'xdratio', '成交率', '005', '');
INSERT INTO `sysset` VALUES ('677', 'A033', 'fzxstjbb', 'sdOrders', '审单', '006', '');
INSERT INTO `sysset` VALUES ('678', 'A033', 'fzxstjbb', 'sdMoney', '审单金额', '007', '');
INSERT INTO `sysset` VALUES ('679', 'A033', 'fzxstjbb', 'sdratio', '审单率', '008', '');
INSERT INTO `sysset` VALUES ('680', 'A033', 'fzxstjbb', 'fhOrders', '发货', '009', '');
INSERT INTO `sysset` VALUES ('681', 'A033', 'fzxstjbb', 'fhMoney', '发货金额', '010', '');
INSERT INTO `sysset` VALUES ('682', 'A033', 'fzxstjbb', 'jsOrders', '拒收', '011', '');
INSERT INTO `sysset` VALUES ('683', 'A033', 'fzxstjbb', 'jsMoney', '拒收金额', '012', '');
INSERT INTO `sysset` VALUES ('684', 'A033', 'fzxstjbb', 'qsOrders', '签收', '013', '');
INSERT INTO `sysset` VALUES ('685', 'A033', 'fzxstjbb', 'qsMoney', '签收金额', '014', '');
INSERT INTO `sysset` VALUES ('686', 'A033', 'fzxstjbb', 'qsratio', '签收率', '015', '');
INSERT INTO `sysset` VALUES ('687', 'A033', 'ddzztj', 'depttext', '分组', '001', '');
INSERT INTO `sysset` VALUES ('688', 'A033', 'ddzztj', 'wksOrders', '未客审', '002', '');
INSERT INTO `sysset` VALUES ('689', 'A033', 'ddzztj', 'wksMoney', '未客审金额', '003', '');
INSERT INTO `sysset` VALUES ('690', 'A033', 'ddzztj', 'yksOrders', '已客审', '004', '');
INSERT INTO `sysset` VALUES ('691', 'A033', 'ddzztj', 'yksMoney', '已客审金额', '005', '');
INSERT INTO `sysset` VALUES ('692', 'A033', 'ddzztj', 'wcsOrders', '未财审', '006', '');
INSERT INTO `sysset` VALUES ('693', 'A033', 'ddzztj', 'wcsMoney', '未财审金额', '007', '');
INSERT INTO `sysset` VALUES ('694', 'A033', 'ddzztj', 'ycsOrders', '已财审', '008', '');
INSERT INTO `sysset` VALUES ('695', 'A033', 'ddzztj', 'ycsMoney', '已财审金额', '009', '');
INSERT INTO `sysset` VALUES ('696', 'A033', 'ddzztj', 'dfhOrders', '待发货', '010', '');
INSERT INTO `sysset` VALUES ('697', 'A033', 'ddzztj', 'dfhMoney', '待发货金额', '011', '');
INSERT INTO `sysset` VALUES ('698', 'A033', 'ddzztj', 'yfhOrders', '已发货', '012', '');
INSERT INTO `sysset` VALUES ('699', 'A033', 'ddzztj', 'yfhMoney', '已发货金额', '013', '');
INSERT INTO `sysset` VALUES ('700', 'A033', 'dytjbb', 'pro', '地区', '001', '');
INSERT INTO `sysset` VALUES ('701', 'A033', 'dytjbb', 'peopleNum', '客户数', '002', '');
INSERT INTO `sysset` VALUES ('702', 'A033', 'dytjbb', 'xdOrders', '下单', '003', '');
INSERT INTO `sysset` VALUES ('703', 'A033', 'dytjbb', 'xdMoney', '下单金额', '004', '');
INSERT INTO `sysset` VALUES ('704', 'A033', 'dytjbb', 'xdRatio', '比例', '005', '');
INSERT INTO `sysset` VALUES ('705', 'A033', 'dytjbb', 'qrOrders', '确认', '006', '');
INSERT INTO `sysset` VALUES ('706', 'A033', 'dytjbb', 'qrMoney', '确认金额', '007', '');
INSERT INTO `sysset` VALUES ('707', 'A033', 'dytjbb', 'qrRatio', '比例', '008', '');
INSERT INTO `sysset` VALUES ('708', 'A033', 'dytjbb', 'fhOrders', '发货', '009', '');
INSERT INTO `sysset` VALUES ('709', 'A033', 'dytjbb', 'fhMoney', '发货金额', '010', '');
INSERT INTO `sysset` VALUES ('710', 'A033', 'dytjbb', 'jsOrders', '拒收', '011', '');
INSERT INTO `sysset` VALUES ('711', 'A033', 'dytjbb', 'jsMoney', '拒收金额', '012', '');
INSERT INTO `sysset` VALUES ('712', 'A033', 'dytjbb', 'qsOrders', '签收', '013', '');
INSERT INTO `sysset` VALUES ('713', 'A033', 'dytjbb', 'qsMoney', '签收金额', '014', '');
INSERT INTO `sysset` VALUES ('714', 'A033', 'tstjbb', 'colName', '投诉工号', '001', '');
INSERT INTO `sysset` VALUES ('715', 'A033', 'tstjbb', 'complaintNum', '总数', '002', '');
INSERT INTO `sysset` VALUES ('716', 'A033', 'tstjbb', 'compRatio', '比例', '003', '');
INSERT INTO `sysset` VALUES ('717', 'A033', 'tstjbb', 'wclNum', '未处理', '004', '');
INSERT INTO `sysset` VALUES ('718', 'A033', 'tstjbb', 'qetkNum', '全额退款', '005', '');
INSERT INTO `sysset` VALUES ('719', 'A033', 'tstjbb', 'bftkNum', '部分退款', '006', '');
INSERT INTO `sysset` VALUES ('720', 'A033', 'tstjbb', 'thNum', '退货', '007', '');
INSERT INTO `sysset` VALUES ('721', 'A033', 'tstjbb', 'hhNum', '换货', '008', '');
INSERT INTO `sysset` VALUES ('722', 'A033', 'tstjbb', 'cpzsNum', '产品赠送', '009', '');
INSERT INTO `sysset` VALUES ('723', 'A033', 'tstjbb', 'zpzsNum', '赠品赠送', '010', '');
INSERT INTO `sysset` VALUES ('724', 'A033', 'mrckbb', 'cpkh', '产品款号', '001', '');
INSERT INTO `sysset` VALUES ('725', 'A033', 'mrckbb', 'cpmc', '产品名称', '002', '');
INSERT INTO `sysset` VALUES ('726', 'A033', 'mrckbb', 'kw', '库位', '003', '');
INSERT INTO `sysset` VALUES ('727', 'A033', 'mrckbb', 'jhsNum', '进货数', '004', '');
INSERT INTO `sysset` VALUES ('728', 'A033', 'mrckbb', 'chsNum', '出货数', '005', '');
INSERT INTO `sysset` VALUES ('729', 'A033', 'mrckbb', 'zpkc', '正库存', '006', '');
INSERT INTO `sysset` VALUES ('730', 'A033', 'mrckbb', 'cpkc', '次库存', '007', '');
INSERT INTO `sysset` VALUES ('731', 'A033', 'kdjsbb', 'kdgs', '快递公司', '001', '');
INSERT INTO `sysset` VALUES ('732', 'A033', 'kdjsbb', 'fhOrders', '发货数', '002', '');
INSERT INTO `sysset` VALUES ('733', 'A033', 'kdjsbb', 'fhMoney', '发货金额', '003', '');
INSERT INTO `sysset` VALUES ('734', 'A033', 'kdjsbb', 'jsOrders', '拒收数', '004', '');
INSERT INTO `sysset` VALUES ('735', 'A033', 'kdjsbb', 'jsMoney', '拒收金额', '005', '');
INSERT INTO `sysset` VALUES ('736', 'A033', 'kdjsbb', 'jsRatio', '拒收率', '006', '');
INSERT INTO `sysset` VALUES ('737', 'A033', 'kdjsbb', 'qsOrders', '签收数', '007', '');
INSERT INTO `sysset` VALUES ('738', 'A033', 'kdjsbb', 'qsMoney', '签收金额', '008', '');
INSERT INTO `sysset` VALUES ('739', 'A033', 'kdjsbb', 'qsRatio', '签收率', '009', '');
INSERT INTO `sysset` VALUES ('740', 'A033', 'cpxstj', 'cpkh', '产品款号', '001', '');
INSERT INTO `sysset` VALUES ('741', 'A033', 'cpxstj', 'cpmc', '产品名称', '002', '');
INSERT INTO `sysset` VALUES ('742', 'A033', 'cpxstj', 'qrOrders', '确认', '003', '');
INSERT INTO `sysset` VALUES ('743', 'A033', 'cpxstj', 'qrMoney', '确认金额', '004', '');
INSERT INTO `sysset` VALUES ('744', 'A033', 'cpxstj', 'fhOrders', '发货', '005', '');
INSERT INTO `sysset` VALUES ('745', 'A033', 'cpxstj', 'fhMoney', '发货金额', '006', '');
INSERT INTO `sysset` VALUES ('746', 'A033', 'cpxstj', 'shOrders', '收货', '007', '');
INSERT INTO `sysset` VALUES ('747', 'A033', 'cpxstj', 'shMoney', '收货金额', '008', '');
INSERT INTO `sysset` VALUES ('748', 'A033', 'cpxstj', 'gys', '供应商', '009', '');
INSERT INTO `sysset` VALUES ('749', 'A033', 'cpxstj', 'time', '上架时间', '010', '');
INSERT INTO `sysset` VALUES ('750', 'A033', 'thyytj', 'type', '退货原因（大类）', '001', '');
INSERT INTO `sysset` VALUES ('751', 'A033', 'thyytj', 'reason', '退货原因（小类）', '002', '');
INSERT INTO `sysset` VALUES ('752', 'A033', 'thyytj', 'fhOrders', '发货', '003', '');
INSERT INTO `sysset` VALUES ('753', 'A033', 'thyytj', 'fhMoney', '发货金额', '004', '');
INSERT INTO `sysset` VALUES ('754', 'A033', 'thyytj', 'thOrders', '退货', '005', '');
INSERT INTO `sysset` VALUES ('755', 'A033', 'thyytj', 'thMoney', '退货金额', '006', '');
INSERT INTO `sysset` VALUES ('756', 'A033', 'thyytj', 'thRatio', '退货率', '007', '');
INSERT INTO `sysset` VALUES ('757', 'A033', 'thcptj', 'cpfl', '产品类别', '001', '');
INSERT INTO `sysset` VALUES ('758', 'A033', 'thcptj', 'reason', '退货原因（小类）', '002', '');
INSERT INTO `sysset` VALUES ('759', 'A033', 'thcptj', 'thNum', '退换货数', '003', '');
INSERT INTO `sysset` VALUES ('760', 'A033', 'thcptj', 'thMoney', '退换货金额', '004', '');
INSERT INTO `sysset` VALUES ('761', 'A033', 'cplbtjbb', 'cpfl', '产品类别', '001', '');
INSERT INTO `sysset` VALUES ('762', 'A033', 'cplbtjbb', 'xdOrders', '下单', '002', '');
INSERT INTO `sysset` VALUES ('763', 'A033', 'cplbtjbb', 'xdMoney', '下单金额', '003', '');
INSERT INTO `sysset` VALUES ('764', 'A033', 'cplbtjbb', 'qrOrders', '确认', '004', '');
INSERT INTO `sysset` VALUES ('765', 'A033', 'cplbtjbb', 'qrMoney', '确认金额', '005', '');
INSERT INTO `sysset` VALUES ('766', 'A033', 'cplbtjbb', 'fhOrders', '发货', '006', '');
INSERT INTO `sysset` VALUES ('767', 'A033', 'cplbtjbb', 'fhMoney', '发货金额', '007', '');
INSERT INTO `sysset` VALUES ('768', 'A033', 'cplbtjbb', 'qsOrders', '签收', '008', '');
INSERT INTO `sysset` VALUES ('769', 'A033', 'cplbtjbb', 'qsMoney', '签收金额', '009', '');
INSERT INTO `sysset` VALUES ('770', 'A033', 'cplbtjbb', 'jsOrders', '拒收', '010', '');
INSERT INTO `sysset` VALUES ('771', 'A033', 'cplbtjbb', 'jsMoney', '拒收金额', '011', '');
INSERT INTO `sysset` VALUES ('772', 'A033', 'yxtjbb', 'yx', '意向', '001', '');
INSERT INTO `sysset` VALUES ('773', 'A033', 'yxtjbb', 'peopleNum', '客户数', '002', '');
INSERT INTO `sysset` VALUES ('774', 'A033', 'yxtjbb', 'xdOrders', '下单', '003', '');
INSERT INTO `sysset` VALUES ('775', 'A033', 'yxtjbb', 'xdMoney', '下单金额', '004', '');
INSERT INTO `sysset` VALUES ('776', 'A033', 'yxtjbb', 'sdOrders', '审单', '005', '');
INSERT INTO `sysset` VALUES ('777', 'A033', 'yxtjbb', 'sdMoney', '审单金额', '006', '');
INSERT INTO `sysset` VALUES ('778', 'A033', 'yxtjbb', 'fhOrders', '发货', '007', '');
INSERT INTO `sysset` VALUES ('779', 'A033', 'yxtjbb', 'fhMoney', '发货金额', '008', '');
INSERT INTO `sysset` VALUES ('780', 'A033', 'yxtjbb', 'qsOrders', '签收', '009', '');
INSERT INTO `sysset` VALUES ('781', 'A033', 'yxtjbb', 'qsMoney', '签收金额', '010', '');
INSERT INTO `sysset` VALUES ('782', 'A033', 'ghkhstjbb', 'username', '工号', '001', '');
INSERT INTO `sysset` VALUES ('783', 'A033', 'ghkhstjbb', 'personname', '姓名', '002', '');
INSERT INTO `sysset` VALUES ('784', 'A033', 'ghkhstjbb', 'num', '客户总数', '003', '');
INSERT INTO `sysset` VALUES ('785', 'A033', 'ghkhstjbb', 'ratio', '总数', '004', '');
INSERT INTO `sysset` VALUES ('786', 'A033', 'kcydmx', 'cpaa02', '产品名称', '003', 'N');
INSERT INTO `sysset` VALUES ('788', 'A033', 'thgysjl', 'cgaa01', '采购单号', '001', 'N');
INSERT INTO `sysset` VALUES ('789', 'A033', 'thgysjl', 'cgaa09', '供应商', '002', 'N');
INSERT INTO `sysset` VALUES ('790', 'A033', 'thgysjl', 'cgaa16', '退货总数', '003', 'N');
INSERT INTO `sysset` VALUES ('791', 'A033', 'thgysjl', 'cgaa15', '退货总额', '004', 'N');
INSERT INTO `sysset` VALUES ('792', 'A033', 'thgysjl', 'cgaa05', '下单人', '005', 'N');
INSERT INTO `sysset` VALUES ('793', 'A033', 'thgysjl', 'cgaa06', '下单时间', '006', 'N');
INSERT INTO `sysset` VALUES ('794', 'A033', 'thgysjl', 'cgaa17', '退货操作人', '007', 'N');
INSERT INTO `sysset` VALUES ('795', 'A033', 'thgysjl', 'cgaa18', '退货时间', '008', 'N');
INSERT INTO `sysset` VALUES ('796', 'A036', '4', '是', '后', '', '');

-- ----------------------------
-- Table structure for thaa
-- ----------------------------
DROP TABLE IF EXISTS `thaa`;
CREATE TABLE `thaa` (
  `thaa01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `thaa02` varchar(50) DEFAULT '' COMMENT '主叫号码',
  `thaa03` varchar(50) DEFAULT '' COMMENT '被叫号码',
  `thaa04` varchar(30) DEFAULT '' COMMENT '振铃时长',
  `thaa05` varchar(30) DEFAULT '' COMMENT '通话时长',
  `thaa06` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '呼叫时间',
  `thaa07` varchar(100) DEFAULT '' COMMENT '主叫通道',
  `thaa08` varchar(100) DEFAULT '' COMMENT '被叫通道',
  `thaa09` varchar(30) DEFAULT '' COMMENT '呼叫状态',
  `thaa10` varchar(30) DEFAULT '' COMMENT '通话记录的唯一标识',
  `thaa11` varchar(100) DEFAULT '' COMMENT '录音文件名',
  PRIMARY KEY (`thaa01`)
) ENGINE=InnoDB AUTO_INCREMENT=891 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of thaa
-- ----------------------------
INSERT INTO `thaa` VALUES ('276', '8041', '8054', '00:00:03', '00:00:03', '2016-02-04 17:34:39', 'SIP/8041-00007b03', 'SIP/8054-00007b04', 'ANSWERED', '1454578479.31537', '');
INSERT INTO `thaa` VALUES ('277', '8041', '8054', '00:00:05', '00:00:00', '2016-02-04 17:46:55', 'SIP/8041-00007b05', 'SIP/8054-00007b06', 'NO ANSWER', '1454579215.31539', '');
INSERT INTO `thaa` VALUES ('278', '8041', '8054', '00:00:03', '00:00:04', '2016-02-04 17:48:31', 'SIP/8041-00007b07', 'SIP/8054-00007b08', 'ANSWERED', '1454579311.31541', '');
INSERT INTO `thaa` VALUES ('279', '8041', '8054', '00:00:04', '00:00:03', '2016-02-04 17:50:20', 'SIP/8041-00007b09', 'SIP/8054-00007b0a', 'ANSWERED', '1454579420.31543', '');
INSERT INTO `thaa` VALUES ('280', '8041', '8054', '00:00:05', '00:00:02', '2016-02-04 17:51:53', 'SIP/8041-00007b0b', 'SIP/8054-00007b0c', 'ANSWERED', '1454579513.31545', '');
INSERT INTO `thaa` VALUES ('281', '8041', '8054', '00:00:04', '00:00:03', '2016-02-04 18:43:48', 'SIP/8041-00007b0d', 'SIP/8054-00007b0e', 'ANSWERED', '1454582628.31547', '');
INSERT INTO `thaa` VALUES ('282', '8030', '22992471', '00:00:33', '00:00:00', '2016-02-14 10:29:36', 'SIP/8030-00007b1d', 'SIP/trunk231-00007b1e', 'NO ANSWER', '1455416976.31563', '');
INSERT INTO `thaa` VALUES ('283', '8025', '8052', '00:00:08', '00:01:05', '2016-02-14 10:37:24', 'SIP/8025-00007b1f', 'SIP/8052-00007b20', 'ANSWERED', '1455417444.31565', '');
INSERT INTO `thaa` VALUES ('284', '8025', '18666083656', '00:00:09', '00:00:58', '2016-02-14 10:40:27', 'SIP/8025-00007b21', 'SIP/trunk231-00007b22', 'ANSWERED', '1455417627.31567', '');
INSERT INTO `thaa` VALUES ('285', '8025', '23308030', '00:00:04', '00:02:46', '2016-02-14 10:47:17', 'SIP/8025-00007b23', 'SIP/trunk231-00007b24', 'ANSWERED', '1455418037.31569', '');
INSERT INTO `thaa` VALUES ('286', '8025', '8053', '00:00:11', '00:00:29', '2016-02-14 10:50:50', 'SIP/8025-00007b25', 'SIP/8053-00007b26', 'ANSWERED', '1455418250.31571', '');
INSERT INTO `thaa` VALUES ('287', '8000', '18922318990', '00:00:17', '00:00:13', '2016-02-14 11:21:13', 'SIP/8000-00007b27', 'SIP/trunk231-00007b28', 'ANSWERED', '1455420073.31573', '');
INSERT INTO `thaa` VALUES ('288', '8025', '18666083656', '00:00:45', '00:00:52', '2016-02-14 11:25:08', 'SIP/8025-00007b29', 'SIP/trunk231-00007b2a', 'ANSWERED', '1455420308.31575', '');
INSERT INTO `thaa` VALUES ('289', '8000', '38483468', '00:00:10', '00:00:20', '2016-02-14 11:49:15', 'SIP/8000-00007b2b', 'SIP/trunk231-00007b2c', 'ANSWERED', '1455421755.31577', '');
INSERT INTO `thaa` VALUES ('290', '8017', '18602018249', '00:00:12', '00:00:51', '2016-02-14 15:16:19', 'SIP/8017-00007b2d', 'SIP/trunk231-00007b2e', 'ANSWERED', '1455434179.31579', '');
INSERT INTO `thaa` VALUES ('291', '8017', '87324033', '00:00:06', '00:01:51', '2016-02-14 15:18:20', 'SIP/8017-00007b2f', 'SIP/trunk231-00007b30', 'ANSWERED', '1455434300.31581', '');
INSERT INTO `thaa` VALUES ('292', '8017', '18620012160', '00:00:37', '00:00:00', '2016-02-14 15:41:58', 'SIP/8017-00007b31', 'SIP/trunk231-00007b32', 'NO ANSWER', '1455435718.31583', '');
INSERT INTO `thaa` VALUES ('293', '8041', '8054', '00:00:03', '00:00:05', '2016-02-14 16:02:21', 'SIP/8041-00007b33', 'SIP/8054-00007b34', 'ANSWERED', '1455436941.31585', '');
INSERT INTO `thaa` VALUES ('294', '8041', '8054', '00:00:03', '00:00:08', '2016-02-14 16:07:28', 'SIP/8041-00007b35', 'SIP/8054-00007b36', 'ANSWERED', '1455437248.31587', '');
INSERT INTO `thaa` VALUES ('295', '8041', '8054', '00:00:03', '00:00:07', '2016-02-14 16:09:23', 'SIP/8041-00007b37', 'SIP/8054-00007b38', 'ANSWERED', '1455437363.31589', '');
INSERT INTO `thaa` VALUES ('296', '8041', '8054', '00:00:19', '00:00:01', '2016-02-14 16:14:46', 'SIP/8041-00007b39', 'SIP/8054-00007b3a', 'ANSWERED', '1455437686.31591', '');
INSERT INTO `thaa` VALUES ('297', '8041', '8054', '00:00:04', '00:00:08', '2016-02-14 16:15:13', 'SIP/8041-00007b3b', 'SIP/8054-00007b3c', 'ANSWERED', '1455437713.31593', '');
INSERT INTO `thaa` VALUES ('298', '8041', '8054', '00:00:02', '00:00:08', '2016-02-14 16:22:59', 'SIP/8041-00007b3d', 'SIP/8054-00007b3e', 'ANSWERED', '1455438179.31595', '');
INSERT INTO `thaa` VALUES ('299', '8053', '13503040161', '00:00:16', '00:01:34', '2016-02-14 17:31:02', 'SIP/8053-00007b3f', 'SIP/trunk231-00007b40', 'ANSWERED', '1455442262.31597', '');
INSERT INTO `thaa` VALUES ('300', '8003', '18602019573', '00:00:14', '00:03:41', '2016-02-14 17:38:03', 'SIP/8003-00007b41', 'SIP/trunk231-00007b42', 'ANSWERED', '1455442683.31599', '');
INSERT INTO `thaa` VALUES ('301', '8003', '18602019573', '00:00:05', '00:05:37', '2016-02-14 17:44:07', 'SIP/8003-00007b43', 'SIP/trunk231-00007b44', 'ANSWERED', '1455443047.31601', '');
INSERT INTO `thaa` VALUES ('302', '15626028688', '8003', '00:00:21', '00:00:00', '2016-02-15 09:10:30', 'SIP/trunk231-00007b45', 'SIP/8003-00007b46', 'NO ANSWER', '1455498630.31603', '');
INSERT INTO `thaa` VALUES ('303', '8003', '15626028688', '00:00:17', '00:00:13', '2016-02-15 09:24:47', 'SIP/8003-00007b47', 'SIP/trunk231-00007b48', 'ANSWERED', '1455499487.31605', '');
INSERT INTO `thaa` VALUES ('304', '8000', '38483468', '00:00:02', '00:00:16', '2016-02-15 09:32:15', 'SIP/8000-00007b49', 'SIP/trunk231-00007b4a', 'ANSWERED', '1455499935.31607', '');
INSERT INTO `thaa` VALUES ('305', '8000', '38483468', '00:00:07', '00:00:08', '2016-02-15 09:32:40', 'SIP/8000-00007b4b', 'SIP/trunk231-00007b4c', 'ANSWERED', '1455499960.31609', '');
INSERT INTO `thaa` VALUES ('306', '01062305220', '8006', '00:00:01', '00:00:00', '2016-02-15 09:47:20', 'SIP/trunk231-00007b4d', 'SIP/8006-00007b4e', 'NO ANSWER', '1455500840.31611', '');
INSERT INTO `thaa` VALUES ('307', '01062305220', '8009', '00:00:49', '00:00:00', '2016-02-15 09:47:29', 'SIP/trunk231-00007b4f', 'SIP/8009-00007b50', 'NO ANSWER', '1455500849.31613', '');
INSERT INTO `thaa` VALUES ('308', '8030', '22992471', '00:00:28', '00:00:00', '2016-02-15 09:56:59', 'SIP/8030-00007b55', 'SIP/trunk231-00007b56', 'NO ANSWER', '1455501419.31619', '');
INSERT INTO `thaa` VALUES ('309', '18620014090', '8052', '00:00:08', '00:01:57', '2016-02-15 09:55:58', 'SIP/trunk231-00007b53', 'SIP/8052-00007b54', 'ANSWERED', '1455501358.31617', '');
INSERT INTO `thaa` VALUES ('310', '8030', '18620018801', '00:00:12', '00:00:42', '2016-02-15 09:57:36', 'SIP/8030-00007b57', 'SIP/trunk231-00007b58', 'ANSWERED', '1455501456.31621', '');
INSERT INTO `thaa` VALUES ('311', '8020', '18602044827', '00:00:15', '00:08:03', '2016-02-15 09:50:55', 'SIP/8020-00007b51', 'SIP/trunk231-00007b52', 'ANSWERED', '1455501055.31615', '');
INSERT INTO `thaa` VALUES ('312', '8020', '22310010', '00:00:04', '00:03:26', '2016-02-15 10:01:19', 'SIP/8020-00007b59', 'SIP/trunk231-00007b5a', 'ANSWERED', '1455501679.31623', '');
INSERT INTO `thaa` VALUES ('313', '8020', '8053', '00:00:11', '00:00:34', '2016-02-15 10:04:56', 'SIP/8020-00007b5b', 'SIP/8053-00007b5c', 'ANSWERED', '1455501896.31625', '');
INSERT INTO `thaa` VALUES ('314', '8020', '22310010', '00:00:04', '00:00:53', '2016-02-15 10:11:23', 'SIP/8020-00007b5d', 'SIP/trunk231-00007b5e', 'ANSWERED', '1455502283.31627', '');
INSERT INTO `thaa` VALUES ('315', '8020', '18664603601', '00:00:04', '00:00:20', '2016-02-15 10:12:42', 'SIP/8020-00007b5f', 'SIP/trunk231-00007b60', 'ANSWERED', '1455502362.31629', '');
INSERT INTO `thaa` VALUES ('316', '8003', '8041', '00:00:05', '00:00:10', '2016-02-15 10:18:41', 'SIP/8003-00007b61', 'SIP/8041-00007b62', 'ANSWERED', '1455502721.31631', '');
INSERT INTO `thaa` VALUES ('317', '18664603601', '8020', '00:00:04', '00:00:36', '2016-02-15 10:42:27', 'SIP/trunk231-00007b63', 'SIP/8020-00007b64', 'ANSWERED', '1455504147.31633', '');
INSERT INTO `thaa` VALUES ('318', '075788330113', '8003', '00:00:06', '00:00:18', '2016-02-15 10:45:54', 'SIP/trunk231-00007b65', 'SIP/8003-00007b66', 'ANSWERED', '1455504354.31635', '');
INSERT INTO `thaa` VALUES ('319', '8020', '18620012027', '00:00:07', '00:01:22', '2016-02-15 10:58:34', 'SIP/8020-00007b67', 'SIP/trunk231-00007b68', 'ANSWERED', '1455505114.31637', '');
INSERT INTO `thaa` VALUES ('320', '8030', '22992471', '00:00:21', '00:00:00', '2016-02-15 11:02:33', 'SIP/8030-00007b6b', 'SIP/trunk231-00007b6c', 'NO ANSWER', '1455505353.31641', '');
INSERT INTO `thaa` VALUES ('321', '8020', '18620015126', '00:00:10', '00:03:37', '2016-02-15 11:00:47', 'SIP/8020-00007b69', 'SIP/trunk231-00007b6a', 'ANSWERED', '1455505247.31639', '');
INSERT INTO `thaa` VALUES ('322', '8020', '13570493629', '00:00:20', '00:01:16', '2016-02-15 11:04:50', 'SIP/8020-00007b6d', 'SIP/trunk231-00007b6e', 'ANSWERED', '1455505490.31643', '');
INSERT INTO `thaa` VALUES ('323', '22836085', '8020', '00:00:24', '00:00:00', '2016-02-15 11:08:50', 'SIP/trunk231-00007b6f', 'SIP/8020-00007b70', 'NO ANSWER', '1455505730.31645', '');
INSERT INTO `thaa` VALUES ('324', '22992471', '8030', '00:00:08', '00:05:39', '2016-02-15 11:12:40', 'SIP/trunk231-00007b71', 'SIP/8030-00007b72', 'ANSWERED', '1455505960.31647', '');
INSERT INTO `thaa` VALUES ('325', '22992471', '8030', '00:00:06', '00:01:08', '2016-02-15 11:19:02', 'SIP/trunk231-00007b73', 'SIP/8030-00007b74', 'ANSWERED', '1455506342.31649', '');
INSERT INTO `thaa` VALUES ('326', '8030', '38813593', '00:00:15', '00:02:21', '2016-02-15 11:22:09', 'SIP/8030-00007b75', 'SIP/trunk231-00007b76', 'ANSWERED', '1455506529.31651', '');
INSERT INTO `thaa` VALUES ('327', '8020', '18620018919', '00:00:12', '00:04:52', '2016-02-15 11:32:07', 'SIP/8020-00007b77', 'SIP/trunk231-00007b78', 'ANSWERED', '1455507127.31653', '');
INSERT INTO `thaa` VALUES ('328', '8020', '18680287765', '00:00:05', '00:01:01', '2016-02-15 11:37:20', 'SIP/8020-00007b79', 'SIP/trunk231-00007b7a', 'ANSWERED', '1455507440.31655', '');
INSERT INTO `thaa` VALUES ('329', '8020', '18602044827', '00:00:55', '00:00:00', '2016-02-15 11:39:32', 'SIP/8020-00007b7b', 'SIP/trunk231-00007b7c', 'NO ANSWER', '1455507572.31657', '');
INSERT INTO `thaa` VALUES ('330', '8017', '22310010', '00:00:04', '00:02:54', '2016-02-15 11:49:04', 'SIP/8017-00007b7d', 'SIP/trunk231-00007b7e', 'ANSWERED', '1455508144.31659', '');
INSERT INTO `thaa` VALUES ('331', '8017', '22383735', '00:00:03', '00:00:56', '2016-02-15 11:53:00', 'SIP/8017-00007b7f', 'SIP/trunk231-00007b80', 'ANSWERED', '1455508380.31661', '');
INSERT INTO `thaa` VALUES ('332', '8017', '018621667239', '00:00:10', '00:03:36', '2016-02-15 11:54:10', 'SIP/8017-00007b81', 'SIP/trunk231-00007b82', 'ANSWERED', '1455508450.31663', '');
INSERT INTO `thaa` VALUES ('333', '8000', '38483468', '00:00:06', '00:00:15', '2016-02-15 13:44:08', 'SIP/8000-00007b83', 'SIP/trunk231-00007b84', 'ANSWERED', '1455515048.31665', '');
INSERT INTO `thaa` VALUES ('334', '15626028688', '8003', '00:00:11', '00:00:17', '2016-02-15 14:05:08', 'SIP/trunk231-00007b85', 'SIP/8003-00007b86', 'ANSWERED', '1455516308.31667', '');
INSERT INTO `thaa` VALUES ('335', '8000', '83380923', '00:00:07', '00:03:54', '2016-02-15 14:13:28', 'SIP/8000-00007b87', 'SIP/trunk231-00007b88', 'ANSWERED', '1455516808.31669', '');
INSERT INTO `thaa` VALUES ('336', '8018', '18620012822', '00:00:19', '00:00:00', '2016-02-15 14:19:49', 'SIP/8018-00007b89', 'SIP/trunk231-00007b8a', 'NO ANSWER', '1455517189.31671', '');
INSERT INTO `thaa` VALUES ('337', '8010', '18620018618', '00:00:17', '00:00:26', '2016-02-15 14:32:21', 'SIP/8010-00007b8b', 'SIP/trunk231-00007b8c', 'ANSWERED', '1455517941.31673', '');
INSERT INTO `thaa` VALUES ('338', '8018', '18620012822', '00:00:11', '00:01:26', '2016-02-15 14:46:03', 'SIP/8018-00007b8d', 'SIP/trunk231-00007b8e', 'ANSWERED', '1455518763.31675', '');
INSERT INTO `thaa` VALUES ('339', '8018', '18620018975', '00:00:10', '00:00:05', '2016-02-15 14:56:56', 'SIP/8018-00007b8f', 'SIP/trunk231-00007b90', 'ANSWERED', '1455519416.31677', '');
INSERT INTO `thaa` VALUES ('340', '8018', '18620018975', '00:00:07', '00:01:05', '2016-02-15 14:57:17', 'SIP/8018-00007b91', 'SIP/trunk231-00007b92', 'ANSWERED', '1455519437.31679', '');
INSERT INTO `thaa` VALUES ('341', '8018', '18620014905', '00:00:11', '00:00:58', '2016-02-15 14:59:44', 'SIP/8018-00007b93', 'SIP/trunk231-00007b94', 'ANSWERED', '1455519584.31681', '');
INSERT INTO `thaa` VALUES ('342', '8018', '18620014085', '00:00:46', '00:00:53', '2016-02-15 15:01:01', 'SIP/8018-00007b95', 'SIP/trunk231-00007b96', 'ANSWERED', '1455519661.31683', '');
INSERT INTO `thaa` VALUES ('343', '8052', '18620013493', '00:00:34', '00:00:00', '2016-02-15 15:12:47', 'SIP/8052-00007b97', 'SIP/trunk231-00007b98', 'NO ANSWER', '1455520367.31685', '');
INSERT INTO `thaa` VALUES ('344', '8032', '18620012234', '00:00:12', '00:02:53', '2016-02-15 15:13:25', 'SIP/8032-00007b99', 'SIP/trunk231-00007b9a', 'ANSWERED', '1455520405.31687', '');
INSERT INTO `thaa` VALUES ('345', '8032', '13535587927', '00:00:35', '00:00:00', '2016-02-15 15:17:53', 'SIP/8032-00007b9b', 'SIP/trunk231-00007b9c', 'NO ANSWER', '1455520673.31689', '');
INSERT INTO `thaa` VALUES ('346', '8032', '29118081', '00:00:14', '00:04:34', '2016-02-15 15:22:21', 'SIP/8032-00007b9d', 'SIP/trunk231-00007b9e', 'ANSWERED', '1455520941.31691', '');
INSERT INTO `thaa` VALUES ('347', '29118035', '8032', '00:00:05', '00:02:10', '2016-02-15 15:45:25', 'SIP/trunk231-00007b9f', 'SIP/8032-00007ba0', 'ANSWERED', '1455522325.31693', '');
INSERT INTO `thaa` VALUES ('348', '8041', '8054', '00:00:03', '00:00:06', '2016-02-15 16:09:02', 'SIP/8041-00007ba1', 'SIP/8054-00007ba2', 'ANSWERED', '1455523742.31695', '');
INSERT INTO `thaa` VALUES ('349', '8020', '15626028688', '00:00:12', '00:00:11', '2016-02-15 16:16:36', 'SIP/8020-00007ba3', 'SIP/trunk231-00007ba4', 'ANSWERED', '1455524196.31697', '');
INSERT INTO `thaa` VALUES ('350', '18620013493', '8052', '00:00:10', '00:00:26', '2016-02-15 16:23:02', 'SIP/trunk231-00007ba5', 'SIP/8052-00007ba6', 'ANSWERED', '1455524582.31699', '');
INSERT INTO `thaa` VALUES ('351', '8041', '13521451253', '00:00:13', '00:00:00', '2016-02-15 17:14:02', 'SIP/8041-00007ba7', 'SIP/trunk231-00007ba8', 'NO ANSWER', '1455527642.31701', '');
INSERT INTO `thaa` VALUES ('352', '8003', '38081659', '00:00:15', '00:05:41', '2016-02-15 17:24:47', 'SIP/8003-00007ba9', 'SIP/trunk231-00007baa', 'ANSWERED', '1455528287.31703', '');
INSERT INTO `thaa` VALUES ('353', '8006', '13162622001', '00:00:05', '00:00:00', '2016-02-16 15:15:40', 'SIP/8006-00007c0f', 'SIP/trunk231-00007c10', 'NO ANSWER', '1455606940.31805', '');
INSERT INTO `thaa` VALUES ('354', '8006', '013162622001', '00:00:55', '00:00:00', '2016-02-16 15:15:56', 'SIP/8006-00007c11', 'SIP/trunk231-00007c12', 'NO ANSWER', '1455606956.31807', '');
INSERT INTO `thaa` VALUES ('355', '8009', '15989037918', '00:00:19', '00:02:41', '2016-02-16 15:14:43', 'SIP/8009-00007c0d', 'SIP/trunk231-00007c0e', 'ANSWERED', '1455606883.31803', '');
INSERT INTO `thaa` VALUES ('356', '8006', '15914834678', '00:00:05', '00:00:00', '2016-02-16 15:18:06', 'SIP/8006-00007c13', 'SIP/trunk231-00007c14', 'NO ANSWER', '1455607086.31809', '');
INSERT INTO `thaa` VALUES ('357', '8006', '015914834678', '00:00:18', '00:00:43', '2016-02-16 15:18:22', 'SIP/8006-00007c15', 'SIP/trunk231-00007c16', 'ANSWERED', '1455607102.31811', '');
INSERT INTO `thaa` VALUES ('358', '8023', '18602011060', '00:00:06', '00:00:00', '2016-02-16 17:28:36', 'SIP/8023-00007c55', 'SIP/trunk231-00007c56', 'NO ANSWER', '1455614916.31875', '');
INSERT INTO `thaa` VALUES ('359', '8050', '8009', '00:00:01', '00:00:00', '2016-02-16 17:32:36', 'SIP/8050-00007c59', 'SIP/8009-00007c5a', 'NO ANSWER', '1455615155.31879', '');
INSERT INTO `thaa` VALUES ('360', '8020', '18620290813', '00:00:09', '00:00:49', '2016-02-16 18:16:27', 'SIP/8020-00007c5b', 'SIP/trunk231-00007c5c', 'ANSWERED', '1455617787.31881', '');
INSERT INTO `thaa` VALUES ('361', '8041', '8054', '00:00:05', '00:00:08', '2016-02-16 19:24:18', 'SIP/8041-00007c5d', 'SIP/8054-00007c5e', 'ANSWERED', '1455621858.31883', '');
INSERT INTO `thaa` VALUES ('362', '8041', '8054', '00:00:06', '00:00:11', '2016-02-16 19:24:43', 'SIP/8041-00007c5f', 'SIP/8054-00007c60', 'ANSWERED', '1455621883.31885', '');
INSERT INTO `thaa` VALUES ('363', '8041', '8054', '00:00:05', '00:00:07', '2016-02-16 19:25:43', 'SIP/8041-00007c61', 'SIP/8054-00007c62', 'ANSWERED', '1455621943.31887', '');
INSERT INTO `thaa` VALUES ('364', '8041', '8054', '00:00:05', '00:00:08', '2016-02-16 19:26:36', 'SIP/8041-00007c63', 'SIP/8054-00007c64', 'ANSWERED', '1455621996.31889', '');
INSERT INTO `thaa` VALUES ('365', '8041', '8054', '00:00:06', '00:00:13', '2016-02-16 19:27:05', 'SIP/8041-00007c65', 'SIP/8054-00007c66', 'ANSWERED', '1455622025.31891', '');
INSERT INTO `thaa` VALUES ('366', '8041', '13527743279', '00:00:09', '00:00:09', '2016-02-16 19:30:43', 'SIP/8041-00007c67', 'SIP/trunk231-00007c68', 'ANSWERED', '1455622243.31893', '');
INSERT INTO `thaa` VALUES ('367', '8054', '13527743279', '00:00:11', '00:00:09', '2016-02-16 19:31:19', 'SIP/8054-00007c69', 'SIP/trunk231-00007c6a', 'ANSWERED', '1455622279.31895', '');
INSERT INTO `thaa` VALUES ('368', '13527743279', '8041', '00:00:11', '00:00:07', '2016-02-16 19:32:11', 'SIP/trunk231-00007c6b', 'SIP/8041-00007c6c', 'ANSWERED', '1455622331.31897', '');
INSERT INTO `thaa` VALUES ('369', '8041', '13527743279', '00:00:11', '00:00:18', '2016-02-16 19:35:37', 'SIP/8041-00007c6d', 'SIP/trunk231-00007c6e', 'ANSWERED', '1455622537.31899', '');
INSERT INTO `thaa` VALUES ('370', '8041', '8054', '00:00:03', '00:00:08', '2016-02-16 19:36:18', 'SIP/8041-00007c6f', 'SIP/8054-00007c70', 'ANSWERED', '1455622578.31901', '');
INSERT INTO `thaa` VALUES ('371', '8041', '8054', '00:00:05', '00:00:08', '2016-02-16 19:38:58', 'SIP/8041-00007c71', 'SIP/8054-00007c72', 'ANSWERED', '1455622738.31903', '');
INSERT INTO `thaa` VALUES ('372', '8041', '8054', '00:00:05', '00:00:07', '2016-02-16 19:54:08', 'SIP/8041-00007c73', 'SIP/8054-00007c74', 'ANSWERED', '1455623648.31905', '');
INSERT INTO `thaa` VALUES ('373', '32221100', '8053', '00:00:38', '00:00:00', '2016-02-17 08:35:56', 'SIP/trunk231-00007c75', 'SIP/8053-00007c76', 'NO ANSWER', '1455669356.31907', '');
INSERT INTO `thaa` VALUES ('374', '8028', '13312898236', '00:00:07', '00:00:00', '2016-02-17 08:38:32', 'SIP/8028-00007c77', 'SIP/trunk231-00007c78', 'NO ANSWER', '1455669512.31909', '');
INSERT INTO `thaa` VALUES ('375', '8000', '38483468', '00:00:02', '00:00:31', '2016-02-17 08:56:05', 'SIP/8000-00007c79', 'SIP/trunk231-00007c7a', 'ANSWERED', '1455670565.31911', '');
INSERT INTO `thaa` VALUES ('376', '8000', '38483468', '00:00:02', '00:00:30', '2016-02-17 08:56:47', 'SIP/8000-00007c7b', 'SIP/trunk231-00007c7c', 'ANSWERED', '1455670607.31913', '');
INSERT INTO `thaa` VALUES ('377', '8000', '38483468', '00:00:02', '00:00:16', '2016-02-17 08:57:13', 'SIP/8000-00007c7d', 'SIP/trunk231-00007c7e', 'ANSWERED', '1455670633.31915', '');
INSERT INTO `thaa` VALUES ('378', '8020', '8050', '00:00:02', '00:01:05', '2016-02-17 09:12:22', 'SIP/8020-00007c7f', 'SIP/8050-00007c80', 'ANSWERED', '1455671542.31917', '');
INSERT INTO `thaa` VALUES ('379', '8020', '18620018919', '00:00:55', '00:00:00', '2016-02-17 09:14:39', 'SIP/8020-00007c81', 'SIP/trunk231-00007c82', 'NO ANSWER', '1455671679.31919', '');
INSERT INTO `thaa` VALUES ('380', '8030', '22992471', '00:00:32', '00:00:00', '2016-02-17 09:26:29', 'SIP/8030-00007c83', 'SIP/trunk231-00007c84', 'NO ANSWER', '1455672389.31921', '');
INSERT INTO `thaa` VALUES ('381', '8030', '18620018801', '00:00:17', '00:00:41', '2016-02-17 09:27:09', 'SIP/8030-00007c85', 'SIP/trunk231-00007c86', 'ANSWERED', '1455672429.31923', '');
INSERT INTO `thaa` VALUES ('382', '22992471', '8030', '00:00:15', '00:06:15', '2016-02-17 09:29:54', 'SIP/trunk231-00007c87', 'SIP/8030-00007c88', 'ANSWERED', '1455672594.31925', '');
INSERT INTO `thaa` VALUES ('383', '8018', '18620014905', '00:00:11', '00:00:48', '2016-02-17 09:30:56', 'SIP/8018-00007c89', 'SIP/trunk231-00007c8a', 'ANSWERED', '1455672656.31927', '');
INSERT INTO `thaa` VALUES ('384', '8020', '13512754336', '00:00:12', '00:01:10', '2016-02-17 09:39:09', 'SIP/8020-00007c8b', 'SIP/trunk231-00007c8c', 'ANSWERED', '1455673149.31929', '');
INSERT INTO `thaa` VALUES ('385', '22312030', '8052', '00:00:09', '00:00:17', '2016-02-17 09:48:56', 'SIP/trunk231-00007c8d', 'SIP/8052-00007c8e', 'ANSWERED', '1455673736.31931', '');
INSERT INTO `thaa` VALUES ('386', '8052', '18620012015', '00:00:42', '00:00:31', '2016-02-17 09:50:54', 'SIP/8052-00007c8f', 'SIP/trunk231-00007c90', 'ANSWERED', '1455673854.31933', '');
INSERT INTO `thaa` VALUES ('387', '8052', '18620013102', '00:00:36', '00:00:00', '2016-02-17 09:53:07', 'SIP/8052-00007c91', 'SIP/trunk231-00007c92', 'NO ANSWER', '1455673987.31935', '');
INSERT INTO `thaa` VALUES ('388', '8052', '18620014561', '00:00:11', '00:00:47', '2016-02-17 09:55:13', 'SIP/8052-00007c93', 'SIP/trunk231-00007c94', 'ANSWERED', '1455674113.31937', '');
INSERT INTO `thaa` VALUES ('389', '15622318940', '8006', '00:00:05', '00:00:37', '2016-02-17 09:55:43', 'SIP/trunk231-00007c95', 'SIP/8006-00007c96', 'ANSWERED', '1455674143.31939', '');
INSERT INTO `thaa` VALUES ('390', '23384012', '8003', '00:00:38', '00:01:05', '2016-02-17 10:01:55', 'SIP/trunk231-00007c97', 'SIP/8003-00007c98', 'ANSWERED', '1455674515.31941', '');
INSERT INTO `thaa` VALUES ('391', '8052', '18620013102', '00:00:14', '00:01:39', '2016-02-17 10:16:19', 'SIP/8052-00007c99', 'SIP/trunk231-00007c9a', 'ANSWERED', '1455675379.31943', '');
INSERT INTO `thaa` VALUES ('392', '8053', '32221145', '00:00:20', '00:00:35', '2016-02-17 10:27:13', 'SIP/8053-00007c9b', 'SIP/trunk231-00007c9c', 'ANSWERED', '1455676033.31945', '');
INSERT INTO `thaa` VALUES ('393', '8053', '4006631111', '00:00:04', '00:02:57', '2016-02-17 10:30:36', 'SIP/8053-00007c9d', 'SIP/trunk231-00007c9e', 'ANSWERED', '1455676236.31947', '');
INSERT INTO `thaa` VALUES ('394', '8053', '82700468', '00:00:09', '00:04:46', '2016-02-17 10:33:48', 'SIP/8053-00007c9f', 'SIP/trunk231-00007ca0', 'ANSWERED', '1455676428.31949', '');
INSERT INTO `thaa` VALUES ('395', '8053', '18620013281', '00:00:09', '00:00:00', '2016-02-17 10:41:45', 'SIP/8053-00007ca1', 'SIP/trunk231-00007ca2', 'NO ANSWER', '1455676905.31951', '');
INSERT INTO `thaa` VALUES ('396', '8001', '8088', '00:00:08', '00:00:25', '2016-02-17 11:02:08', 'SIP/8001-00007ca3', 'SIP/8088-00007ca4', 'ANSWERED', '1455678128.31953', '');
INSERT INTO `thaa` VALUES ('397', '8053', '18620013281', '00:00:10', '00:03:58', '2016-02-17 11:19:43', 'SIP/8053-00007ca5', 'SIP/trunk231-00007ca6', 'ANSWERED', '1455679183.31955', '');
INSERT INTO `thaa` VALUES ('398', '8053', '13503040161', '00:00:18', '00:09:54', '2016-02-17 11:30:05', 'SIP/8053-00007ca7', 'SIP/trunk231-00007ca8', 'ANSWERED', '1455679805.31957', '');
INSERT INTO `thaa` VALUES ('399', '8006', '017768966366', '00:00:55', '00:00:00', '2016-02-17 11:38:54', 'SIP/8006-00007ca9', 'SIP/trunk231-00007caa', 'NO ANSWER', '1455680334.31959', '');
INSERT INTO `thaa` VALUES ('400', '8003', '85517766', '00:00:13', '00:00:39', '2016-02-17 11:39:23', 'SIP/8003-00007cab', 'SIP/trunk231-00007cac', 'ANSWERED', '1455680363.31961', '');
INSERT INTO `thaa` VALUES ('401', '8006', '017768966366', '00:00:15', '00:00:00', '2016-02-17 11:40:00', 'SIP/8006-00007cad', 'SIP/trunk231-00007cae', 'NO ANSWER', '1455680400.31963', '');
INSERT INTO `thaa` VALUES ('402', '8006', '015152698841', '00:00:19', '00:02:44', '2016-02-17 11:40:25', 'SIP/8006-00007caf', 'SIP/trunk231-00007cb0', 'ANSWERED', '1455680425.31965', '');
INSERT INTO `thaa` VALUES ('403', '23384184', '8056', '00:00:04', '00:00:23', '2016-02-17 11:43:24', 'SIP/trunk231-00007cb1', 'SIP/8056-00007cb2', 'ANSWERED', '1455680604.31967', '');
INSERT INTO `thaa` VALUES ('404', '23384164', '8006', '00:00:05', '00:00:37', '2016-02-17 11:43:59', 'SIP/trunk231-00007cb3', 'SIP/8006-00007cb4', 'ANSWERED', '1455680639.31969', '');
INSERT INTO `thaa` VALUES ('405', '17768966366', '8006', '00:00:06', '00:03:40', '2016-02-17 11:48:57', 'SIP/trunk231-00007cb5', 'SIP/8006-00007cb6', 'ANSWERED', '1455680937.31971', '');
INSERT INTO `thaa` VALUES ('406', '17768966366', '8006', '00:00:07', '00:03:52', '2016-02-17 12:43:11', 'SIP/trunk231-00007cb7', 'SIP/8006-00007cb8', 'ANSWERED', '1455684191.31973', '');
INSERT INTO `thaa` VALUES ('407', '8003', '8000', '00:00:02', '00:00:34', '2016-02-17 13:50:47', 'SIP/8003-00007cb9', 'SIP/8000-00007cba', 'ANSWERED', '1455688247.31975', '');
INSERT INTO `thaa` VALUES ('408', '8088', '8003', '00:00:05', '00:00:27', '2016-02-17 13:51:35', 'SIP/8088-00007cbb', 'SIP/8003-00007cbc', 'ANSWERED', '1455688295.31977', '');
INSERT INTO `thaa` VALUES ('409', '8006', '13544468691', '00:00:16', '00:00:37', '2016-02-17 14:12:43', 'SIP/8006-00007cbd', 'SIP/trunk231-00007cbe', 'ANSWERED', '1455689563.31979', '');
INSERT INTO `thaa` VALUES ('410', '13602403583', '8006', '00:00:07', '00:00:54', '2016-02-17 14:22:46', 'SIP/trunk231-00007cbf', 'SIP/8006-00007cc0', 'ANSWERED', '1455690166.31981', '');
INSERT INTO `thaa` VALUES ('411', '8006', '13602403583', '00:00:08', '00:00:48', '2016-02-17 14:24:21', 'SIP/8006-00007cc1', 'SIP/trunk231-00007cc2', 'ANSWERED', '1455690261.31983', '');
INSERT INTO `thaa` VALUES ('412', '13602403583', '8006', '00:00:05', '00:00:19', '2016-02-17 14:25:49', 'SIP/trunk231-00007cc3', 'SIP/8006-00007cc4', 'ANSWERED', '1455690349.31985', '');
INSERT INTO `thaa` VALUES ('413', '8030', '22992471', '00:00:10', '00:00:13', '2016-02-17 14:31:49', 'SIP/8030-00007cc5', 'SIP/trunk231-00007cc6', 'ANSWERED', '1455690709.31987', '');
INSERT INTO `thaa` VALUES ('414', '8053', '13710998102', '00:00:17', '00:00:00', '2016-02-17 14:34:19', 'SIP/8053-00007cc7', 'SIP/trunk231-00007cc8', 'NO ANSWER', '1455690859.31989', '');
INSERT INTO `thaa` VALUES ('415', '8053', '13710998102', '00:00:09', '00:00:00', '2016-02-17 14:34:44', 'SIP/8053-00007cc9', 'SIP/trunk231-00007cca', 'NO ANSWER', '1455690884.31991', '');
INSERT INTO `thaa` VALUES ('416', '8058', '075788330113', '00:00:40', '00:00:00', '2016-02-17 14:35:47', 'SIP/8058-00007ccb', 'SIP/trunk231-00007ccc', 'NO ANSWER', '1455690947.31993', '');
INSERT INTO `thaa` VALUES ('417', '8053', '13710998102', '00:00:35', '00:00:00', '2016-02-17 14:36:52', 'SIP/8053-00007ccd', 'SIP/trunk231-00007cce', 'NO ANSWER', '1455691012.31995', '');
INSERT INTO `thaa` VALUES ('418', '8058', '18575741379', '00:00:06', '00:00:00', '2016-02-17 14:37:12', 'SIP/8058-00007ccf', 'SIP/trunk231-00007cd0', 'NO ANSWER', '1455691032.31997', '');
INSERT INTO `thaa` VALUES ('419', '8058', '018575741379', '00:00:23', '00:03:30', '2016-02-17 14:37:29', 'SIP/8058-00007cd1', 'SIP/trunk231-00007cd2', 'ANSWERED', '1455691049.31999', '');
INSERT INTO `thaa` VALUES ('420', '8023', '18665654562', '00:00:11', '00:01:42', '2016-02-17 14:46:42', 'SIP/8023-00007cd3', 'SIP/trunk231-00007cd4', 'ANSWERED', '1455691602.32001', '');
INSERT INTO `thaa` VALUES ('421', '8023', '18620282609', '00:00:54', '00:00:39', '2016-02-17 14:49:38', 'SIP/8023-00007cd5', 'SIP/trunk231-00007cd6', 'ANSWERED', '1455691778.32003', '');
INSERT INTO `thaa` VALUES ('422', '13602403583', '8006', '00:00:55', '00:00:00', '2016-02-17 14:50:33', 'SIP/trunk231-00007cd7', 'SIP/8006-00007cd8', 'FAILED', '1455691833.32005', '');
INSERT INTO `thaa` VALUES ('423', '13602403583', '8006', '00:00:45', '00:00:00', '2016-02-17 14:52:13', 'SIP/trunk231-00007cd9', 'SIP/8006-00007cda', 'NO ANSWER', '1455691933.32007', '');
INSERT INTO `thaa` VALUES ('424', '13602403583', '8006', '00:00:49', '00:00:00', '2016-02-17 14:55:17', 'SIP/trunk231-00007cdb', 'SIP/8006-00007cdc', 'NO ANSWER', '1455692117.32009', '');
INSERT INTO `thaa` VALUES ('425', '13602403583', '8006', '00:00:55', '00:00:00', '2016-02-17 14:56:57', 'SIP/trunk231-00007cdd', 'SIP/8006-00007cde', 'FAILED', '1455692217.32011', '');
INSERT INTO `thaa` VALUES ('426', '13602403583', '8006', '00:00:55', '00:00:00', '2016-02-17 15:00:40', 'SIP/trunk231-00007cdf', 'SIP/8006-00007ce0', 'FAILED', '1455692440.32013', '');
INSERT INTO `thaa` VALUES ('427', '8041', '8054', '00:00:05', '00:00:08', '2016-02-17 15:03:58', 'SIP/8041-00007ce1', 'SIP/8054-00007ce2', 'ANSWERED', '1455692638.32015', '');
INSERT INTO `thaa` VALUES ('428', '13602403583', '8006', '00:00:55', '00:00:00', '2016-02-17 15:04:13', 'SIP/trunk231-00007ce3', 'SIP/8006-00007ce4', 'FAILED', '1455692653.32017', '');
INSERT INTO `thaa` VALUES ('429', '8041', '8054', '00:00:03', '00:00:06', '2016-02-17 15:04:23', 'SIP/8041-00007ce5', 'SIP/8054-00007ce6', 'ANSWERED', '1455692663.32019', '');
INSERT INTO `thaa` VALUES ('430', '8006', '13602403583', '00:00:16', '00:00:34', '2016-02-17 15:05:29', 'SIP/8006-00007ce7', 'SIP/trunk231-00007ce8', 'ANSWERED', '1455692729.32021', '');
INSERT INTO `thaa` VALUES ('431', '18520261312', '8006', '00:00:00', '00:00:00', '2016-02-17 15:05:35', 'SIP/trunk231-00007ce9', '', 'BUSY', '1455692735.32023', '');
INSERT INTO `thaa` VALUES ('432', '18520261312', '8006', '00:00:00', '00:00:00', '2016-02-17 15:05:44', 'SIP/trunk231-00007cea', '', 'BUSY', '1455692744.32024', '');
INSERT INTO `thaa` VALUES ('433', '18520261312', '8006', '00:00:00', '00:00:00', '2016-02-17 15:05:52', 'SIP/trunk231-00007ceb', '', 'BUSY', '1455692752.32025', '');
INSERT INTO `thaa` VALUES ('434', '18520261312', '8006', '00:00:00', '00:00:00', '2016-02-17 15:06:01', 'SIP/trunk231-00007cec', '', 'BUSY', '1455692761.32026', '');
INSERT INTO `thaa` VALUES ('435', '38190645', '8003', '00:00:11', '00:04:10', '2016-02-17 15:25:21', 'SIP/trunk231-00007ced', 'SIP/8003-00007cee', 'ANSWERED', '1455693921.32027', '');
INSERT INTO `thaa` VALUES ('436', '13602403583', '8006', '00:00:48', '00:00:00', '2016-02-17 15:38:14', 'SIP/trunk231-00007cef', 'SIP/8006-00007cf0', 'NO ANSWER', '1455694694.32029', '');
INSERT INTO `thaa` VALUES ('437', '8006', '13826492319', '00:00:24', '00:01:17', '2016-02-17 15:47:32', 'SIP/8006-00007cf1', 'SIP/trunk231-00007cf2', 'ANSWERED', '1455695252.32031', '');
INSERT INTO `thaa` VALUES ('438', '8006', '15626069254', '00:00:55', '00:00:00', '2016-02-17 15:50:57', 'SIP/8006-00007cf3', 'SIP/trunk231-00007cf4', 'NO ANSWER', '1455695457.32033', '');
INSERT INTO `thaa` VALUES ('439', '8006', '18680518879', '00:00:20', '00:00:37', '2016-02-17 15:52:03', 'SIP/8006-00007cf5', 'SIP/trunk231-00007cf6', 'ANSWERED', '1455695523.32035', '');
INSERT INTO `thaa` VALUES ('440', '8006', '15626100696', '00:00:08', '00:00:54', '2016-02-17 15:54:21', 'SIP/8006-00007cf7', 'SIP/trunk231-00007cf8', 'ANSWERED', '1455695661.32037', '');
INSERT INTO `thaa` VALUES ('441', '8006', '1375213701', '00:00:00', '00:00:00', '2016-02-17 15:56:33', 'SIP/8006-00007cf9', 'SIP/trunk231-00007cfa', 'FAILED', '1455695793.32039', '');
INSERT INTO `thaa` VALUES ('442', '8006', '1307521701', '00:00:00', '00:00:00', '2016-02-17 15:56:48', 'SIP/8006-00007cfb', 'SIP/trunk231-00007cfc', 'FAILED', '1455695808.32041', '');
INSERT INTO `thaa` VALUES ('443', '8006', '1307513701', '00:00:00', '00:00:00', '2016-02-17 15:57:06', 'SIP/8006-00007cfd', 'SIP/trunk231-00007cfe', 'FAILED', '1455695826.32043', '');
INSERT INTO `thaa` VALUES ('444', '13602403583', '8006', '00:00:07', '00:00:33', '2016-02-17 15:59:12', 'SIP/trunk231-00007cff', 'SIP/8006-00007d00', 'ANSWERED', '1455695952.32045', '');
INSERT INTO `thaa` VALUES ('445', '8006', '17098', '00:00:00', '00:00:00', '2016-02-17 16:17:41', 'SIP/8006-00007d01', 'SIP/trunk231-00007d02', 'NO ANSWER', '1455697061.32047', '');
INSERT INTO `thaa` VALUES ('446', '8006', '17098389565', '00:00:06', '00:00:00', '2016-02-17 16:17:56', 'SIP/8006-00007d03', 'SIP/trunk231-00007d04', 'NO ANSWER', '1455697076.32049', '');
INSERT INTO `thaa` VALUES ('447', '8006', '017098389565', '00:00:55', '00:00:00', '2016-02-17 16:18:14', 'SIP/8006-00007d05', 'SIP/trunk231-00007d06', 'NO ANSWER', '1455697094.32051', '');
INSERT INTO `thaa` VALUES ('448', '8006', '18011914833', '00:00:47', '00:00:00', '2016-02-17 16:22:02', 'SIP/8006-00007d07', 'SIP/trunk231-00007d08', 'FAILED', '1455697322.32053', '');
INSERT INTO `thaa` VALUES ('449', '8006', '13729816340', '00:00:15', '00:01:05', '2016-02-17 16:24:56', 'SIP/8006-00007d09', 'SIP/trunk231-00007d0a', 'ANSWERED', '1455697496.32055', '');
INSERT INTO `thaa` VALUES ('450', '8053', '18620018362', '00:00:09', '00:01:41', '2016-02-17 16:26:46', 'SIP/8053-00007d0b', 'SIP/trunk231-00007d0c', 'ANSWERED', '1455697606.32057', '');
INSERT INTO `thaa` VALUES ('451', '8018', '18620014905', '00:00:08', '00:00:40', '2016-02-17 16:29:09', 'SIP/8018-00007d0d', 'SIP/trunk231-00007d0e', 'ANSWERED', '1455697749.32059', '');
INSERT INTO `thaa` VALUES ('452', '8006', '18320417967', '00:00:55', '00:00:00', '2016-02-17 16:30:30', 'SIP/8006-00007d0f', 'SIP/trunk231-00007d10', 'NO ANSWER', '1455697830.32061', '');
INSERT INTO `thaa` VALUES ('453', '18320417967', '8006', '00:00:06', '00:01:23', '2016-02-17 16:33:37', 'SIP/trunk231-00007d11', 'SIP/8006-00007d12', 'ANSWERED', '1455698017.32063', '');
INSERT INTO `thaa` VALUES ('454', '13729816340', '8006', '00:00:00', '00:00:00', '2016-02-17 16:33:46', 'SIP/trunk231-00007d13', '', 'BUSY', '1455698026.32065', '');
INSERT INTO `thaa` VALUES ('455', '13729816340', '8006', '00:00:00', '00:00:00', '2016-02-17 16:34:27', 'SIP/trunk231-00007d14', '', 'BUSY', '1455698067.32066', '');
INSERT INTO `thaa` VALUES ('456', '13729816340', '8006', '00:00:06', '00:00:36', '2016-02-17 16:35:18', 'SIP/trunk231-00007d15', 'SIP/8006-00007d16', 'ANSWERED', '1455698118.32067', '');
INSERT INTO `thaa` VALUES ('457', '8006', '18814374353', '00:00:43', '00:01:09', '2016-02-17 16:36:25', 'SIP/8006-00007d17', 'SIP/trunk231-00007d18', 'ANSWERED', '1455698185.32069', '');
INSERT INTO `thaa` VALUES ('458', '8006', '18218754720', '00:00:06', '00:00:00', '2016-02-17 16:42:27', 'SIP/8006-00007d19', 'SIP/trunk231-00007d1a', 'NO ANSWER', '1455698547.32071', '');
INSERT INTO `thaa` VALUES ('459', '8006', '018218754720', '00:00:55', '00:00:00', '2016-02-17 16:42:44', 'SIP/8006-00007d1b', 'SIP/trunk231-00007d1c', 'NO ANSWER', '1455698564.32073', '');
INSERT INTO `thaa` VALUES ('460', '8006', '13070200248', '00:00:10', '00:00:45', '2016-02-17 16:44:02', 'SIP/8006-00007d1d', 'SIP/trunk231-00007d1e', 'ANSWERED', '1455698642.32075', '');
INSERT INTO `thaa` VALUES ('461', '8006', '1307078230393', '00:00:07', '00:00:00', '2016-02-17 16:47:51', 'SIP/8006-00007d1f', 'SIP/trunk231-00007d20', 'NO ANSWER', '1455698871.32077', '');
INSERT INTO `thaa` VALUES ('462', '8006', '013078230393', '00:00:25', '00:00:55', '2016-02-17 16:48:11', 'SIP/8006-00007d21', 'SIP/trunk231-00007d22', 'ANSWERED', '1455698891.32079', '');
INSERT INTO `thaa` VALUES ('463', '8006', '13826484383', '00:00:37', '00:01:01', '2016-02-17 16:52:30', 'SIP/8006-00007d23', 'SIP/trunk231-00007d24', 'ANSWERED', '1455699150.32081', '');
INSERT INTO `thaa` VALUES ('464', '8003', '18680287765', '00:00:55', '00:00:00', '2016-02-17 16:53:17', 'SIP/8003-00007d25', 'SIP/trunk231-00007d26', 'NO ANSWER', '1455699197.32083', '');
INSERT INTO `thaa` VALUES ('465', '8006', '13724192877', '00:00:17', '00:01:08', '2016-02-17 16:56:11', 'SIP/8006-00007d27', 'SIP/trunk231-00007d28', 'ANSWERED', '1455699371.32085', '');
INSERT INTO `thaa` VALUES ('466', '8006', '15210502761', '00:00:04', '00:00:00', '2016-02-17 17:00:14', 'SIP/8006-00007d29', 'SIP/trunk231-00007d2a', 'NO ANSWER', '1455699614.32087', '');
INSERT INTO `thaa` VALUES ('467', '8018', '18620014905', '00:00:05', '00:02:01', '2016-02-17 17:00:22', 'SIP/8018-00007d2b', 'SIP/trunk231-00007d2c', 'ANSWERED', '1455699622.32089', '');
INSERT INTO `thaa` VALUES ('468', '8006', '015210502761', '00:00:55', '00:00:00', '2016-02-17 17:00:32', 'SIP/8006-00007d2d', 'SIP/trunk231-00007d2e', 'NO ANSWER', '1455699632.32091', '');
INSERT INTO `thaa` VALUES ('469', '8006', '18816809334', '00:00:13', '00:01:15', '2016-02-17 17:02:28', 'SIP/8006-00007d2f', 'SIP/trunk231-00007d30', 'ANSWERED', '1455699748.32093', '');
INSERT INTO `thaa` VALUES ('470', '8018', '13824514245', '00:00:04', '00:00:00', '2016-02-17 17:06:02', 'SIP/8018-00007d31', 'SIP/trunk231-00007d32', 'NO ANSWER', '1455699962.32095', '');
INSERT INTO `thaa` VALUES ('471', '8018', '013824514245', '00:00:06', '00:00:00', '2016-02-17 17:06:14', 'SIP/8018-00007d33', 'SIP/trunk231-00007d34', 'NO ANSWER', '1455699974.32097', '');
INSERT INTO `thaa` VALUES ('472', '8018', '013824514245', '00:00:10', '00:01:45', '2016-02-17 17:06:27', 'SIP/8018-00007d35', 'SIP/trunk231-00007d36', 'ANSWERED', '1455699987.32099', '');
INSERT INTO `thaa` VALUES ('473', '8006', '13501475996', '00:00:20', '00:00:51', '2016-02-17 17:08:24', 'SIP/8006-00007d37', 'SIP/trunk231-00007d38', 'ANSWERED', '1455700104.32101', '');
INSERT INTO `thaa` VALUES ('474', '8006', '15818104795', '00:00:21', '00:00:00', '2016-02-17 17:11:38', 'SIP/8006-00007d39', 'SIP/trunk231-00007d3a', 'NO ANSWER', '1455700298.32103', '');
INSERT INTO `thaa` VALUES ('475', '8017', '23384103', '00:00:02', '00:00:03', '2016-02-17 17:14:49', 'SIP/8017-00007d3b', 'SIP/trunk231-00007d3c', 'ANSWERED', '1455700489.32105', '');
INSERT INTO `thaa` VALUES ('476', '8017', '18665573930', '00:00:11', '00:02:04', '2016-02-17 17:16:37', 'SIP/8017-00007d3d', 'SIP/trunk231-00007d3e', 'ANSWERED', '1455700597.32107', '');
INSERT INTO `thaa` VALUES ('477', '8017', '18620018700', '00:00:06', '00:00:00', '2016-02-17 17:21:47', 'SIP/8017-00007d3f', 'SIP/trunk231-00007d40', 'NO ANSWER', '1455700907.32109', '');
INSERT INTO `thaa` VALUES ('478', '8017', '18022388353', '00:00:24', '00:01:23', '2016-02-17 17:22:34', 'SIP/8017-00007d41', 'SIP/trunk231-00007d42', 'ANSWERED', '1455700954.32111', '');
INSERT INTO `thaa` VALUES ('479', '8006', '13533919565', '00:00:06', '00:00:00', '2016-02-17 17:26:50', 'SIP/8006-00007d43', 'SIP/trunk231-00007d44', 'NO ANSWER', '1455701210.32113', '');
INSERT INTO `thaa` VALUES ('480', '8006', '18011914833', '00:00:46', '00:00:00', '2016-02-17 17:28:11', 'SIP/8006-00007d45', 'SIP/trunk231-00007d46', 'FAILED', '1455701291.32115', '');
INSERT INTO `thaa` VALUES ('481', '8006', '18218754720', '00:00:06', '00:00:00', '2016-02-17 17:29:37', 'SIP/8006-00007d47', 'SIP/trunk231-00007d48', 'NO ANSWER', '1455701377.32117', '');
INSERT INTO `thaa` VALUES ('482', '8006', '018218754720', '00:00:11', '00:01:16', '2016-02-17 17:29:57', 'SIP/8006-00007d49', 'SIP/trunk231-00007d4a', 'ANSWERED', '1455701397.32119', '');
INSERT INTO `thaa` VALUES ('483', '8006', '15210502761', '00:00:05', '00:00:00', '2016-02-17 17:34:45', 'SIP/8006-00007d4b', 'SIP/trunk231-00007d4c', 'NO ANSWER', '1455701685.32121', '');
INSERT INTO `thaa` VALUES ('484', '8006', '015210502761', '00:00:55', '00:00:00', '2016-02-17 17:35:03', 'SIP/8006-00007d4d', 'SIP/trunk231-00007d4e', 'NO ANSWER', '1455701703.32123', '');
INSERT INTO `thaa` VALUES ('485', '15818104795', '8006', '00:00:07', '00:03:01', '2016-02-17 17:39:24', 'SIP/trunk231-00007d4f', 'SIP/8006-00007d50', 'ANSWERED', '1455701964.32125', '');
INSERT INTO `thaa` VALUES ('486', '18011914833', '8006', '00:00:10', '00:01:48', '2016-02-17 17:48:51', 'SIP/trunk231-00007d51', 'SIP/8006-00007d52', 'ANSWERED', '1455702531.32127', '');
INSERT INTO `thaa` VALUES ('487', '8003', '18602019573', '00:00:11', '00:01:31', '2016-02-17 18:02:57', 'SIP/8003-00007d53', 'SIP/trunk231-00007d54', 'ANSWERED', '1455703377.32129', '');
INSERT INTO `thaa` VALUES ('488', '18602019573', '8003', '00:00:55', '00:00:00', '2016-02-17 18:42:35', 'SIP/trunk231-00007d55', 'SIP/8003-00007d56', 'FAILED', '1455705755.32131', '');
INSERT INTO `thaa` VALUES ('489', '18814374353', '8006', '00:00:08', '00:00:59', '2016-02-18 09:01:43', 'SIP/trunk231-00007d57', 'SIP/8006-00007d58', 'ANSWERED', '1455757303.32133', '');
INSERT INTO `thaa` VALUES ('490', '8052', '18620013671', '00:00:20', '00:00:32', '2016-02-18 09:14:10', 'SIP/8052-00007d59', 'SIP/trunk231-00007d5a', 'ANSWERED', '1455758050.32135', '');
INSERT INTO `thaa` VALUES ('491', '8003', '8017', '00:00:05', '00:00:45', '2016-02-18 09:30:11', 'SIP/8003-00007d5b', 'SIP/8017-00007d5c', 'ANSWERED', '1455759011.32137', '');
INSERT INTO `thaa` VALUES ('492', '8003', '8051', '00:00:53', '00:00:00', '2016-02-18 09:38:47', 'SIP/8003-00007d5d', 'SIP/8051-00007d5e', 'NO ANSWER', '1455759527.32139', '');
INSERT INTO `thaa` VALUES ('493', '075788330113', '8006', '00:00:05', '00:01:05', '2016-02-18 09:39:10', 'SIP/trunk231-00007d5f', 'SIP/8006-00007d60', 'ANSWERED', '1455759550.32141', '');
INSERT INTO `thaa` VALUES ('494', '8032', '18620014715', '00:00:10', '00:00:51', '2016-02-18 09:39:14', 'SIP/8032-00007d61', 'SIP/trunk231-00007d62', 'ANSWERED', '1455759554.32143', '');
INSERT INTO `thaa` VALUES ('495', '8017', '18688893216', '00:00:55', '00:00:00', '2016-02-18 09:39:25', 'SIP/8017-00007d63', 'SIP/trunk231-00007d64', 'NO ANSWER', '1455759565.32145', '');
INSERT INTO `thaa` VALUES ('496', '8017', '18620018700', '00:00:09', '00:01:55', '2016-02-18 09:44:05', 'SIP/8017-00007d65', 'SIP/trunk231-00007d66', 'ANSWERED', '1455759845.32147', '');
INSERT INTO `thaa` VALUES ('497', '8017', '18620011403', '00:00:08', '00:01:21', '2016-02-18 09:49:21', 'SIP/8017-00007d67', 'SIP/trunk231-00007d68', 'ANSWERED', '1455760161.32149', '');
INSERT INTO `thaa` VALUES ('498', '8006', '15989092395', '00:00:55', '00:00:00', '2016-02-18 09:59:03', 'SIP/8006-00007d69', 'SIP/trunk231-00007d6a', 'NO ANSWER', '1455760743.32151', '');
INSERT INTO `thaa` VALUES ('499', '8003', '15626028788', '00:00:09', '00:02:50', '2016-02-18 10:01:28', 'SIP/8003-00007d6b', 'SIP/trunk231-00007d6c', 'ANSWERED', '1455760888.32153', '');
INSERT INTO `thaa` VALUES ('500', '8017', '66615729', '00:00:51', '00:00:00', '2016-02-18 10:02:35', 'SIP/8017-00007d6d', 'SIP/trunk231-00007d6e', 'NO ANSWER', '1455760955.32155', '');
INSERT INTO `thaa` VALUES ('501', '8033', '18620015164', '00:00:46', '00:00:00', '2016-02-18 10:02:56', 'SIP/8033-00007d6f', 'SIP/trunk231-00007d70', 'NO ANSWER', '1455760976.32157', '');
INSERT INTO `thaa` VALUES ('502', '8059', '13924281134', '00:00:13', '00:00:30', '2016-02-18 10:08:32', 'SIP/8059-00007d71', 'SIP/trunk231-00007d72', 'ANSWERED', '1455761312.32159', '');
INSERT INTO `thaa` VALUES ('503', '8053', '8009', '00:00:06', '00:00:07', '2016-02-18 10:09:55', 'SIP/8053-00007d73', 'SIP/8009-00007d74', 'ANSWERED', '1455761395.32161', '');
INSERT INTO `thaa` VALUES ('504', '31074369', '8011', '00:00:11', '00:00:14', '2016-02-18 10:11:12', 'SIP/trunk231-00007d75', 'SIP/8011-00007d76', 'ANSWERED', '1455761472.32163', '');
INSERT INTO `thaa` VALUES ('505', '8006', '15989092395', '00:00:19', '00:02:42', '2016-02-18 10:23:01', 'SIP/8006-00007d77', 'SIP/trunk231-00007d78', 'ANSWERED', '1455762181.32165', '');
INSERT INTO `thaa` VALUES ('506', '8059', '13112290101', '00:00:13', '00:01:15', '2016-02-18 10:24:16', 'SIP/8059-00007d79', 'SIP/trunk231-00007d7a', 'ANSWERED', '1455762256.32167', '');
INSERT INTO `thaa` VALUES ('507', '8006', '15989092395', '00:00:32', '00:01:23', '2016-02-18 10:28:52', 'SIP/8006-00007d7b', 'SIP/trunk231-00007d7c', 'ANSWERED', '1455762532.32169', '');
INSERT INTO `thaa` VALUES ('508', '8053', '82700468', '00:00:08', '00:00:34', '2016-02-18 10:30:30', 'SIP/8053-00007d7d', 'SIP/trunk231-00007d7e', 'ANSWERED', '1455762630.32171', '');
INSERT INTO `thaa` VALUES ('509', '8053', '32221145', '00:00:09', '00:01:05', '2016-02-18 10:31:26', 'SIP/8053-00007d7f', 'SIP/trunk231-00007d80', 'ANSWERED', '1455762686.32173', '');
INSERT INTO `thaa` VALUES ('510', '8006', '15989092395', '00:00:34', '00:01:06', '2016-02-18 10:39:22', 'SIP/8006-00007d81', 'SIP/trunk231-00007d82', 'ANSWERED', '1455763162.32175', '');
INSERT INTO `thaa` VALUES ('511', '32221100', '8053', '00:00:04', '00:01:18', '2016-02-18 10:40:33', 'SIP/trunk231-00007d83', 'SIP/8053-00007d84', 'ANSWERED', '1455763233.32177', '');
INSERT INTO `thaa` VALUES ('512', '8053', '32221100', '00:00:02', '00:00:30', '2016-02-18 10:42:20', 'SIP/8053-00007d85', 'SIP/trunk231-00007d86', 'ANSWERED', '1455763340.32179', '');
INSERT INTO `thaa` VALUES ('513', '8006', '13711524445', '00:00:53', '00:02:10', '2016-02-18 10:42:40', 'SIP/8006-00007d87', 'SIP/trunk231-00007d88', 'ANSWERED', '1455763360.32181', '');
INSERT INTO `thaa` VALUES ('514', '8033', '18620012160', '00:00:10', '00:01:05', '2016-02-18 10:43:39', 'SIP/8033-00007d89', 'SIP/trunk231-00007d8a', 'ANSWERED', '1455763419.32183', '');
INSERT INTO `thaa` VALUES ('515', '8053', '32221100', '00:00:02', '00:00:22', '2016-02-18 10:45:28', 'SIP/8053-00007d8b', 'SIP/trunk231-00007d8c', 'ANSWERED', '1455763528.32185', '');
INSERT INTO `thaa` VALUES ('516', '8053', '82700468', '00:00:10', '00:03:25', '2016-02-18 10:46:02', 'SIP/8053-00007d8d', 'SIP/trunk231-00007d8e', 'ANSWERED', '1455763562.32187', '');
INSERT INTO `thaa` VALUES ('517', '8053', '32221100', '00:00:02', '00:00:50', '2016-02-18 10:49:47', 'SIP/8053-00007d8f', 'SIP/trunk231-00007d90', 'ANSWERED', '1455763787.32189', '');
INSERT INTO `thaa` VALUES ('518', '8033', '13751852090', '00:00:11', '00:00:09', '2016-02-18 10:50:21', 'SIP/8033-00007d91', 'SIP/trunk231-00007d92', 'ANSWERED', '1455763821.32191', '');
INSERT INTO `thaa` VALUES ('519', '8053', '32221145', '00:00:06', '00:01:53', '2016-02-18 10:50:51', 'SIP/8053-00007d93', 'SIP/trunk231-00007d94', 'ANSWERED', '1455763851.32193', '');
INSERT INTO `thaa` VALUES ('520', '32221100', '8053', '00:00:03', '00:00:39', '2016-02-18 10:53:25', 'SIP/trunk231-00007d95', 'SIP/8053-00007d96', 'ANSWERED', '1455764005.32195', '');
INSERT INTO `thaa` VALUES ('521', '32221100', '8053', '00:00:12', '00:02:19', '2016-02-18 10:56:28', 'SIP/trunk231-00007d97', 'SIP/8053-00007d98', 'ANSWERED', '1455764188.32197', '');
INSERT INTO `thaa` VALUES ('522', '8032', '13922129489', '00:00:19', '00:01:33', '2016-02-18 11:01:51', 'SIP/8032-00007d99', 'SIP/trunk231-00007d9a', 'ANSWERED', '1455764511.32199', '');
INSERT INTO `thaa` VALUES ('523', '8025', '18666083656', '00:00:07', '00:00:35', '2016-02-18 11:03:45', 'SIP/8025-00007d9b', 'SIP/trunk231-00007d9c', 'ANSWERED', '1455764625.32201', '');
INSERT INTO `thaa` VALUES ('524', '32221100', '8053', '00:00:04', '00:01:32', '2016-02-18 11:03:53', 'SIP/trunk231-00007d9d', 'SIP/8053-00007d9e', 'ANSWERED', '1455764633.32203', '');
INSERT INTO `thaa` VALUES ('525', '8032', '18664638589', '00:00:45', '00:00:00', '2016-02-18 11:03:54', 'SIP/8032-00007d9f', 'SIP/trunk231-00007da0', 'NO ANSWER', '1455764634.32205', '');
INSERT INTO `thaa` VALUES ('526', '8059', '13025134410', '00:00:20', '00:00:14', '2016-02-18 11:11:41', 'SIP/8059-00007da1', 'SIP/trunk231-00007da2', 'ANSWERED', '1455765101.32207', '');
INSERT INTO `thaa` VALUES ('527', '8052', '18588930117', '00:00:05', '00:00:00', '2016-02-18 11:39:40', 'SIP/8052-00007da3', 'SIP/trunk231-00007da4', 'NO ANSWER', '1455766780.32209', '');
INSERT INTO `thaa` VALUES ('528', '8020', '4000996283', '00:00:06', '00:00:00', '2016-02-18 11:46:46', 'SIP/8020-00007da5', 'SIP/trunk231-00007da6', 'NO ANSWER', '1455767206.32211', '');
INSERT INTO `thaa` VALUES ('529', '8020', '4000996283', '00:00:06', '00:00:00', '2016-02-18 11:47:01', 'SIP/8020-00007da7', 'SIP/trunk231-00007da8', 'NO ANSWER', '1455767221.32213', '');
INSERT INTO `thaa` VALUES ('530', '8020', '4000996983', '00:00:09', '00:00:00', '2016-02-18 11:47:18', 'SIP/8020-00007da9', 'SIP/trunk231-00007daa', 'NO ANSWER', '1455767238.32215', '');
INSERT INTO `thaa` VALUES ('531', '8020', '4000996182', '00:00:06', '00:00:00', '2016-02-18 11:47:36', 'SIP/8020-00007dab', 'SIP/trunk231-00007dac', 'NO ANSWER', '1455767256.32217', '');
INSERT INTO `thaa` VALUES ('532', '8020', '4000996186', '00:00:03', '00:00:03', '2016-02-18 11:47:52', 'SIP/8020-00007dad', 'SIP/trunk231-00007dae', 'ANSWERED', '1455767272.32219', '');
INSERT INTO `thaa` VALUES ('533', '8020', '4000996383', '00:00:06', '00:00:00', '2016-02-18 11:48:08', 'SIP/8020-00007daf', 'SIP/trunk231-00007db0', 'NO ANSWER', '1455767288.32221', '');
INSERT INTO `thaa` VALUES ('534', '8020', '4000996181', '00:00:05', '00:00:01', '2016-02-18 11:48:25', 'SIP/8020-00007db1', 'SIP/trunk231-00007db2', 'ANSWERED', '1455767305.32223', '');
INSERT INTO `thaa` VALUES ('535', '8020', '4000996189', '00:00:11', '00:00:00', '2016-02-18 11:48:40', 'SIP/8020-00007db3', 'SIP/trunk231-00007db4', 'FAILED', '1455767320.32225', '');
INSERT INTO `thaa` VALUES ('536', '8020', '4000996386', '00:00:07', '00:00:00', '2016-02-18 11:48:59', 'SIP/8020-00007db5', 'SIP/trunk231-00007db6', 'NO ANSWER', '1455767339.32227', '');
INSERT INTO `thaa` VALUES ('537', '8053', '13724160096', '00:00:31', '00:00:51', '2016-02-18 11:49:42', 'SIP/8053-00007db7', 'SIP/trunk231-00007db8', 'ANSWERED', '1455767382.32229', '');
INSERT INTO `thaa` VALUES ('538', '8020', '4000991110', '00:00:05', '00:00:00', '2016-02-18 11:50:54', 'SIP/8020-00007db9', 'SIP/trunk231-00007dba', 'NO ANSWER', '1455767454.32231', '');
INSERT INTO `thaa` VALUES ('539', '8000', '38483468', '00:00:09', '00:00:29', '2016-02-18 11:56:06', 'SIP/8000-00007dbb', 'SIP/trunk231-00007dbc', 'ANSWERED', '1455767766.32233', '');
INSERT INTO `thaa` VALUES ('540', '8050', '37249289', '00:00:21', '00:00:00', '2016-02-18 13:37:56', 'SIP/8050-00007dbd', 'SIP/trunk231-00007dbe', 'NO ANSWER', '1455773876.32235', '');
INSERT INTO `thaa` VALUES ('541', '8050', '13535328208', '00:00:08', '00:01:01', '2016-02-18 13:38:24', 'SIP/8050-00007dbf', 'SIP/trunk231-00007dc0', 'ANSWERED', '1455773904.32237', '');
INSERT INTO `thaa` VALUES ('542', '8023', '29193617', '00:00:11', '00:00:58', '2016-02-18 13:44:51', 'SIP/8023-00007dc1', 'SIP/trunk231-00007dc2', 'ANSWERED', '1455774291.32239', '');
INSERT INTO `thaa` VALUES ('543', '8023', '13480241549', '00:00:55', '00:00:00', '2016-02-18 13:46:31', 'SIP/8023-00007dc3', 'SIP/trunk231-00007dc4', 'NO ANSWER', '1455774391.32241', '');
INSERT INTO `thaa` VALUES ('544', '8023', '29193617', '00:00:11', '00:01:36', '2016-02-18 13:47:52', 'SIP/8023-00007dc5', 'SIP/trunk231-00007dc6', 'ANSWERED', '1455774472.32243', '');
INSERT INTO `thaa` VALUES ('545', '8023', '13480241549', '00:00:09', '00:01:18', '2016-02-18 13:50:56', 'SIP/8023-00007dc7', 'SIP/trunk231-00007dc8', 'ANSWERED', '1455774656.32245', '');
INSERT INTO `thaa` VALUES ('546', '8020', '22310010', '00:00:04', '00:11:08', '2016-02-18 13:53:09', 'SIP/8020-00007dc9', 'SIP/trunk231-00007dca', 'ANSWERED', '1455774789.32247', '');
INSERT INTO `thaa` VALUES ('547', '8008', '8010', '00:00:05', '00:01:31', '2016-02-18 14:04:39', 'SIP/8008-00007dcb', 'SIP/8010-00007dcc', 'ANSWERED', '1455775479.32249', '');
INSERT INTO `thaa` VALUES ('548', '8020', '013532636010', '00:00:12', '00:03:19', '2016-02-18 14:05:39', 'SIP/8020-00007dcd', 'SIP/trunk231-00007dce', 'ANSWERED', '1455775539.32251', '');
INSERT INTO `thaa` VALUES ('549', '8053', '13710998102', '00:00:32', '00:00:00', '2016-02-18 14:16:32', 'SIP/8053-00007dcf', 'SIP/trunk231-00007dd0', 'NO ANSWER', '1455776192.32253', '');
INSERT INTO `thaa` VALUES ('550', '8020', '18620012234', '00:00:05', '00:00:00', '2016-02-18 14:16:43', 'SIP/8020-00007dd1', 'SIP/trunk231-00007dd2', 'NO ANSWER', '1455776203.32255', '');
INSERT INTO `thaa` VALUES ('551', '8052', '18620012822', '00:00:06', '00:00:00', '2016-02-18 14:19:26', 'SIP/8052-00007dd3', 'SIP/trunk231-00007dd4', 'NO ANSWER', '1455776366.32257', '');
INSERT INTO `thaa` VALUES ('552', '8020', '18620012234', '00:00:14', '00:07:13', '2016-02-18 14:19:39', 'SIP/8020-00007dd5', 'SIP/trunk231-00007dd6', 'ANSWERED', '1455776379.32259', '');
INSERT INTO `thaa` VALUES ('553', '8023', '18620018919', '00:00:16', '00:04:12', '2016-02-18 14:22:42', 'SIP/8023-00007dd7', 'SIP/trunk231-00007dd8', 'ANSWERED', '1455776562.32261', '');
INSERT INTO `thaa` VALUES ('554', '8020', '18620562928', '00:00:11', '00:09:30', '2016-02-18 14:27:15', 'SIP/8020-00007dd9', 'SIP/trunk231-00007dda', 'ANSWERED', '1455776835.32263', '');
INSERT INTO `thaa` VALUES ('555', '8023', '29193601', '00:00:55', '00:00:00', '2016-02-18 14:30:00', 'SIP/8023-00007ddb', 'SIP/trunk231-00007ddc', 'NO ANSWER', '1455777000.32265', '');
INSERT INTO `thaa` VALUES ('556', '18665661270', '8023', '00:00:08', '00:09:44', '2016-02-18 14:31:10', 'SIP/trunk231-00007ddd', 'SIP/8023-00007dde', 'ANSWERED', '1455777070.32267', '');
INSERT INTO `thaa` VALUES ('557', '8052', '18620015562', '00:00:11', '00:00:18', '2016-02-18 14:47:58', 'SIP/8052-00007ddf', 'SIP/trunk231-00007de0', 'ANSWERED', '1455778078.32269', '');
INSERT INTO `thaa` VALUES ('558', '8006', '15521370207', '00:00:07', '00:00:39', '2016-02-18 14:58:32', 'SIP/8006-00007de1', 'SIP/trunk231-00007de2', 'ANSWERED', '1455778712.32271', '');
INSERT INTO `thaa` VALUES ('559', '8006', '13826004575', '00:00:20', '00:01:15', '2016-02-18 15:03:02', 'SIP/8006-00007de3', 'SIP/trunk231-00007de4', 'ANSWERED', '1455778982.32273', '');
INSERT INTO `thaa` VALUES ('560', '8018', '18620014085', '00:00:32', '00:00:02', '2016-02-18 15:09:03', 'SIP/8018-00007de5', 'SIP/trunk231-00007de6', 'ANSWERED', '1455779343.32275', '');
INSERT INTO `thaa` VALUES ('561', '8006', '15818126029', '00:00:55', '00:00:00', '2016-02-18 15:11:10', 'SIP/8006-00007de7', 'SIP/trunk231-00007de8', 'NO ANSWER', '1455779470.32277', '');
INSERT INTO `thaa` VALUES ('562', '8017', '13924281134', '00:00:21', '00:00:29', '2016-02-18 15:11:52', 'SIP/8017-00007de9', 'SIP/trunk231-00007dea', 'ANSWERED', '1455779512.32279', '');
INSERT INTO `thaa` VALUES ('563', '8006', '13660232542', '00:00:12', '00:01:20', '2016-02-18 15:13:16', 'SIP/8006-00007deb', 'SIP/trunk231-00007dec', 'ANSWERED', '1455779596.32281', '');
INSERT INTO `thaa` VALUES ('564', '8003', '8000', '00:00:12', '00:00:15', '2016-02-18 15:19:59', 'SIP/8003-00007ded', 'SIP/8000-00007dee', 'ANSWERED', '1455779999.32283', '');
INSERT INTO `thaa` VALUES ('565', '8006', '15915823628', '00:00:22', '00:03:01', '2016-02-18 15:20:53', 'SIP/8006-00007def', 'SIP/trunk231-00007df0', 'ANSWERED', '1455780053.32285', '');
INSERT INTO `thaa` VALUES ('566', '15818126029', '8006', '00:00:00', '00:00:00', '2016-02-18 15:21:10', 'SIP/trunk231-00007df1', '', 'BUSY', '1455780070.32287', '');
INSERT INTO `thaa` VALUES ('567', '8053', '18988910887', '00:00:15', '00:04:21', '2016-02-18 15:25:36', 'SIP/8053-00007df2', 'SIP/trunk231-00007df3', 'ANSWERED', '1455780336.32288', '');
INSERT INTO `thaa` VALUES ('568', '8003', '8053', '00:00:00', '00:00:00', '2016-02-18 15:29:18', 'SIP/8003-00007df4', '', 'BUSY', '1455780558.32290', '');
INSERT INTO `thaa` VALUES ('569', '8003', '8053', '00:00:00', '00:00:00', '2016-02-18 15:29:28', 'SIP/8003-00007df5', '', 'BUSY', '1455780568.32291', '');
INSERT INTO `thaa` VALUES ('570', '8003', '8053', '00:00:04', '00:00:43', '2016-02-18 15:34:10', 'SIP/8003-00007df6', 'SIP/8053-00007df7', 'ANSWERED', '1455780850.32292', '');
INSERT INTO `thaa` VALUES ('571', '8018', '18620014085', '00:00:23', '00:00:04', '2016-02-18 15:37:48', 'SIP/8018-00007df8', 'SIP/trunk231-00007df9', 'ANSWERED', '1455781068.32294', '');
INSERT INTO `thaa` VALUES ('572', '8032', '22312799', '00:00:04', '00:02:38', '2016-02-18 15:37:56', 'SIP/8032-00007dfa', 'SIP/trunk231-00007dfb', 'ANSWERED', '1455781076.32296', '');
INSERT INTO `thaa` VALUES ('573', '8018', '18620014085', '00:00:26', '00:00:51', '2016-02-18 15:38:22', 'SIP/8018-00007dfc', 'SIP/trunk231-00007dfd', 'ANSWERED', '1455781102.32298', '');
INSERT INTO `thaa` VALUES ('574', '8003', '8053', '00:00:04', '00:01:23', '2016-02-18 15:39:16', 'SIP/8003-00007dfe', 'SIP/8053-00007dff', 'ANSWERED', '1455781156.32300', '');
INSERT INTO `thaa` VALUES ('575', '8032', '10019', '00:00:02', '00:02:33', '2016-02-18 15:40:43', 'SIP/8032-00007e00', 'SIP/trunk231-00007e01', 'ANSWERED', '1455781243.32302', '');
INSERT INTO `thaa` VALUES ('576', '8032', '22025359', '00:00:03', '00:00:35', '2016-02-18 15:43:37', 'SIP/8032-00007e02', 'SIP/trunk231-00007e03', 'ANSWERED', '1455781417.32304', '');
INSERT INTO `thaa` VALUES ('577', '8032', '18664638589', '00:00:55', '00:00:00', '2016-02-18 15:58:18', 'SIP/8032-00007e04', 'SIP/trunk231-00007e05', 'NO ANSWER', '1455782298.32306', '');
INSERT INTO `thaa` VALUES ('578', '8032', '83333999', '00:00:55', '00:00:00', '2016-02-18 16:01:35', 'SIP/8032-00007e06', 'SIP/trunk231-00007e07', 'NO ANSWER', '1455782495.32308', '');
INSERT INTO `thaa` VALUES ('579', '8032', '38810999', '00:00:43', '00:00:00', '2016-02-18 16:02:22', 'SIP/8032-00007e08', 'SIP/trunk231-00007e09', 'NO ANSWER', '1455782542.32310', '');
INSERT INTO `thaa` VALUES ('580', '8032', '38810999', '00:00:38', '00:00:00', '2016-02-18 16:03:14', 'SIP/8032-00007e0a', 'SIP/trunk231-00007e0b', 'NO ANSWER', '1455782594.32312', '');
INSERT INTO `thaa` VALUES ('581', '8053', '13503040161', '00:00:15', '00:03:56', '2016-02-18 16:08:28', 'SIP/8053-00007e0c', 'SIP/trunk231-00007e0d', 'ANSWERED', '1455782908.32314', '');
INSERT INTO `thaa` VALUES ('582', '8030', '22992471', '00:00:02', '00:00:00', '2016-02-18 16:12:05', 'SIP/8030-00007e0e', 'SIP/trunk231-00007e0f', 'BUSY', '1455783125.32316', '');
INSERT INTO `thaa` VALUES ('583', '8030', '18620018801', '00:00:10', '00:05:03', '2016-02-18 16:12:23', 'SIP/8030-00007e10', 'SIP/trunk231-00007e11', 'ANSWERED', '1455783143.32318', '');
INSERT INTO `thaa` VALUES ('584', '8050', '8009', '00:00:13', '00:00:00', '2016-02-18 16:35:44', 'SIP/8050-00007e12', 'SIP/8009-00007e13', 'NO ANSWER', '1455784544.32320', '');
INSERT INTO `thaa` VALUES ('585', '8000', '13434609817', '00:00:06', '00:00:00', '2016-02-18 16:49:01', 'SIP/8000-00007e14', 'SIP/trunk231-00007e15', 'NO ANSWER', '1455785341.32322', '');
INSERT INTO `thaa` VALUES ('586', '8000', '013434609817', '00:00:10', '00:04:43', '2016-02-18 16:49:17', 'SIP/8000-00007e16', 'SIP/trunk231-00007e17', 'ANSWERED', '1455785357.32324', '');
INSERT INTO `thaa` VALUES ('587', '8017', '18922183035', '00:00:17', '00:00:00', '2016-02-18 16:54:07', 'SIP/8017-00007e18', 'SIP/trunk231-00007e19', 'NO ANSWER', '1455785647.32326', '');
INSERT INTO `thaa` VALUES ('588', '18922183035', '8017', '00:00:03', '00:01:19', '2016-02-18 16:54:48', 'SIP/trunk231-00007e1a', 'SIP/8017-00007e1b', 'ANSWERED', '1455785688.32328', '');
INSERT INTO `thaa` VALUES ('589', '8017', '13710323531', '00:00:16', '00:01:57', '2016-02-18 17:06:21', 'SIP/8017-00007e1c', 'SIP/trunk231-00007e1d', 'ANSWERED', '1455786381.32330', '');
INSERT INTO `thaa` VALUES ('590', '8006', '13726816572', '00:00:15', '00:00:34', '2016-02-18 17:10:00', 'SIP/8006-00007e1e', 'SIP/trunk231-00007e1f', 'ANSWERED', '1455786600.32332', '');
INSERT INTO `thaa` VALUES ('591', '8006', '18218754720', '00:00:05', '00:00:00', '2016-02-18 17:11:23', 'SIP/8006-00007e20', 'SIP/trunk231-00007e21', 'NO ANSWER', '1455786683.32334', '');
INSERT INTO `thaa` VALUES ('592', '8006', '018218754720', '00:00:14', '00:00:50', '2016-02-18 17:11:40', 'SIP/8006-00007e22', 'SIP/trunk231-00007e23', 'ANSWERED', '1455786700.32336', '');
INSERT INTO `thaa` VALUES ('593', '8006', '13729816340', '00:00:11', '00:00:47', '2016-02-18 17:14:23', 'SIP/8006-00007e24', 'SIP/trunk231-00007e25', 'ANSWERED', '1455786863.32338', '');
INSERT INTO `thaa` VALUES ('594', '8017', '18620012027', '00:00:55', '00:00:00', '2016-02-18 17:17:31', 'SIP/8017-00007e26', 'SIP/trunk231-00007e27', 'NO ANSWER', '1455787051.32340', '');
INSERT INTO `thaa` VALUES ('595', '18620012027', '8017', '00:00:05', '00:09:37', '2016-02-18 17:25:38', 'SIP/trunk231-00007e28', 'SIP/8017-00007e29', 'ANSWERED', '1455787538.32342', '');
INSERT INTO `thaa` VALUES ('596', '8003', '18602019573', '00:00:14', '00:00:46', '2016-02-18 18:57:34', 'SIP/8003-00007e2a', 'SIP/trunk231-00007e2b', 'ANSWERED', '1455793054.32344', '');
INSERT INTO `thaa` VALUES ('597', '8050', '18922462420', '00:00:20', '00:00:00', '2016-02-19 09:08:57', 'SIP/8050-00007e2c', 'SIP/trunk231-00007e2d', 'NO ANSWER', '1455844137.32346', '');
INSERT INTO `thaa` VALUES ('598', '8009', '8050', '00:00:03', '00:00:07', '2016-02-19 09:27:19', 'SIP/8009-00007e2e', 'SIP/8050-00007e2f', 'ANSWERED', '1455845239.32348', '');
INSERT INTO `thaa` VALUES ('599', '8009', '15975365824', '00:00:23', '00:00:00', '2016-02-19 09:39:13', 'SIP/8009-00007e30', 'SIP/trunk231-00007e31', 'NO ANSWER', '1455845953.32350', '');
INSERT INTO `thaa` VALUES ('600', '8009', '15975365824', '00:00:10', '00:01:40', '2016-02-19 09:39:43', 'SIP/8009-00007e32', 'SIP/trunk231-00007e33', 'ANSWERED', '1455845983.32352', '');
INSERT INTO `thaa` VALUES ('601', '8050', '18922462420', '00:00:27', '00:00:00', '2016-02-19 09:39:55', 'SIP/8050-00007e34', 'SIP/trunk231-00007e35', 'NO ANSWER', '1455845995.32354', '');
INSERT INTO `thaa` VALUES ('602', '8009', '13631378829', '00:00:28', '00:01:12', '2016-02-19 09:43:17', 'SIP/8009-00007e36', 'SIP/trunk231-00007e37', 'ANSWERED', '1455846197.32356', '');
INSERT INTO `thaa` VALUES ('603', '8032', '13560116931', '00:00:10', '00:00:47', '2016-02-19 09:45:29', 'SIP/8032-00007e38', 'SIP/trunk231-00007e39', 'ANSWERED', '1455846329.32358', '');
INSERT INTO `thaa` VALUES ('604', '8009', '13710313789', '00:00:55', '00:00:00', '2016-02-19 09:45:43', 'SIP/8009-00007e3a', 'SIP/trunk231-00007e3b', 'NO ANSWER', '1455846343.32360', '');
INSERT INTO `thaa` VALUES ('605', '8053', '8008', '00:00:04', '00:01:02', '2016-02-19 09:54:17', 'SIP/8053-00007e3c', 'SIP/8008-00007e3d', 'ANSWERED', '1455846857.32362', '');
INSERT INTO `thaa` VALUES ('606', '8018', '18922185680', '00:00:26', '00:00:29', '2016-02-19 09:57:10', 'SIP/8018-00007e3e', 'SIP/trunk231-00007e3f', 'ANSWERED', '1455847030.32364', '');
INSERT INTO `thaa` VALUES ('607', '8001', '18620018618', '00:00:13', '00:00:20', '2016-02-19 10:15:32', 'SIP/8001-00007e40', 'SIP/trunk231-00007e41', 'ANSWERED', '1455848132.32366', '');
INSERT INTO `thaa` VALUES ('608', '8059', '15914207008', '00:00:19', '00:03:04', '2016-02-19 10:21:43', 'SIP/8059-00007e42', 'SIP/trunk231-00007e43', 'ANSWERED', '1455848503.32368', '');
INSERT INTO `thaa` VALUES ('609', '8059', '15918712462', '00:00:10', '00:04:08', '2016-02-19 10:25:15', 'SIP/8059-00007e44', 'SIP/trunk231-00007e45', 'ANSWERED', '1455848715.32370', '');
INSERT INTO `thaa` VALUES ('610', '8023', '15927225007', '00:00:04', '00:00:00', '2016-02-19 10:37:44', 'SIP/8023-00007e46', 'SIP/trunk231-00007e47', 'NO ANSWER', '1455849464.32372', '');
INSERT INTO `thaa` VALUES ('611', '8023', '015927225007', '00:00:21', '00:00:00', '2016-02-19 10:37:58', 'SIP/8023-00007e48', 'SIP/trunk231-00007e49', 'NO ANSWER', '1455849478.32374', '');
INSERT INTO `thaa` VALUES ('612', '8020', '8053', '00:00:05', '00:00:24', '2016-02-19 10:39:36', 'SIP/8020-00007e4a', 'SIP/8053-00007e4b', 'ANSWERED', '1455849576.32376', '');
INSERT INTO `thaa` VALUES ('613', '8020', '8058', '00:00:07', '00:00:26', '2016-02-19 10:42:59', 'SIP/8020-00007e4c', 'SIP/8058-00007e4d', 'ANSWERED', '1455849779.32378', '');
INSERT INTO `thaa` VALUES ('614', '8055', '8009', '00:00:06', '00:00:15', '2016-02-19 10:45:35', 'SIP/8055-00007e4e', 'SIP/8009-00007e4f', 'ANSWERED', '1455849935.32380', '');
INSERT INTO `thaa` VALUES ('615', '8009', '13760601451', '00:00:11', '00:03:12', '2016-02-19 10:46:34', 'SIP/8009-00007e50', 'SIP/trunk231-00007e51', 'ANSWERED', '1455849994.32382', '');
INSERT INTO `thaa` VALUES ('616', '8088', '8009', '00:00:07', '00:00:54', '2016-02-19 10:50:56', 'SIP/8088-00007e52', 'SIP/8009-00007e53', 'ANSWERED', '1455850256.32384', '');
INSERT INTO `thaa` VALUES ('617', '8018', '18620012102', '00:00:10', '00:01:58', '2016-02-19 10:53:03', 'SIP/8018-00007e54', 'SIP/trunk231-00007e55', 'ANSWERED', '1455850383.32386', '');
INSERT INTO `thaa` VALUES ('618', '8030', '22992471', '00:00:18', '00:00:38', '2016-02-19 10:53:59', 'SIP/8030-00007e56', 'SIP/trunk231-00007e57', 'ANSWERED', '1455850439.32388', '');
INSERT INTO `thaa` VALUES ('619', '8018', '83963811', '00:00:04', '00:01:34', '2016-02-19 10:55:20', 'SIP/8018-00007e58', 'SIP/trunk231-00007e59', 'ANSWERED', '1455850520.32390', '');
INSERT INTO `thaa` VALUES ('620', '8018', '18807601058', '00:00:03', '00:00:00', '2016-02-19 10:58:56', 'SIP/8018-00007e5a', 'SIP/trunk231-00007e5b', 'NO ANSWER', '1455850736.32392', '');
INSERT INTO `thaa` VALUES ('621', '8018', '018807601058', '00:00:16', '00:00:42', '2016-02-19 10:59:06', 'SIP/8018-00007e5c', 'SIP/trunk231-00007e5d', 'ANSWERED', '1455850746.32394', '');
INSERT INTO `thaa` VALUES ('622', '8059', '875644033', '00:00:06', '00:00:10', '2016-02-19 10:59:58', 'SIP/8059-00007e5e', 'SIP/trunk231-00007e5f', 'ANSWERED', '1455850798.32396', '');
INSERT INTO `thaa` VALUES ('623', '8059', '87564403', '00:00:06', '00:00:12', '2016-02-19 11:00:21', 'SIP/8059-00007e60', 'SIP/trunk231-00007e61', 'ANSWERED', '1455850821.32398', '');
INSERT INTO `thaa` VALUES ('624', '8059', '87564955', '00:00:13', '00:00:41', '2016-02-19 11:00:46', 'SIP/8059-00007e62', 'SIP/trunk231-00007e63', 'ANSWERED', '1455850846.32400', '');
INSERT INTO `thaa` VALUES ('625', '36690118', '8003', '00:00:06', '00:04:39', '2016-02-19 11:03:06', 'SIP/trunk231-00007e64', 'SIP/8003-00007e65', 'ANSWERED', '1455850986.32402', '');
INSERT INTO `thaa` VALUES ('626', '8033', '13312836579', '00:00:28', '00:01:10', '2016-02-19 11:11:20', 'SIP/8033-00007e66', 'SIP/trunk231-00007e67', 'ANSWERED', '1455851480.32404', '');
INSERT INTO `thaa` VALUES ('627', '8008', '8056', '00:00:17', '00:00:19', '2016-02-19 11:15:12', 'SIP/8008-00007e68', 'SIP/8056-00007e69', 'ANSWERED', '1455851712.32406', '');
INSERT INTO `thaa` VALUES ('628', '8010', '18620034561', '00:00:11', '00:00:12', '2016-02-19 11:21:29', 'SIP/8010-00007e6a', 'SIP/trunk231-00007e6b', 'ANSWERED', '1455852089.32408', '');
INSERT INTO `thaa` VALUES ('629', '8056', '8008', '00:00:05', '00:00:19', '2016-02-19 11:25:50', 'SIP/8056-00007e6c', 'SIP/8008-00007e6d', 'ANSWERED', '1455852350.32410', '');
INSERT INTO `thaa` VALUES ('630', '8053', '18688900369', '00:00:16', '00:00:24', '2016-02-19 11:27:09', 'SIP/8053-00007e6e', 'SIP/trunk231-00007e6f', 'ANSWERED', '1455852429.32412', '');
INSERT INTO `thaa` VALUES ('631', '8059', '18688900369', '00:00:06', '00:00:58', '2016-02-19 11:30:01', 'SIP/8059-00007e70', 'SIP/trunk231-00007e71', 'ANSWERED', '1455852601.32414', '');
INSERT INTO `thaa` VALUES ('632', '38380913', '8010', '00:00:47', '00:00:00', '2016-02-19 11:41:10', 'SIP/trunk231-00007e72', 'SIP/8010-00007e73', 'NO ANSWER', '1455853270.32416', '');
INSERT INTO `thaa` VALUES ('633', '83953417', '8056', '00:00:08', '00:00:43', '2016-02-19 11:45:33', 'SIP/trunk231-00007e74', 'SIP/8056-00007e75', 'ANSWERED', '1455853533.32418', '');
INSERT INTO `thaa` VALUES ('634', '83953417', '8006', '00:00:55', '00:00:00', '2016-02-19 11:48:01', 'SIP/trunk231-00007e76', 'SIP/8006-00007e77', 'FAILED', '1455853681.32420', '');
INSERT INTO `thaa` VALUES ('635', '8059', '18520669400', '00:00:55', '00:00:00', '2016-02-19 12:04:05', 'SIP/8059-00007e78', 'SIP/trunk231-00007e79', 'NO ANSWER', '1455854645.32422', '');
INSERT INTO `thaa` VALUES ('636', '13501475996', '8006', '00:00:04', '00:00:05', '2016-02-19 13:17:52', 'SIP/trunk231-00007e7a', 'SIP/8006-00007e7b', 'ANSWERED', '1455859072.32424', '');
INSERT INTO `thaa` VALUES ('637', '13501475996', '8006', '00:00:06', '00:00:29', '2016-02-19 13:18:24', 'SIP/trunk231-00007e7c', 'SIP/8006-00007e7d', 'ANSWERED', '1455859104.32426', '');
INSERT INTO `thaa` VALUES ('638', '8058', '15626028788', '00:00:12', '00:00:49', '2016-02-19 14:03:49', 'SIP/8058-00007e7e', 'SIP/trunk231-00007e7f', 'ANSWERED', '1455861829.32428', '');
INSERT INTO `thaa` VALUES ('639', '8020', '62942469', '00:00:04', '00:00:17', '2016-02-19 14:14:49', 'SIP/8020-00007e80', 'SIP/trunk231-00007e81', 'ANSWERED', '1455862489.32430', '');
INSERT INTO `thaa` VALUES ('640', '8059', '13422251853', '00:00:05', '00:00:00', '2016-02-19 14:24:05', 'SIP/8059-00007e82', 'SIP/trunk231-00007e83', 'NO ANSWER', '1455863045.32432', '');
INSERT INTO `thaa` VALUES ('641', '8059', '13168813367', '00:00:45', '00:00:00', '2016-02-19 14:24:38', 'SIP/8059-00007e84', 'SIP/trunk231-00007e85', 'BUSY', '1455863078.32434', '');
INSERT INTO `thaa` VALUES ('642', '8059', '13168813367', '00:00:16', '00:00:42', '2016-02-19 14:25:33', 'SIP/8059-00007e86', 'SIP/trunk231-00007e87', 'ANSWERED', '1455863133.32436', '');
INSERT INTO `thaa` VALUES ('643', '18602019573', '8003', '00:00:10', '00:03:48', '2016-02-19 14:30:31', 'SIP/trunk231-00007e88', 'SIP/8003-00007e89', 'ANSWERED', '1455863431.32438', '');
INSERT INTO `thaa` VALUES ('644', '8018', '18620012102', '00:00:10', '00:01:39', '2016-02-19 14:32:52', 'SIP/8018-00007e8a', 'SIP/trunk231-00007e8b', 'ANSWERED', '1455863572.32440', '');
INSERT INTO `thaa` VALUES ('645', '8006', '130716808677', '00:00:05', '00:00:00', '2016-02-19 14:34:27', 'SIP/8006-00007e8c', 'SIP/trunk231-00007e8d', 'NO ANSWER', '1455863667.32442', '');
INSERT INTO `thaa` VALUES ('646', '8003', '13711342416', '00:00:15', '00:00:00', '2016-02-19 14:34:42', 'SIP/8003-00007e8e', 'SIP/trunk231-00007e8f', 'NO ANSWER', '1455863682.32444', '');
INSERT INTO `thaa` VALUES ('647', '8018', '83963811', '00:00:04', '00:00:48', '2016-02-19 14:34:57', 'SIP/8018-00007e90', 'SIP/trunk231-00007e91', 'ANSWERED', '1455863697.32446', '');
INSERT INTO `thaa` VALUES ('648', '8006', '013071608677', '00:00:13', '00:01:56', '2016-02-19 14:34:58', 'SIP/8006-00007e92', 'SIP/trunk231-00007e93', 'ANSWERED', '1455863698.32448', '');
INSERT INTO `thaa` VALUES ('649', '8003', '13711342416', '00:00:11', '00:00:00', '2016-02-19 14:37:14', 'SIP/8003-00007e94', 'SIP/trunk231-00007e95', 'NO ANSWER', '1455863834.32450', '');
INSERT INTO `thaa` VALUES ('650', '8041', '8054', '00:00:04', '00:00:00', '2016-02-19 14:39:17', 'SIP/8041-00007e96', 'SIP/8054-00007e97', 'NO ANSWER', '1455863957.32452', '');
INSERT INTO `thaa` VALUES ('651', '8017', '22082237', '00:00:06', '00:00:55', '2016-02-19 14:47:16', 'SIP/8017-00007e98', 'SIP/trunk231-00007e99', 'ANSWERED', '1455864436.32454', '');
INSERT INTO `thaa` VALUES ('652', '8006', '13622216145', '00:00:15', '00:00:44', '2016-02-19 14:49:47', 'SIP/8006-00007e9a', 'SIP/trunk231-00007e9b', 'ANSWERED', '1455864587.32456', '');
INSERT INTO `thaa` VALUES ('653', '8003', '13002033194', '00:00:19', '00:01:25', '2016-02-19 14:54:15', 'SIP/8003-00007e9c', 'SIP/trunk231-00007e9d', 'ANSWERED', '1455864855.32458', '');
INSERT INTO `thaa` VALUES ('654', '8010', '37588609', '00:00:07', '00:00:50', '2016-02-19 14:54:58', 'SIP/8010-00007e9e', 'SIP/trunk231-00007e9f', 'ANSWERED', '1455864898.32460', '');
INSERT INTO `thaa` VALUES ('655', '8052', '186805878', '00:00:00', '00:00:00', '2016-02-19 14:56:31', 'SIP/8052-00007ea0', 'SIP/trunk231-00007ea1', 'FAILED', '1455864991.32462', '');
INSERT INTO `thaa` VALUES ('656', '8052', '18680287873', '00:00:11', '00:01:04', '2016-02-19 14:56:50', 'SIP/8052-00007ea2', 'SIP/trunk231-00007ea3', 'ANSWERED', '1455865010.32464', '');
INSERT INTO `thaa` VALUES ('657', '8006', '18820785617', '00:00:18', '00:00:44', '2016-02-19 14:59:38', 'SIP/8006-00007ea4', 'SIP/trunk231-00007ea5', 'ANSWERED', '1455865178.32466', '');
INSERT INTO `thaa` VALUES ('658', '8006', '015680700529', '00:00:21', '00:02:11', '2016-02-19 15:06:52', 'SIP/8006-00007ea6', 'SIP/trunk231-00007ea7', 'ANSWERED', '1455865612.32468', '');
INSERT INTO `thaa` VALUES ('659', '8053', '13710998102', '00:00:09', '00:00:00', '2016-02-19 15:11:39', 'SIP/8053-00007ea8', 'SIP/trunk231-00007ea9', 'NO ANSWER', '1455865899.32470', '');
INSERT INTO `thaa` VALUES ('660', '8010', '15011852855', '00:00:10', '00:14:07', '2016-02-19 15:13:38', 'SIP/8010-00007eaa', 'SIP/trunk231-00007eab', 'ANSWERED', '1455866018.32472', '');
INSERT INTO `thaa` VALUES ('661', '8053', '13710998102', '00:00:50', '00:00:00', '2016-02-19 15:15:51', 'SIP/8053-00007eac', 'SIP/trunk231-00007ead', 'NO ANSWER', '1455866151.32474', '');
INSERT INTO `thaa` VALUES ('662', '8006', '13560409379', '00:00:18', '00:01:36', '2016-02-19 15:19:08', 'SIP/8006-00007eae', 'SIP/trunk231-00007eaf', 'ANSWERED', '1455866348.32476', '');
INSERT INTO `thaa` VALUES ('663', '8006', '18824622829', '00:00:07', '00:00:00', '2016-02-19 15:25:44', 'SIP/8006-00007eb0', 'SIP/trunk231-00007eb1', 'NO ANSWER', '1455866744.32478', '');
INSERT INTO `thaa` VALUES ('664', '8006', '018824622829', '00:00:10', '00:00:00', '2016-02-19 15:26:03', 'SIP/8006-00007eb2', 'SIP/trunk231-00007eb3', 'NO ANSWER', '1455866763.32480', '');
INSERT INTO `thaa` VALUES ('665', '8006', '13533923926', '00:00:53', '00:00:42', '2016-02-19 15:28:06', 'SIP/8006-00007eb4', 'SIP/trunk231-00007eb5', 'ANSWERED', '1455866886.32482', '');
INSERT INTO `thaa` VALUES ('666', '8053', '13710998102', '00:00:15', '00:00:32', '2016-02-19 15:28:08', 'SIP/8053-00007eb6', 'SIP/trunk231-00007eb7', 'ANSWERED', '1455866888.32484', '');
INSERT INTO `thaa` VALUES ('667', '8041', '13213124321', '00:00:03', '00:00:00', '2016-02-19 15:30:15', 'SIP/8041-00007eb8', 'SIP/trunk231-00007eb9', 'NO ANSWER', '1455867015.32486', '');
INSERT INTO `thaa` VALUES ('668', '8041', '13213124321', '00:00:07', '00:00:00', '2016-02-19 15:30:28', 'SIP/8041-00007eba', 'SIP/trunk231-00007ebb', 'NO ANSWER', '1455867028.32488', '');
INSERT INTO `thaa` VALUES ('669', '8006', '15918571756', '00:00:55', '00:00:00', '2016-02-19 15:31:14', 'SIP/8006-00007ebc', 'SIP/trunk231-00007ebd', 'NO ANSWER', '1455867074.32490', '');
INSERT INTO `thaa` VALUES ('670', '8017', '18602011060', '00:00:13', '00:00:18', '2016-02-19 15:33:21', 'SIP/8017-00007ebe', 'SIP/trunk231-00007ebf', 'ANSWERED', '1455867201.32492', '');
INSERT INTO `thaa` VALUES ('671', '8016', '29110707', '00:00:15', '00:01:00', '2016-02-19 15:45:21', 'SIP/8016-00007ec0', 'SIP/trunk231-00007ec1', 'ANSWERED', '1455867921.32494', '');
INSERT INTO `thaa` VALUES ('672', '8017', '18620012027', '00:00:07', '00:01:35', '2016-02-19 15:45:22', 'SIP/8017-00007ec2', 'SIP/trunk231-00007ec3', 'ANSWERED', '1455867922.32496', '');
INSERT INTO `thaa` VALUES ('673', '8006', '13613004110', '00:00:08', '00:00:00', '2016-02-19 15:50:30', 'SIP/8006-00007ec4', 'SIP/trunk231-00007ec5', 'NO ANSWER', '1455868230.32498', '');
INSERT INTO `thaa` VALUES ('674', '8006', '013613004110', '00:00:55', '00:00:00', '2016-02-19 15:51:01', 'SIP/8006-00007ec6', 'SIP/trunk231-00007ec7', 'NO ANSWER', '1455868261.32500', '');
INSERT INTO `thaa` VALUES ('675', '8006', '15018440676', '00:00:14', '00:00:54', '2016-02-19 15:52:39', 'SIP/8006-00007ec8', 'SIP/trunk231-00007ec9', 'ANSWERED', '1455868359.32502', '');
INSERT INTO `thaa` VALUES ('676', '13613004110', '8006', '00:00:07', '00:00:56', '2016-02-19 16:04:23', 'SIP/trunk231-00007eca', 'SIP/8006-00007ecb', 'ANSWERED', '1455869063.32504', '');
INSERT INTO `thaa` VALUES ('677', '8010', '18620018618', '00:00:15', '00:03:01', '2016-02-19 16:15:48', 'SIP/8010-00007ecc', 'SIP/trunk231-00007ecd', 'ANSWERED', '1455869748.32506', '');
INSERT INTO `thaa` VALUES ('678', '8006', '15179146540', '00:00:06', '00:00:00', '2016-02-19 16:17:30', 'SIP/8006-00007ece', 'SIP/trunk231-00007ecf', 'NO ANSWER', '1455869850.32508', '');
INSERT INTO `thaa` VALUES ('679', '8006', '015179146540', '00:00:55', '00:00:00', '2016-02-19 16:17:50', 'SIP/8006-00007ed0', 'SIP/trunk231-00007ed1', 'NO ANSWER', '1455869870.32510', '');
INSERT INTO `thaa` VALUES ('680', '8006', '15602327707', '00:00:14', '00:00:00', '2016-02-19 16:23:02', 'SIP/8006-00007ed2', 'SIP/trunk231-00007ed3', 'NO ANSWER', '1455870182.32512', '');
INSERT INTO `thaa` VALUES ('681', '8006', '15602327707', '00:00:11', '00:00:45', '2016-02-19 16:23:28', 'SIP/8006-00007ed4', 'SIP/trunk231-00007ed5', 'ANSWERED', '1455870208.32514', '');
INSERT INTO `thaa` VALUES ('682', '8006', '15907511542', '00:00:07', '00:00:00', '2016-02-19 16:36:59', 'SIP/8006-00007ed6', 'SIP/trunk231-00007ed7', 'NO ANSWER', '1455871019.32516', '');
INSERT INTO `thaa` VALUES ('683', '8006', '015907511542', '00:00:15', '00:00:51', '2016-02-19 16:37:45', 'SIP/8006-00007ed8', 'SIP/trunk231-00007ed9', 'ANSWERED', '1455871065.32518', '');
INSERT INTO `thaa` VALUES ('684', '8006', '13711163601', '00:00:21', '00:00:00', '2016-02-19 16:42:30', 'SIP/8006-00007eda', 'SIP/trunk231-00007edb', 'NO ANSWER', '1455871350.32520', '');
INSERT INTO `thaa` VALUES ('685', '8006', '13711163601', '00:00:22', '00:00:00', '2016-02-19 16:43:36', 'SIP/8006-00007edc', 'SIP/trunk231-00007edd', 'NO ANSWER', '1455871416.32522', '');
INSERT INTO `thaa` VALUES ('686', '8006', '13711163601', '00:00:22', '00:00:00', '2016-02-19 16:44:15', 'SIP/8006-00007ede', 'SIP/trunk231-00007edf', 'NO ANSWER', '1455871455.32524', '');
INSERT INTO `thaa` VALUES ('687', '8006', '13212796171', '00:00:05', '00:00:00', '2016-02-19 16:46:01', 'SIP/8006-00007ee0', 'SIP/trunk231-00007ee1', 'NO ANSWER', '1455871561.32526', '');
INSERT INTO `thaa` VALUES ('688', '8006', '013212796171', '00:00:55', '00:00:00', '2016-02-19 16:46:18', 'SIP/8006-00007ee2', 'SIP/trunk231-00007ee3', 'NO ANSWER', '1455871578.32528', '');
INSERT INTO `thaa` VALUES ('689', '8009', '15989037918', '00:00:16', '00:00:27', '2016-02-19 16:48:09', 'SIP/8009-00007ee4', 'SIP/trunk231-00007ee5', 'ANSWERED', '1455871689.32530', '');
INSERT INTO `thaa` VALUES ('690', '13212796171', '8006', '00:00:34', '00:00:00', '2016-02-19 16:50:27', 'SIP/trunk231-00007ee6', 'SIP/8006-00007ee7', 'NO ANSWER', '1455871827.32532', '');
INSERT INTO `thaa` VALUES ('691', '8006', '013212796171', '00:00:14', '00:00:44', '2016-02-19 16:52:15', 'SIP/8006-00007ee8', 'SIP/trunk231-00007ee9', 'ANSWERED', '1455871935.32534', '');
INSERT INTO `thaa` VALUES ('692', '8009', '13609010119', '00:00:17', '00:01:43', '2016-02-19 16:57:12', 'SIP/8009-00007eea', 'SIP/trunk231-00007eeb', 'ANSWERED', '1455872232.32536', '');
INSERT INTO `thaa` VALUES ('693', '8009', '15989037918', '00:00:20', '00:00:25', '2016-02-19 17:03:23', 'SIP/8009-00007eec', 'SIP/trunk231-00007eed', 'ANSWERED', '1455872603.32538', '');
INSERT INTO `thaa` VALUES ('694', '8006', '18520261312', '00:00:11', '00:00:59', '2016-02-19 17:19:44', 'SIP/8006-00007eee', 'SIP/trunk231-00007eef', 'ANSWERED', '1455873584.32540', '');
INSERT INTO `thaa` VALUES ('695', '', 'failed', '00:00:00', '00:00:00', '2016-02-19 17:26:03', 'OutgoingSpoolFailed', '', 'NO ANSWER', '1455873963.32544', '');
INSERT INTO `thaa` VALUES ('696', '8041', '13527743279', '00:00:14', '00:00:00', '2016-02-19 17:26:03', 'SIP/8041-00007ef0', 'SIP/trunk231-00007ef2', 'NO ANSWER', '1455873963.32542', '');
INSERT INTO `thaa` VALUES ('697', '8041', 's', '00:00:00', '00:00:00', '2016-02-19 17:26:03', 's-SIP/8041-00007ef1', 's-', 'BUSY', '1455873963.32543', '');
INSERT INTO `thaa` VALUES ('698', '8033', '13751852090', '00:00:26', '00:00:45', '2016-02-19 17:43:15', 'SIP/8033-00007ef3', 'SIP/trunk231-00007ef4', 'ANSWERED', '1455874995.32546', '');
INSERT INTO `thaa` VALUES ('699', '8001', '8030', '00:00:06', '00:00:00', '2016-02-19 17:59:23', 'SIP/8001-00007ef5', 'SIP/8030-00007ef6', 'NO ANSWER', '1455875963.32548', '');
INSERT INTO `thaa` VALUES ('700', '29873390', '8056', '00:00:00', '00:01:03', '2016-02-20 10:35:34', 'SIP/trunk231-00007ef7', 'SIP/8056-00007ef8', 'FAILED', '1455935734.32550', '');
INSERT INTO `thaa` VALUES ('701', '29873390', '8056', '00:00:46', '00:00:00', '2016-02-20 10:37:11', 'SIP/trunk231-00007ef9', 'SIP/8056-00007efa', 'NO ANSWER', '1455935831.32552', '');
INSERT INTO `thaa` VALUES ('702', '29873390', '8000', '00:00:46', '00:00:00', '2016-02-20 10:38:22', 'SIP/trunk231-00007efb', 'SIP/8000-00007efc', 'NO ANSWER', '1455935902.32554', '');
INSERT INTO `thaa` VALUES ('703', '18910537987', '8024', '00:00:43', '00:00:00', '2016-02-20 11:47:52', 'SIP/trunk231-00007efd', 'SIP/8024-00007efe', 'NO ANSWER', '1455940072.32556', '');
INSERT INTO `thaa` VALUES ('704', '18910537987', '8028', '00:00:49', '00:00:00', '2016-02-20 11:48:48', 'SIP/trunk231-00007eff', 'SIP/8028-00007f00', 'NO ANSWER', '1455940128.32558', '');
INSERT INTO `thaa` VALUES ('705', '18910537987', '8024', '00:00:55', '00:00:00', '2016-02-20 12:04:43', 'SIP/trunk231-00007f01', 'SIP/8024-00007f02', 'FAILED', '1455941083.32560', '');
INSERT INTO `thaa` VALUES ('706', '18910537987', '8028', '00:00:42', '00:00:00', '2016-02-20 12:05:54', 'SIP/trunk231-00007f03', 'SIP/8028-00007f04', 'NO ANSWER', '1455941154.32562', '');
INSERT INTO `thaa` VALUES ('707', '8053', '13503040161', '00:00:25', '00:01:56', '2016-02-22 09:13:29', 'SIP/8053-00007f05', 'SIP/trunk231-00007f06', 'ANSWERED', '1456103609.32564', '');
INSERT INTO `thaa` VALUES ('708', '8053', '13610140910', '00:00:14', '00:02:44', '2016-02-22 09:20:40', 'SIP/8053-00007f07', 'SIP/trunk231-00007f08', 'ANSWERED', '1456104040.32566', '');
INSERT INTO `thaa` VALUES ('709', '13613004110', '8006', '00:00:06', '00:00:36', '2016-02-22 09:23:11', 'SIP/trunk231-00007f09', 'SIP/8006-00007f0a', 'ANSWERED', '1456104191.32568', '');
INSERT INTO `thaa` VALUES ('710', '8017', '18620012160', '00:00:09', '00:00:39', '2016-02-22 09:30:04', 'SIP/8017-00007f0b', 'SIP/trunk231-00007f0c', 'ANSWERED', '1456104604.32570', '');
INSERT INTO `thaa` VALUES ('711', '8017', '18022388353', '00:00:12', '00:00:00', '2016-02-22 09:31:53', 'SIP/8017-00007f0d', 'SIP/trunk231-00007f0e', 'NO ANSWER', '1456104713.32572', '');
INSERT INTO `thaa` VALUES ('712', '8017', '18022381739', '00:00:26', '00:02:44', '2016-02-22 09:32:26', 'SIP/8017-00007f0f', 'SIP/trunk231-00007f10', 'ANSWERED', '1456104746.32574', '');
INSERT INTO `thaa` VALUES ('713', '8032', '18620014715', '00:00:28', '00:00:00', '2016-02-22 09:33:25', 'SIP/8032-00007f11', 'SIP/trunk231-00007f12', 'NO ANSWER', '1456104805.32576', '');
INSERT INTO `thaa` VALUES ('714', '8050', '13760601451', '00:00:12', '00:01:32', '2016-02-22 09:34:54', 'SIP/8050-00007f13', 'SIP/trunk231-00007f14', 'ANSWERED', '1456104894.32578', '');
INSERT INTO `thaa` VALUES ('715', '8017', '18620012160', '00:00:13', '00:01:17', '2016-02-22 09:36:13', 'SIP/8017-00007f15', 'SIP/trunk231-00007f16', 'ANSWERED', '1456104973.32580', '');
INSERT INTO `thaa` VALUES ('716', '8050', '13760601451', '00:00:07', '00:00:59', '2016-02-22 09:37:50', 'SIP/8050-00007f17', 'SIP/trunk231-00007f18', 'ANSWERED', '1456105070.32582', '');
INSERT INTO `thaa` VALUES ('717', '8000', '4007003363', '00:00:03', '00:04:30', '2016-02-22 09:42:11', 'SIP/8000-00007f19', 'SIP/trunk231-00007f1a', 'ANSWERED', '1456105331.32584', '');
INSERT INTO `thaa` VALUES ('718', '8001', '8020', '00:00:17', '00:00:00', '2016-02-22 09:45:58', 'SIP/8001-00007f1b', 'SIP/8020-00007f1c', 'NO ANSWER', '1456105558.32586', '');
INSERT INTO `thaa` VALUES ('719', '8001', '18620018618', '00:00:11', '00:02:36', '2016-02-22 09:46:26', 'SIP/8001-00007f1d', 'SIP/trunk231-00007f1e', 'ANSWERED', '1456105586.32588', '');
INSERT INTO `thaa` VALUES ('720', '8030', '22992471', '00:00:19', '00:00:00', '2016-02-22 09:47:24', 'SIP/8030-00007f1f', 'SIP/trunk231-00007f20', 'NO ANSWER', '1456105644.32590', '');
INSERT INTO `thaa` VALUES ('721', '8030', '18620018801', '00:00:53', '00:00:00', '2016-02-22 09:47:51', 'SIP/8030-00007f21', 'SIP/trunk231-00007f22', 'NO ANSWER', '1456105671.32592', '');
INSERT INTO `thaa` VALUES ('722', '8017', '18620012027', '00:00:19', '00:01:41', '2016-02-22 09:50:29', 'SIP/8017-00007f23', 'SIP/trunk231-00007f24', 'ANSWERED', '1456105829.32594', '');
INSERT INTO `thaa` VALUES ('723', '18820785617', '8006', '00:00:11', '00:01:42', '2016-02-22 09:51:31', 'SIP/trunk231-00007f25', 'SIP/8006-00007f26', 'ANSWERED', '1456105891.32596', '');
INSERT INTO `thaa` VALUES ('724', '8000', '18922318990', '00:00:15', '00:00:39', '2016-02-22 09:55:19', 'SIP/8000-00007f27', 'SIP/trunk231-00007f28', 'ANSWERED', '1456106119.32598', '');
INSERT INTO `thaa` VALUES ('725', '22991021', '8017', '00:00:05', '00:04:42', '2016-02-22 10:02:46', 'SIP/trunk231-00007f29', 'SIP/8017-00007f2a', 'ANSWERED', '1456106566.32600', '');
INSERT INTO `thaa` VALUES ('726', '8088', '8009', '00:00:17', '00:00:00', '2016-02-22 10:03:49', 'SIP/8088-00007f2b', 'SIP/8009-00007f2c', 'NO ANSWER', '1456106629.32602', '');
INSERT INTO `thaa` VALUES ('727', '8000', '18922318990', '00:00:16', '00:00:26', '2016-02-22 10:06:13', 'SIP/8000-00007f2d', 'SIP/trunk231-00007f2e', 'ANSWERED', '1456106773.32604', '');
INSERT INTO `thaa` VALUES ('728', '8009', '8088', '00:00:23', '00:00:00', '2016-02-22 10:08:25', 'SIP/8009-00007f2f', 'SIP/8088-00007f30', 'NO ANSWER', '1456106905.32606', '');
INSERT INTO `thaa` VALUES ('729', '8000', '4007003363', '00:00:03', '00:02:51', '2016-02-22 10:10:41', 'SIP/8000-00007f31', 'SIP/trunk231-00007f32', 'ANSWERED', '1456107041.32608', '');
INSERT INTO `thaa` VALUES ('730', '8041', '13213124321', '00:00:04', '00:00:00', '2016-02-22 10:11:37', 'SIP/8041-00007f33', 'SIP/trunk231-00007f34', 'NO ANSWER', '1456107097.32610', '');
INSERT INTO `thaa` VALUES ('731', '8041', '013213124321', '00:00:07', '00:00:00', '2016-02-22 10:15:02', 'SIP/8041-00007f35', 'SIP/trunk231-00007f36', 'NO ANSWER', '1456107302.32612', '');
INSERT INTO `thaa` VALUES ('732', '8000', '38483468', '00:00:01', '00:00:31', '2016-02-22 10:15:45', 'SIP/8000-00007f37', 'SIP/trunk231-00007f38', 'ANSWERED', '1456107345.32614', '');
INSERT INTO `thaa` VALUES ('733', '8000', '38483468', '00:00:03', '00:00:31', '2016-02-22 10:16:03', 'SIP/8000-00007f39', 'SIP/trunk231-00007f3a', 'ANSWERED', '1456107363.32616', '');
INSERT INTO `thaa` VALUES ('734', '8000', '38483468', '00:00:13', '00:00:31', '2016-02-22 10:16:39', 'SIP/8000-00007f3b', 'SIP/trunk231-00007f3c', 'ANSWERED', '1456107399.32618', '');
INSERT INTO `thaa` VALUES ('735', '8017', '18620017530', '00:00:55', '00:00:00', '2016-02-22 10:20:27', 'SIP/8017-00007f3d', 'SIP/trunk231-00007f3e', 'NO ANSWER', '1456107627.32620', '');
INSERT INTO `thaa` VALUES ('736', '18620017530', '8017', '00:00:06', '00:01:10', '2016-02-22 10:22:26', 'SIP/trunk231-00007f3f', 'SIP/8017-00007f40', 'ANSWERED', '1456107746.32622', '');
INSERT INTO `thaa` VALUES ('737', '8056', '137', '00:00:00', '00:00:00', '2016-02-22 10:22:41', 'SIP/8056-00007f41', 'SIP/trunk231-00007f42', 'NO ANSWER', '1456107761.32624', '');
INSERT INTO `thaa` VALUES ('738', '8061', '18620012071', '00:00:12', '00:00:57', '2016-02-22 10:23:56', 'SIP/8061-00007f43', 'SIP/trunk231-00007f44', 'ANSWERED', '1456107836.32626', '');
INSERT INTO `thaa` VALUES ('739', '13212796171', '8006', '00:00:37', '00:02:10', '2016-02-22 10:47:22', 'SIP/trunk231-00007f45', 'SIP/8006-00007f46', 'ANSWERED', '1456109242.32628', '');
INSERT INTO `thaa` VALUES ('740', '8001', '8020', '00:00:05', '00:00:06', '2016-02-22 10:50:24', 'SIP/8001-00007f47', 'SIP/8020-00007f48', 'ANSWERED', '1456109424.32630', '');
INSERT INTO `thaa` VALUES ('741', '8056', '8008', '00:00:04', '00:02:35', '2016-02-22 11:05:46', 'SIP/8056-00007f49', 'SIP/8008-00007f4a', 'ANSWERED', '1456110346.32632', '');
INSERT INTO `thaa` VALUES ('742', '8020', '18620018919', '00:00:10', '00:02:55', '2016-02-22 11:13:50', 'SIP/8020-00007f4b', 'SIP/trunk231-00007f4c', 'ANSWERED', '1456110830.32634', '');
INSERT INTO `thaa` VALUES ('743', '8020', '18620018618', '00:00:09', '00:01:06', '2016-02-22 11:17:08', 'SIP/8020-00007f4d', 'SIP/trunk231-00007f4e', 'ANSWERED', '1456111028.32636', '');
INSERT INTO `thaa` VALUES ('744', '18655246212', '8063', '00:00:55', '00:00:00', '2016-02-22 11:18:31', 'SIP/trunk231-00007f4f', 'SIP/8063-00007f50', 'FAILED', '1456111111.32638', '');
INSERT INTO `thaa` VALUES ('745', '8058', '18680287955', '00:00:07', '00:00:00', '2016-02-22 11:23:49', 'SIP/8058-00007f51', 'SIP/trunk231-00007f52', 'NO ANSWER', '1456111429.32640', '');
INSERT INTO `thaa` VALUES ('746', '8033', '18922296308', '00:00:41', '00:00:00', '2016-02-22 11:26:25', 'SIP/8033-00007f53', 'SIP/trunk231-00007f54', 'NO ANSWER', '1456111585.32642', '');
INSERT INTO `thaa` VALUES ('747', '8033', '18922296308', '00:00:55', '00:00:00', '2016-02-22 11:27:13', 'SIP/8033-00007f55', 'SIP/trunk231-00007f56', 'NO ANSWER', '1456111633.32644', '');
INSERT INTO `thaa` VALUES ('748', '075789923585', '8056', '00:00:08', '00:00:43', '2016-02-22 11:27:28', 'SIP/trunk231-00007f57', 'SIP/8056-00007f58', 'ANSWERED', '1456111648.32646', '');
INSERT INTO `thaa` VALUES ('749', '8059', '87564403', '00:00:10', '00:00:15', '2016-02-22 11:29:40', 'SIP/8059-00007f59', 'SIP/trunk231-00007f5a', 'ANSWERED', '1456111780.32648', '');
INSERT INTO `thaa` VALUES ('750', '8059', '87564403', '00:00:11', '00:00:07', '2016-02-22 11:30:17', 'SIP/8059-00007f5b', 'SIP/trunk231-00007f5c', 'ANSWERED', '1456111817.32650', '');
INSERT INTO `thaa` VALUES ('751', '8033', '18922296308', '00:00:24', '00:00:00', '2016-02-22 11:30:38', 'SIP/8033-00007f5d', 'SIP/trunk231-00007f5e', 'NO ANSWER', '1456111838.32652', '');
INSERT INTO `thaa` VALUES ('752', '8059', '87564955', '00:00:11', '00:00:31', '2016-02-22 11:30:45', 'SIP/8059-00007f5f', 'SIP/trunk231-00007f60', 'ANSWERED', '1456111845.32654', '');
INSERT INTO `thaa` VALUES ('753', '18922296308', '8033', '00:00:03', '00:00:21', '2016-02-22 11:34:16', 'SIP/trunk231-00007f61', 'SIP/8033-00007f62', 'ANSWERED', '1456112056.32656', '');
INSERT INTO `thaa` VALUES ('754', '8025', '18666083656', '00:00:50', '00:00:00', '2016-02-22 11:56:33', 'SIP/8025-00007f63', 'SIP/trunk231-00007f64', 'NO ANSWER', '1456113393.32658', '');
INSERT INTO `thaa` VALUES ('755', '8025', '18666083656', '00:00:46', '00:00:00', '2016-02-22 11:57:37', 'SIP/8025-00007f65', 'SIP/trunk231-00007f66', 'NO ANSWER', '1456113457.32660', '');
INSERT INTO `thaa` VALUES ('756', '13802426071', '8006', '00:00:11', '00:01:10', '2016-02-22 12:06:31', 'SIP/trunk231-00007f67', 'SIP/8006-00007f68', 'ANSWERED', '1456113991.32662', '');
INSERT INTO `thaa` VALUES ('757', '8011', '22310010', '00:00:04', '00:00:17', '2016-02-22 12:15:55', 'SIP/8011-00007f69', 'SIP/trunk231-00007f6a', 'ANSWERED', '1456114555.32664', '');
INSERT INTO `thaa` VALUES ('758', '8017', '22082237', '00:00:05', '00:00:39', '2016-02-22 13:42:56', 'SIP/8017-00007f6b', 'SIP/trunk231-00007f6c', 'ANSWERED', '1456119776.32666', '');
INSERT INTO `thaa` VALUES ('759', '8017', '18933995456', '00:00:18', '00:01:13', '2016-02-22 13:44:42', 'SIP/8017-00007f6d', 'SIP/trunk231-00007f6e', 'ANSWERED', '1456119882.32668', '');
INSERT INTO `thaa` VALUES ('760', '8017', '18022388353', '00:00:26', '00:00:00', '2016-02-22 13:51:22', 'SIP/8017-00007f6f', 'SIP/trunk231-00007f70', 'NO ANSWER', '1456120282.32670', '');
INSERT INTO `thaa` VALUES ('761', '8018', '15914346909', '00:00:11', '00:02:42', '2016-02-22 13:54:22', 'SIP/8018-00007f71', 'SIP/trunk231-00007f72', 'ANSWERED', '1456120462.32672', '');
INSERT INTO `thaa` VALUES ('762', '8009', '18998302169', '00:00:11', '00:00:31', '2016-02-22 14:12:32', 'SIP/8009-00007f73', 'SIP/trunk231-00007f74', 'ANSWERED', '1456121552.32674', '');
INSERT INTO `thaa` VALUES ('763', '83953417', '8006', '00:00:55', '00:00:00', '2016-02-22 14:19:04', 'SIP/trunk231-00007f75', 'SIP/8006-00007f76', 'FAILED', '1456121944.32676', '');
INSERT INTO `thaa` VALUES ('764', '8023', '18602011060', '00:00:21', '00:00:00', '2016-02-22 14:29:40', 'SIP/8023-00007f77', 'SIP/trunk231-00007f78', 'NO ANSWER', '1456122580.32678', '');
INSERT INTO `thaa` VALUES ('765', '8052', '18620012822', '00:00:15', '00:00:53', '2016-02-22 14:52:51', 'SIP/8052-00007f79', 'SIP/trunk231-00007f7a', 'ANSWERED', '1456123971.32680', '');
INSERT INTO `thaa` VALUES ('766', '8006', '13672400428', '00:00:14', '00:00:43', '2016-02-22 14:55:09', 'SIP/8006-00007f7b', 'SIP/trunk231-00007f7c', 'ANSWERED', '1456124109.32682', '');
INSERT INTO `thaa` VALUES ('767', '8006', '18613053689', '00:00:55', '00:00:00', '2016-02-22 15:01:06', 'SIP/8006-00007f7d', 'SIP/trunk231-00007f7e', 'NO ANSWER', '1456124466.32684', '');
INSERT INTO `thaa` VALUES ('768', '8006', '13922255104', '00:00:09', '00:00:47', '2016-02-22 15:02:58', 'SIP/8006-00007f7f', 'SIP/trunk231-00007f80', 'ANSWERED', '1456124578.32686', '');
INSERT INTO `thaa` VALUES ('769', '8001', '18620018618', '00:00:09', '00:00:47', '2016-02-22 15:03:24', 'SIP/8001-00007f81', 'SIP/trunk231-00007f82', 'ANSWERED', '1456124604.32688', '');
INSERT INTO `thaa` VALUES ('770', '18613053689', '8006', '00:00:06', '00:01:23', '2016-02-22 15:04:01', 'SIP/trunk231-00007f83', 'SIP/8006-00007f84', 'ANSWERED', '1456124641.32690', '');
INSERT INTO `thaa` VALUES ('771', '8009', '18520093421', '00:00:07', '00:04:48', '2016-02-22 15:06:16', 'SIP/8009-00007f85', 'SIP/trunk231-00007f86', 'ANSWERED', '1456124776.32692', '');
INSERT INTO `thaa` VALUES ('772', '8006', '15768426832', '00:00:06', '00:00:00', '2016-02-22 15:10:10', 'SIP/8006-00007f87', 'SIP/trunk231-00007f88', 'NO ANSWER', '1456125010.32694', '');
INSERT INTO `thaa` VALUES ('773', '8006', '015768426832', '00:00:43', '00:01:59', '2016-02-22 15:10:28', 'SIP/8006-00007f89', 'SIP/trunk231-00007f8a', 'ANSWERED', '1456125028.32696', '');
INSERT INTO `thaa` VALUES ('774', '8017', '82087856', '00:00:34', '00:00:10', '2016-02-22 15:11:18', 'SIP/8017-00007f8b', 'SIP/trunk231-00007f8c', 'ANSWERED', '1456125078.32698', '');
INSERT INTO `thaa` VALUES ('775', '8023', '18602011060', '00:00:30', '00:00:00', '2016-02-22 15:22:29', 'SIP/8023-00007f8d', 'SIP/trunk231-00007f8e', 'NO ANSWER', '1456125749.32700', '');
INSERT INTO `thaa` VALUES ('776', '8032', '18620012015', '00:00:20', '00:01:28', '2016-02-22 15:25:59', 'SIP/8032-00007f8f', 'SIP/trunk231-00007f90', 'ANSWERED', '1456125959.32702', '');
INSERT INTO `thaa` VALUES ('777', '8050', '13760601451', '00:00:14', '00:00:01', '2016-02-22 15:27:12', 'SIP/8050-00007f91', 'SIP/trunk231-00007f92', 'ANSWERED', '1456126032.32704', '');
INSERT INTO `thaa` VALUES ('778', '8050', '13760601451', '00:00:08', '00:01:35', '2016-02-22 15:27:36', 'SIP/8050-00007f93', 'SIP/trunk231-00007f94', 'ANSWERED', '1456126056.32706', '');
INSERT INTO `thaa` VALUES ('779', '8006', '13729816340', '00:00:10', '00:03:03', '2016-02-22 15:30:26', 'SIP/8006-00007f95', 'SIP/trunk231-00007f96', 'ANSWERED', '1456126226.32708', '');
INSERT INTO `thaa` VALUES ('780', '8023', '18602011060', '00:00:09', '00:00:00', '2016-02-22 15:32:05', 'SIP/8023-00007f97', 'SIP/trunk231-00007f98', 'NO ANSWER', '1456126325.32710', '');
INSERT INTO `thaa` VALUES ('781', '8006', '13533923', '00:00:00', '00:00:00', '2016-02-22 15:35:41', 'SIP/8006-00007f99', 'SIP/trunk231-00007f9a', 'FAILED', '1456126541.32712', '');
INSERT INTO `thaa` VALUES ('782', '8006', '1353392326', '00:00:00', '00:00:00', '2016-02-22 15:35:51', 'SIP/8006-00007f9b', 'SIP/trunk231-00007f9c', 'FAILED', '1456126551.32714', '');
INSERT INTO `thaa` VALUES ('783', '8006', '13533923926', '00:00:12', '00:00:51', '2016-02-22 15:36:05', 'SIP/8006-00007f9d', 'SIP/trunk231-00007f9e', 'ANSWERED', '1456126565.32716', '');
INSERT INTO `thaa` VALUES ('784', '8032', '18664638589', '00:00:32', '00:01:02', '2016-02-22 15:36:52', 'SIP/8032-00007f9f', 'SIP/trunk231-00007fa0', 'ANSWERED', '1456126612.32718', '');
INSERT INTO `thaa` VALUES ('785', '8032', '22310010', '00:00:04', '00:03:43', '2016-02-22 15:56:08', 'SIP/8032-00007fa1', 'SIP/trunk231-00007fa2', 'ANSWERED', '1456127768.32720', '');
INSERT INTO `thaa` VALUES ('786', '18588925196', '8032', '00:00:05', '00:01:43', '2016-02-22 16:06:10', 'SIP/trunk231-00007fa3', 'SIP/8032-00007fa4', 'ANSWERED', '1456128370.32722', '');
INSERT INTO `thaa` VALUES ('787', '8006', '15364155215', '00:00:04', '00:00:00', '2016-02-22 16:10:05', 'SIP/8006-00007fa5', 'SIP/trunk231-00007fa6', 'NO ANSWER', '1456128605.32724', '');
INSERT INTO `thaa` VALUES ('788', '8006', '015364155215', '00:00:54', '00:00:00', '2016-02-22 16:10:18', 'SIP/8006-00007fa7', 'SIP/trunk231-00007fa8', 'NO ANSWER', '1456128618.32726', '');
INSERT INTO `thaa` VALUES ('789', '8006', '13265956126', '00:00:09', '00:00:43', '2016-02-22 16:11:32', 'SIP/8006-00007fa9', 'SIP/trunk231-00007faa', 'ANSWERED', '1456128692.32728', '');
INSERT INTO `thaa` VALUES ('790', '8006', '13249770813', '00:00:11', '00:00:41', '2016-02-22 16:16:51', 'SIP/8006-00007fab', 'SIP/trunk231-00007fac', 'ANSWERED', '1456129011.32730', '');
INSERT INTO `thaa` VALUES ('791', '8017', '22310010', '00:00:04', '00:04:05', '2016-02-22 16:22:18', 'SIP/8017-00007fad', 'SIP/trunk231-00007fae', 'ANSWERED', '1456129338.32732', '');
INSERT INTO `thaa` VALUES ('792', '8017', '18620015623', '00:00:08', '00:02:06', '2016-02-22 16:27:17', 'SIP/8017-00007faf', 'SIP/trunk231-00007fb0', 'ANSWERED', '1456129637.32734', '');
INSERT INTO `thaa` VALUES ('793', '8006', '13724116739', '00:00:07', '00:01:01', '2016-02-22 16:27:50', 'SIP/8006-00007fb1', 'SIP/trunk231-00007fb2', 'ANSWERED', '1456129670.32736', '');
INSERT INTO `thaa` VALUES ('794', '8003', '18602019573', '00:00:05', '00:01:46', '2016-02-22 16:28:02', 'SIP/8003-00007fb3', 'SIP/trunk231-00007fb4', 'ANSWERED', '1456129682.32738', '');
INSERT INTO `thaa` VALUES ('795', '8050', '8009', '00:00:03', '00:00:03', '2016-02-22 16:31:14', 'SIP/8050-00007fb5', 'SIP/8009-00007fb6', 'ANSWERED', '1456129874.32740', '');
INSERT INTO `thaa` VALUES ('796', '8020', '18680287765', '00:00:15', '00:01:15', '2016-02-22 17:21:13', 'SIP/8020-00007fb7', 'SIP/trunk231-00007fb8', 'ANSWERED', '1456132873.32742', '');
INSERT INTO `thaa` VALUES ('797', '8009', '8050', '00:00:03', '00:00:29', '2016-02-23 09:04:25', 'SIP/8009-00007fb9', 'SIP/8050-00007fba', 'ANSWERED', '1456189465.32744', '');
INSERT INTO `thaa` VALUES ('798', '22992471', '8030', '00:00:07', '00:00:21', '2016-02-23 09:05:13', 'SIP/trunk231-00007fbb', 'SIP/8030-00007fbc', 'ANSWERED', '1456189513.32746', '');
INSERT INTO `thaa` VALUES ('799', '8009', '075586128050', '00:00:05', '00:00:08', '2016-02-23 09:14:31', 'SIP/8009-00007fbd', 'SIP/trunk231-00007fbe', 'ANSWERED', '1456190071.32748', '');
INSERT INTO `thaa` VALUES ('800', '8009', '075586128531', '00:00:08', '00:02:01', '2016-02-23 09:14:54', 'SIP/8009-00007fbf', 'SIP/trunk231-00007fc0', 'ANSWERED', '1456190094.32750', '');
INSERT INTO `thaa` VALUES ('801', '22996211', '8020', '00:00:05', '00:00:43', '2016-02-23 09:15:41', 'SIP/trunk231-00007fc1', 'SIP/8020-00007fc2', 'ANSWERED', '1456190141.32752', '');
INSERT INTO `thaa` VALUES ('802', '8056', '81', '00:00:00', '00:00:00', '2016-02-23 09:16:12', 'SIP/8056-00007fc3', 'SIP/trunk231-00007fc4', 'FAILED', '1456190172.32754', '');
INSERT INTO `thaa` VALUES ('803', '8056', '89207156', '00:00:06', '00:00:30', '2016-02-23 09:16:27', 'SIP/8056-00007fc5', 'SIP/trunk231-00007fc6', 'ANSWERED', '1456190187.32756', '');
INSERT INTO `thaa` VALUES ('804', '8009', '8050', '00:00:03', '00:02:14', '2016-02-23 09:17:11', 'SIP/8009-00007fc7', 'SIP/8050-00007fc8', 'ANSWERED', '1456190231.32758', '');
INSERT INTO `thaa` VALUES ('805', '8009', '13302335096', '00:00:37', '00:00:00', '2016-02-23 09:19:51', 'SIP/8009-00007fc9', 'SIP/trunk231-00007fca', 'NO ANSWER', '1456190391.32760', '');
INSERT INTO `thaa` VALUES ('806', '8009', '13602859043', '00:00:12', '00:00:00', '2016-02-23 09:21:59', 'SIP/8009-00007fcb', 'SIP/trunk231-00007fcc', 'NO ANSWER', '1456190519.32762', '');
INSERT INTO `thaa` VALUES ('807', '8009', '13602859043', '00:00:11', '00:01:25', '2016-02-23 09:22:20', 'SIP/8009-00007fcd', 'SIP/trunk231-00007fce', 'ANSWERED', '1456190540.32764', '');
INSERT INTO `thaa` VALUES ('808', '8009', '13302335096', '00:00:15', '00:00:00', '2016-02-23 09:28:13', 'SIP/8009-00007fcf', 'SIP/trunk231-00007fd0', 'FAILED', '1456190893.32766', '');
INSERT INTO `thaa` VALUES ('809', '8030', '22992471', '00:00:27', '00:00:00', '2016-02-23 09:28:18', 'SIP/8030-00007fd1', 'SIP/trunk231-00007fd2', 'NO ANSWER', '1456190898.32768', '');
INSERT INTO `thaa` VALUES ('810', '8030', '18620018801', '00:00:06', '00:00:00', '2016-02-23 09:28:52', 'SIP/8030-00007fd3', 'SIP/trunk231-00007fd4', 'NO ANSWER', '1456190932.32770', '');
INSERT INTO `thaa` VALUES ('811', '8020', '8061', '00:00:07', '00:00:43', '2016-02-23 09:35:11', 'SIP/8020-00007fd5', 'SIP/8061-00007fd6', 'ANSWERED', '1456191311.32772', '');
INSERT INTO `thaa` VALUES ('812', '8009', '15989037918', '00:00:20', '00:01:05', '2016-02-23 09:38:02', 'SIP/8009-00007fd7', 'SIP/trunk231-00007fd8', 'ANSWERED', '1456191482.32774', '');
INSERT INTO `thaa` VALUES ('813', '8032', '18588925196', '00:00:11', '00:00:50', '2016-02-23 09:38:58', 'SIP/8032-00007fd9', 'SIP/trunk231-00007fda', 'ANSWERED', '1456191538.32776', '');
INSERT INTO `thaa` VALUES ('814', '8052', '18620013671', '00:00:11', '00:00:55', '2016-02-23 09:40:04', 'SIP/8052-00007fdb', 'SIP/trunk231-00007fdc', 'ANSWERED', '1456191604.32778', '');
INSERT INTO `thaa` VALUES ('815', '8009', '015012963281', '00:00:55', '00:00:00', '2016-02-23 09:40:24', 'SIP/8009-00007fdd', 'SIP/trunk231-00007fde', 'NO ANSWER', '1456191624.32780', '');
INSERT INTO `thaa` VALUES ('816', '8032', '13724089125', '00:00:24', '00:00:00', '2016-02-23 09:41:01', 'SIP/8032-00007fdf', 'SIP/trunk231-00007fe0', 'NO ANSWER', '1456191661.32782', '');
INSERT INTO `thaa` VALUES ('817', '8032', '22807576', '00:00:04', '00:00:30', '2016-02-23 09:41:58', 'SIP/8032-00007fe1', 'SIP/trunk231-00007fe2', 'ANSWERED', '1456191718.32784', '');
INSERT INTO `thaa` VALUES ('818', '8009', '07', '00:00:01', '00:00:00', '2016-02-23 09:43:36', 'SIP/8009-00007fe3', 'SIP/trunk231-00007fe4', 'FAILED', '1456191816.32786', '');
INSERT INTO `thaa` VALUES ('819', '8009', '075525181332', '00:00:55', '00:00:00', '2016-02-23 09:43:52', 'SIP/8009-00007fe5', 'SIP/trunk231-00007fe6', 'NO ANSWER', '1456191832.32788', '');
INSERT INTO `thaa` VALUES ('820', '8032', '15018498339', '00:00:12', '00:01:01', '2016-02-23 09:48:07', 'SIP/8032-00007fe7', 'SIP/trunk231-00007fe8', 'ANSWERED', '1456192087.32790', '');
INSERT INTO `thaa` VALUES ('821', '8009', '13660628160', '00:00:11', '00:03:46', '2016-02-23 09:48:22', 'SIP/8009-00007fe9', 'SIP/trunk231-00007fea', 'ANSWERED', '1456192102.32792', '');
INSERT INTO `thaa` VALUES ('822', '8030', '18620018801', '00:00:05', '00:02:56', '2016-02-23 09:59:24', 'SIP/8030-00007feb', 'SIP/trunk231-00007fec', 'ANSWERED', '1456192764.32794', '');
INSERT INTO `thaa` VALUES ('823', '8001', '18620053312', '00:00:41', '00:00:00', '2016-02-23 10:01:19', 'SIP/8001-00007fed', 'SIP/trunk231-00007fee', 'NO ANSWER', '1456192879.32796', '');
INSERT INTO `thaa` VALUES ('824', '8001', '18620018618', '00:00:11', '00:00:40', '2016-02-23 10:05:05', 'SIP/8001-00007fef', 'SIP/trunk231-00007ff0', 'ANSWERED', '1456193105.32798', '');
INSERT INTO `thaa` VALUES ('825', '8009', '15989037918', '00:00:55', '00:00:00', '2016-02-23 10:05:40', 'SIP/8009-00007ff1', 'SIP/trunk231-00007ff2', 'NO ANSWER', '1456193140.32800', '');
INSERT INTO `thaa` VALUES ('826', '15989037918', '8009', '00:00:03', '00:02:23', '2016-02-23 10:08:13', 'SIP/trunk231-00007ff3', 'SIP/8009-00007ff4', 'ANSWERED', '1456193293.32802', '');
INSERT INTO `thaa` VALUES ('827', '13724116739', '8006', '00:00:11', '00:02:33', '2016-02-23 10:12:29', 'SIP/trunk231-00007ff5', 'SIP/8006-00007ff6', 'ANSWERED', '1456193549.32804', '');
INSERT INTO `thaa` VALUES ('828', '18620012015', '8032', '00:00:42', '00:00:12', '2016-02-23 10:16:25', 'SIP/trunk231-00007ff7', 'SIP/8032-00007ff8', 'ANSWERED', '1456193785.32806', '');
INSERT INTO `thaa` VALUES ('829', '28602018', '8009', '00:00:05', '00:01:04', '2016-02-23 10:19:45', 'SIP/trunk231-00007ff9', 'SIP/8009-00007ffa', 'ANSWERED', '1456193985.32808', '');
INSERT INTO `thaa` VALUES ('830', '8032', '18620012015', '00:00:09', '00:00:00', '2016-02-23 10:20:19', 'SIP/8032-00007ffb', 'SIP/trunk231-00007ffc', 'NO ANSWER', '1456194019.32810', '');
INSERT INTO `thaa` VALUES ('831', '8032', '18620012015', '00:00:06', '00:00:00', '2016-02-23 10:21:39', 'SIP/8032-00007ffd', 'SIP/trunk231-00007ffe', 'NO ANSWER', '1456194099.32812', '');
INSERT INTO `thaa` VALUES ('832', '8009', '913691996376', '00:00:07', '00:00:00', '2016-02-23 10:23:11', 'SIP/8009-00007fff', 'SIP/trunk231-00008000', 'NO ANSWER', '1456194191.32814', '');
INSERT INTO `thaa` VALUES ('833', '8009', '013691996376', '00:00:46', '00:00:00', '2016-02-23 10:23:42', 'SIP/8009-00008001', 'SIP/trunk231-00008002', 'NO ANSWER', '1456194222.32816', '');
INSERT INTO `thaa` VALUES ('834', '8006', '13480385484', '00:00:05', '00:00:00', '2016-02-23 10:24:24', 'SIP/8006-00008003', 'SIP/trunk231-00008004', 'NO ANSWER', '1456194264.32818', '');
INSERT INTO `thaa` VALUES ('835', '8006', '013480385484', '00:00:13', '00:00:43', '2016-02-23 10:24:42', 'SIP/8006-00008005', 'SIP/trunk231-00008006', 'ANSWERED', '1456194282.32820', '');
INSERT INTO `thaa` VALUES ('836', '18620012015', '8032', '00:00:06', '00:00:56', '2016-02-23 10:25:38', 'SIP/trunk231-00008007', 'SIP/8032-00008008', 'ANSWERED', '1456194338.32822', '');
INSERT INTO `thaa` VALUES ('837', '8006', '13523822917', '00:00:05', '00:00:00', '2016-02-23 10:28:48', 'SIP/8006-00008009', 'SIP/trunk231-0000800a', 'NO ANSWER', '1456194528.32824', '');
INSERT INTO `thaa` VALUES ('838', '8006', '013523822917', '00:00:19', '00:00:46', '2016-02-23 10:29:05', 'SIP/8006-0000800b', 'SIP/trunk231-0000800c', 'ANSWERED', '1456194545.32826', '');
INSERT INTO `thaa` VALUES ('839', '8009', '28602018', '00:00:06', '00:00:47', '2016-02-23 10:29:11', 'SIP/8009-0000800d', 'SIP/trunk231-0000800e', 'ANSWERED', '1456194551.32828', '');
INSERT INTO `thaa` VALUES ('840', '8006', '15875045178', '00:00:06', '00:00:00', '2016-02-23 10:31:26', 'SIP/8006-0000800f', 'SIP/trunk231-00008010', 'NO ANSWER', '1456194686.32830', '');
INSERT INTO `thaa` VALUES ('841', '8006', '015875045178', '00:00:25', '00:00:00', '2016-02-23 10:31:43', 'SIP/8006-00008011', 'SIP/trunk231-00008012', 'NO ANSWER', '1456194703.32832', '');
INSERT INTO `thaa` VALUES ('842', '8006', '015875045178', '00:00:20', '00:00:39', '2016-02-23 10:32:15', 'SIP/8006-00008013', 'SIP/trunk231-00008014', 'ANSWERED', '1456194735.32834', '');
INSERT INTO `thaa` VALUES ('843', '8032', '15813300798', '00:00:26', '00:01:11', '2016-02-23 10:32:57', 'SIP/8032-00008015', 'SIP/trunk231-00008016', 'ANSWERED', '1456194777.32836', '');
INSERT INTO `thaa` VALUES ('844', '8006', '1592096897', '00:00:01', '00:00:00', '2016-02-23 10:35:17', 'SIP/8006-00008017', 'SIP/trunk231-00008018', 'FAILED', '1456194917.32838', '');
INSERT INTO `thaa` VALUES ('845', '8006', '15920968971', '00:00:29', '00:00:56', '2016-02-23 10:35:34', 'SIP/8006-00008019', 'SIP/trunk231-0000801a', 'ANSWERED', '1456194934.32840', '');
INSERT INTO `thaa` VALUES ('846', '8052', '18620012822', '00:00:09', '00:02:43', '2016-02-23 10:35:50', 'SIP/8052-0000801b', 'SIP/trunk231-0000801c', 'ANSWERED', '1456194950.32842', '');
INSERT INTO `thaa` VALUES ('847', '8009', '075523628751', '00:00:13', '00:03:09', '2016-02-23 10:36:57', 'SIP/8009-0000801d', 'SIP/trunk231-0000801e', 'ANSWERED', '1456195017.32844', '');
INSERT INTO `thaa` VALUES ('848', '8006', '15219747936', '00:00:06', '00:00:00', '2016-02-23 10:43:30', 'SIP/8006-0000801f', 'SIP/trunk231-00008020', 'NO ANSWER', '1456195410.32846', '');
INSERT INTO `thaa` VALUES ('849', '13691996376', '8009', '00:00:04', '00:01:10', '2016-02-23 10:43:39', 'SIP/trunk231-00008021', 'SIP/8009-00008022', 'ANSWERED', '1456195419.32848', '');
INSERT INTO `thaa` VALUES ('850', '8006', '015219747936', '00:00:17', '00:00:56', '2016-02-23 10:43:48', 'SIP/8006-00008023', 'SIP/trunk231-00008024', 'ANSWERED', '1456195428.32850', '');
INSERT INTO `thaa` VALUES ('851', '8006', '13189073488', '00:00:07', '00:00:00', '2016-02-23 10:46:57', 'SIP/8006-00008025', 'SIP/trunk231-00008026', 'NO ANSWER', '1456195617.32852', '');
INSERT INTO `thaa` VALUES ('852', '8006', '13189073488', '00:00:07', '00:00:00', '2016-02-23 10:47:11', 'SIP/8006-00008027', 'SIP/trunk231-00008028', 'NO ANSWER', '1456195631.32854', '');
INSERT INTO `thaa` VALUES ('853', '8006', '13430328707', '00:00:21', '00:00:37', '2016-02-23 10:58:25', 'SIP/8006-00008029', 'SIP/trunk231-0000802a', 'ANSWERED', '1456196305.32856', '');
INSERT INTO `thaa` VALUES ('854', '8006', '13928795157', '00:00:25', '00:00:49', '2016-02-23 11:03:02', 'SIP/8006-0000802b', 'SIP/trunk231-0000802c', 'ANSWERED', '1456196582.32858', '');
INSERT INTO `thaa` VALUES ('855', '8052', '18802035767', '00:00:29', '00:00:00', '2016-02-23 11:13:03', 'SIP/8052-0000802d', 'SIP/trunk231-0000802e', 'NO ANSWER', '1456197183.32860', '');
INSERT INTO `thaa` VALUES ('856', '8009', '075723628757', '00:00:50', '00:00:00', '2016-02-23 11:14:58', 'SIP/8009-0000802f', 'SIP/trunk231-00008030', 'NO ANSWER', '1456197298.32862', '');
INSERT INTO `thaa` VALUES ('857', '8032', '13802908894', '00:00:12', '00:00:34', '2016-02-23 11:22:43', 'SIP/8032-00008031', 'SIP/trunk231-00008032', 'ANSWERED', '1456197763.32864', '');
INSERT INTO `thaa` VALUES ('858', '8009', '075723628757', '00:00:55', '00:00:00', '2016-02-23 11:24:37', 'SIP/8009-00008033', 'SIP/trunk231-00008034', 'NO ANSWER', '1456197877.32866', '');
INSERT INTO `thaa` VALUES ('859', '8052', '13822299443', '00:00:19', '00:00:46', '2016-02-23 11:25:08', 'SIP/8052-00008035', 'SIP/trunk231-00008036', 'ANSWERED', '1456197908.32868', '');
INSERT INTO `thaa` VALUES ('860', '8009', '075723628751', '00:00:23', '00:00:15', '2016-02-23 11:26:19', 'SIP/8009-00008037', 'SIP/trunk231-00008038', 'ANSWERED', '1456197979.32870', '');
INSERT INTO `thaa` VALUES ('861', '8056', '89207156', '00:00:06', '00:01:24', '2016-02-23 11:27:42', 'SIP/8056-00008039', 'SIP/trunk231-0000803a', 'ANSWERED', '1456198062.32872', '');
INSERT INTO `thaa` VALUES ('862', '8009', '075523628757', '00:00:09', '00:02:55', '2016-02-23 11:32:12', 'SIP/8009-0000803b', 'SIP/trunk231-0000803c', 'ANSWERED', '1456198332.32874', '');
INSERT INTO `thaa` VALUES ('863', '18620013277', '8051', '00:00:06', '00:01:07', '2016-02-23 11:34:56', 'SIP/trunk231-0000803d', 'SIP/8051-0000803e', 'ANSWERED', '1456198496.32876', '');
INSERT INTO `thaa` VALUES ('864', '8009', '38816006', '00:00:06', '00:00:41', '2016-02-23 11:52:48', 'SIP/8009-0000803f', 'SIP/trunk231-00008040', 'ANSWERED', '1456199568.32878', '');
INSERT INTO `thaa` VALUES ('865', '8009', '13302335096', '00:00:10', '00:00:00', '2016-02-23 11:54:41', 'SIP/8009-00008041', 'SIP/trunk231-00008042', 'NO ANSWER', '1456199681.32880', '');
INSERT INTO `thaa` VALUES ('866', '8009', '8050', '00:00:02', '00:00:07', '2016-02-23 12:00:36', 'SIP/8009-00008043', 'SIP/8050-00008044', 'ANSWERED', '1456200036.32882', '');
INSERT INTO `thaa` VALUES ('867', '8017', '13538027297', '00:00:12', '00:00:00', '2016-02-23 12:07:27', 'SIP/8017-00008045', 'SIP/trunk231-00008046', 'NO ANSWER', '1456200447.32884', '');
INSERT INTO `thaa` VALUES ('868', '8017', '013538027297', '00:00:16', '00:00:51', '2016-02-23 12:08:02', 'SIP/8017-00008047', 'SIP/trunk231-00008048', 'ANSWERED', '1456200482.32886', '');
INSERT INTO `thaa` VALUES ('869', '13691996376', '8009', '00:00:29', '00:00:00', '2016-02-23 12:36:21', 'SIP/trunk231-00008049', 'SIP/8009-0000804a', 'NO ANSWER', '1456202181.32888', '');
INSERT INTO `thaa` VALUES ('870', '13691996376', '8009', '00:00:02', '00:00:00', '2016-02-23 12:36:56', 'SIP/trunk231-0000804b', 'SIP/8009-0000804c', 'NO ANSWER', '1456202216.32890', '');
INSERT INTO `thaa` VALUES ('871', '8000', '87511058', '00:00:03', '00:00:59', '2016-02-23 14:04:40', 'SIP/8000-0000804d', 'SIP/trunk231-0000804e', 'ANSWERED', '1456207480.32892', '');
INSERT INTO `thaa` VALUES ('872', '8000', '61210356', '00:00:04', '00:01:43', '2016-02-23 14:05:54', 'SIP/8000-0000804f', 'SIP/trunk231-00008050', 'ANSWERED', '1456207554.32894', '');
INSERT INTO `thaa` VALUES ('873', '8000', '8009', '00:00:18', '00:00:00', '2016-02-23 14:09:27', 'SIP/8000-00008051', 'SIP/8009-00008052', 'NO ANSWER', '1456207767.32896', '');
INSERT INTO `thaa` VALUES ('874', '8017', '22383736', '00:00:38', '00:02:41', '2016-02-23 14:10:09', 'SIP/8017-00008053', 'SIP/trunk231-00008054', 'ANSWERED', '1456207809.32898', '');
INSERT INTO `thaa` VALUES ('875', '8000', '1376611', '00:00:00', '00:00:00', '2016-02-23 14:10:44', 'SIP/8000-00008055', 'SIP/trunk231-00008056', 'FAILED', '1456207844.32900', '');
INSERT INTO `thaa` VALUES ('876', '8000', '13711662806', '00:00:09', '00:00:15', '2016-02-23 14:10:57', 'SIP/8000-00008057', 'SIP/trunk231-00008058', 'ANSWERED', '1456207857.32902', '');
INSERT INTO `thaa` VALUES ('877', '8051', '18620013277', '00:00:12', '00:03:11', '2016-02-23 14:20:35', 'SIP/8051-00008059', 'SIP/trunk231-0000805a', 'ANSWERED', '1456208435.32904', '');
INSERT INTO `thaa` VALUES ('878', '8000', '8009', '00:00:04', '00:00:10', '2016-02-23 14:32:33', 'SIP/8000-0000805b', 'SIP/8009-0000805c', 'ANSWERED', '1456209153.32906', '');
INSERT INTO `thaa` VALUES ('879', '13751852090', '8033', '00:00:06', '00:02:33', '2016-02-23 14:37:17', 'SIP/trunk231-0000805d', 'SIP/8033-0000805e', 'ANSWERED', '1456209437.32908', '');
INSERT INTO `thaa` VALUES ('880', '8056', '8018', '00:00:14', '00:00:21', '2016-02-23 14:39:40', 'SIP/8056-0000805f', 'SIP/8018-00008060', 'ANSWERED', '1456209580.32910', '');
INSERT INTO `thaa` VALUES ('881', '8018', '15360819252', '00:00:13', '00:01:33', '2016-02-23 14:47:16', 'SIP/8018-00008061', 'SIP/trunk231-00008062', 'ANSWERED', '1456210036.32912', '');
INSERT INTO `thaa` VALUES ('882', '8018', '18520014905', '00:00:05', '00:00:00', '2016-02-23 14:51:02', 'SIP/8018-00008063', 'SIP/trunk231-00008064', 'NO ANSWER', '1456210262.32914', '');
INSERT INTO `thaa` VALUES ('883', '8018', '18620014905', '00:00:12', '00:02:03', '2016-02-23 14:51:18', 'SIP/8018-00008065', 'SIP/trunk231-00008066', 'ANSWERED', '1456210278.32916', '');
INSERT INTO `thaa` VALUES ('884', '8000', '8009', '00:00:03', '00:00:07', '2016-02-23 14:58:07', 'SIP/8000-00008067', 'SIP/8009-00008068', 'ANSWERED', '1456210687.32918', '');
INSERT INTO `thaa` VALUES ('885', '8009', '15975605479', '00:00:11', '00:02:57', '2016-02-23 15:06:08', 'SIP/8009-00008069', 'SIP/trunk231-0000806a', 'ANSWERED', '1456211168.32920', '');
INSERT INTO `thaa` VALUES ('886', '8010', '18620015617', '00:00:14', '00:01:42', '2016-02-23 15:11:57', 'SIP/8010-0000806b', 'SIP/trunk231-0000806c', 'ANSWERED', '1456211517.32922', '');
INSERT INTO `thaa` VALUES ('887', '8009', '13611479282', '00:00:16', '00:00:00', '2016-02-23 15:14:53', 'SIP/8009-0000806d', 'SIP/trunk231-0000806e', 'NO ANSWER', '1456211693.32924', '');
INSERT INTO `thaa` VALUES ('888', '8009', '13611479282', '00:00:48', '00:01:24', '2016-02-23 15:15:20', 'SIP/8009-0000806f', 'SIP/trunk231-00008070', 'ANSWERED', '1456211720.32926', '');
INSERT INTO `thaa` VALUES ('889', '8056', '89207156', '00:00:03', '00:00:00', '2016-02-23 15:19:06', 'SIP/8056-00008071', 'SIP/trunk231-00008072', 'BUSY', '1456211946.32928', '');
INSERT INTO `thaa` VALUES ('890', '8009', '13078883760', '00:00:08', '00:03:54', '2016-02-23 15:20:13', 'SIP/8009-00008073', 'SIP/trunk231-00008074', 'ANSWERED', '1456212013.32930', '');

-- ----------------------------
-- Table structure for warehouse
-- ----------------------------
DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE `warehouse` (
  `id` varchar(11) NOT NULL DEFAULT '' COMMENT 'ID',
  `name` varchar(50) DEFAULT '' COMMENT '仓库名称',
  `place` varchar(50) DEFAULT '' COMMENT '库位',
  `ifuse` varchar(10) DEFAULT '是' COMMENT '是否正在使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of warehouse
-- ----------------------------
INSERT INTO `warehouse` VALUES ('KW16010001', '123123', '123', '是');
INSERT INTO `warehouse` VALUES ('KW16010002', 'test1', '1001', '是');

-- ----------------------------
-- Table structure for whaa
-- ----------------------------
DROP TABLE IF EXISTS `whaa`;
CREATE TABLE `whaa` (
  `whaa01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `whaa02` varchar(30) DEFAULT '' COMMENT '问卷名称',
  `whaa03` varchar(500) DEFAULT '' COMMENT '问卷介绍',
  `whaa04` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '创建时间',
  `whaa05` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '更新时间',
  `whaa06` varchar(20) DEFAULT '' COMMENT '操作人姓名',
  `whaa07` varchar(10) DEFAULT '' COMMENT '操作人分机',
  `whaa08` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`whaa01`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of whaa
-- ----------------------------
INSERT INTO `whaa` VALUES ('2', '423432redeasdf', 'saddasda12312321', '2016-01-09 18:20:47', '2016-01-09 18:20:47', '管理员', '8040', '');
INSERT INTO `whaa` VALUES ('3', 'dasda', '3123123121', '2016-01-09 18:21:09', '2016-01-09 19:43:02', '管理员', '8040', '');
INSERT INTO `whaa` VALUES ('4', 'dasdas', '312312312', '2016-01-09 18:21:14', '2016-01-09 18:21:14', '管理员', '8040', '');

-- ----------------------------
-- Table structure for whab
-- ----------------------------
DROP TABLE IF EXISTS `whab`;
CREATE TABLE `whab` (
  `whab01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `whab02` int(11) unsigned DEFAULT '0' COMMENT '问卷序号(外键)',
  `whab03` varchar(30) DEFAULT '' COMMENT '任务名称',
  `whab04` int(11) unsigned DEFAULT '0' COMMENT '参与座席(参与人数)',
  `whab05` int(11) unsigned DEFAULT '0' COMMENT '号码总量',
  `whab06` int(11) unsigned DEFAULT '0' COMMENT '已分配',
  `whab07` int(11) unsigned DEFAULT '0' COMMENT '已执行',
  `whab08` decimal(10,2) DEFAULT '0.00' COMMENT '完成率',
  `whab09` varchar(10) DEFAULT '' COMMENT '状态[未开始、执行中、暂停、停止、已完成]',
  `whab10` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '创建时间',
  `whab11` int(11) unsigned DEFAULT '0' COMMENT '有效问卷',
  `whab12` decimal(10,2) DEFAULT '0.00' COMMENT '有效率',
  PRIMARY KEY (`whab01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of whab
-- ----------------------------

-- ----------------------------
-- Table structure for wlaa
-- ----------------------------
DROP TABLE IF EXISTS `wlaa`;
CREATE TABLE `wlaa` (
  `wlaa01` varchar(30) NOT NULL COMMENT '订单号',
  `wlaa02` varchar(50) DEFAULT NULL COMMENT '快递公司(EMS,顺丰,圆通等)',
  `wlaa03` varchar(30) DEFAULT NULL COMMENT '快递单号',
  `wlaa04` varchar(30) DEFAULT NULL COMMENT '客户编号',
  `wlaa05` varchar(30) DEFAULT NULL COMMENT '客户姓名',
  `wlaa06` varchar(20) DEFAULT NULL COMMENT '发货状态',
  `wlaa07` varchar(20) DEFAULT NULL COMMENT '快递单(已打印,未打印)',
  `wlaa08` varchar(20) DEFAULT NULL COMMENT '出货单(已打印,未打印)',
  `wlaa09` varchar(200) DEFAULT NULL COMMENT '收货地址',
  `wlaa10` varchar(30) DEFAULT NULL COMMENT '支付方式(支付宝,现金支付,货到付款,银行转账,财付通)',
  `wlaa11` decimal(10,2) DEFAULT NULL COMMENT '代收金额',
  `wlaa12` decimal(10,2) DEFAULT NULL COMMENT '总金额',
  `wlaa13` varchar(30) DEFAULT NULL COMMENT '分组(销售部,财务部)',
  `wlaa14` varchar(50) DEFAULT NULL COMMENT '货物类型(保健品,衣物)',
  `wlaa15` varchar(20) DEFAULT NULL COMMENT '货单类型(正常单,换货单,重发单,异常单,急发单,其他)',
  `wlaa16` datetime DEFAULT NULL COMMENT '下单时间',
  `wlaa17` datetime DEFAULT NULL COMMENT '审单时间',
  `wlaa18` varchar(500) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`wlaa01`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wlaa
-- ----------------------------

-- ----------------------------
-- Table structure for wlab
-- ----------------------------
DROP TABLE IF EXISTS `wlab`;
CREATE TABLE `wlab` (
  `wlab01` varchar(30) DEFAULT NULL COMMENT '产品类型(美容,保健,减肥等)',
  `wlab02` varchar(50) DEFAULT NULL COMMENT '产品名称',
  `wlab03` varchar(30) DEFAULT NULL COMMENT '货号',
  `wlab04` varchar(30) DEFAULT NULL COMMENT '操作人员',
  `wlab05` varchar(30) DEFAULT NULL COMMENT '条形码',
  `wlab06` decimal(10,2) DEFAULT NULL COMMENT '盘点库存',
  `wlab07` datetime DEFAULT NULL COMMENT '盘点日期',
  `wlab08` varchar(20) DEFAULT NULL COMMENT '款号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wlab
-- ----------------------------

-- ----------------------------
-- Table structure for xsaa
-- ----------------------------
DROP TABLE IF EXISTS `xsaa`;
CREATE TABLE `xsaa` (
  `xsaa01` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `xsaa02` varchar(50) DEFAULT '' COMMENT '订单号',
  `xsaa03` varchar(50) DEFAULT '' COMMENT '快递单号',
  `xsaa04` varchar(30) DEFAULT '' COMMENT '客户编号',
  `xsaa05` varchar(50) DEFAULT '' COMMENT '客户姓名',
  `xsaa06` varchar(30) DEFAULT '' COMMENT '客户手机',
  `xsaa07` varchar(30) DEFAULT '' COMMENT '客户电话',
  `xsaa08` varchar(100) DEFAULT '' COMMENT '客户意向',
  `xsaa09` varchar(255) DEFAULT '' COMMENT '送货地址',
  `xsaa10` varchar(6) DEFAULT '' COMMENT '邮编',
  `xsaa11` varchar(30) DEFAULT '' COMMENT '订单类型(正常单,换货单,重发单,异常单,急发单,其他单)',
  `xsaa12` varchar(30) DEFAULT '' COMMENT '进线方式(电话,商务通,QQ,MSN,短信,旺旺,主动,其他)',
  `xsaa13` varchar(30) DEFAULT '' COMMENT '支付方式(支付宝,财付通,现金支付,货到付款,银行转账,K币支付,免费支付)',
  `xsaa14` varchar(30) DEFAULT '' COMMENT '发票类型(无发票,普通发票,增值发票)',
  `xsaa15` varchar(50) DEFAULT '' COMMENT '发票号',
  `xsaa16` decimal(10,2) DEFAULT '0.00' COMMENT '运费',
  `xsaa17` decimal(10,2) DEFAULT '0.00' COMMENT '订单总额',
  `xsaa18` decimal(10,2) DEFAULT '0.00' COMMENT '减免金额',
  `xsaa19` decimal(10,2) DEFAULT '0.00' COMMENT '应收金额',
  `xsaa20` decimal(10,2) DEFAULT '0.00' COMMENT '已收定金',
  `xsaa21` decimal(10,2) DEFAULT '0.00' COMMENT '代收金额',
  `xsaa22` varchar(30) DEFAULT '' COMMENT '操作人(退货入仓操作人)',
  `xsaa23` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '订单创建时间',
  `xsaa24` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '订单完结时间',
  `xsaa25` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '订单审核时间',
  `xsaa26` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '订单支付时间',
  `xsaa27` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '订单发货时间',
  `xsaa28` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '订单签收时间',
  `xsaa29` varchar(30) DEFAULT '' COMMENT '订单状态(下单[未确认],已客审,已财审,确认到审单[已确认],审核通过,等待支付,已确认,已支付,待发货,已发货,已作废,已收货,退货拒收,交易成功)',
  `xsaa30` varchar(30) DEFAULT '' COMMENT '审核状态(已确认、已客审、已财审)',
  `xsaa31` varchar(30) DEFAULT '' COMMENT '分组(销售部,销售回访一部,二线一组,二线二组,二线三组,二线四组,公共组)',
  `xsaa32` varchar(50) DEFAULT '' COMMENT '款号',
  `xsaa33` varchar(200) DEFAULT '' COMMENT '业绩分配',
  `xsaa34` varchar(50) DEFAULT '' COMMENT '审单工号',
  `xsaa35` varchar(30) DEFAULT '' COMMENT '是否记账(全未记账,全已记账,未记账1,未记账2,已记账1,已记账2)',
  `xsaa36` varchar(500) DEFAULT '' COMMENT '备注',
  `xsaa37` varchar(30) DEFAULT '' COMMENT '登录账号',
  `xsaa38` varchar(30) DEFAULT '' COMMENT '登录姓名',
  `xsaa39` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '订单更新时间',
  `xsaa40` varchar(50) DEFAULT '' COMMENT '动作说明(设为:已确认,保存订单:已收金额100,设为:已作废,审单通过,下单,确认到审单,撤回未确认,撤销收货)',
  `xsaa41` varchar(50) DEFAULT '' COMMENT '快递名称',
  `xsaa42` decimal(10,2) DEFAULT '0.00' COMMENT '商品总数',
  `xsaa43` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '入库时间',
  `xsaa44` decimal(10,2) DEFAULT '0.00' COMMENT '退货金额',
  `xsaa45` varchar(1) DEFAULT '否' COMMENT '是否已退货入仓',
  `xsaa46` decimal(10,2) DEFAULT '0.00' COMMENT '退货总数',
  `xsaa47` varchar(20) DEFAULT '未审核' COMMENT '是否审核',
  `xsaa48` varchar(30) DEFAULT '' COMMENT '下单人(销售工号)',
  `xsaa49` varchar(1) DEFAULT '' COMMENT '退换货标识',
  `xsaa50` varchar(1) DEFAULT '否' COMMENT '是否已确认到审单',
  `xsaa51` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '退换货时间',
  `xsaa52` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '记账1时间',
  `xsaa53` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '记账2时间',
  `xsaa54` varchar(1) DEFAULT '否' COMMENT '是否记账1',
  `xsaa55` varchar(1) DEFAULT '否' COMMENT '是否记账2',
  `xsaa56` varchar(1) DEFAULT '' COMMENT '是否已退款',
  `xsaa57` decimal(10,2) DEFAULT '0.00' COMMENT '快递费',
  `xsaa58` decimal(10,2) DEFAULT '0.00' COMMENT '服务费',
  `xsaa59` decimal(10,2) DEFAULT '0.00' COMMENT '其他费',
  `xsaa60` varchar(100) DEFAULT '' COMMENT '客户来源',
  `xsaa61` date DEFAULT '1900-01-01' COMMENT '下单年月日(业绩分组)',
  `xsaa62` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '退款时间',
  PRIMARY KEY (`xsaa01`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xsaa
-- ----------------------------
INSERT INTO `xsaa` VALUES ('35', 'XS16010001', '', 'KH16010001', '黄晓明', '13254874585', '', '', '吉林省,辽源市,东丰县,dwewe', '', '正常单', '', '货到付款', '无发票', '', '0.00', '345.00', '0.00', '345.00', '0.00', '0.00', '', '2016-01-21 11:33:25', '1900-01-01 00:00:00', '2016-01-21 11:33:47', '1900-01-01 00:00:00', '2016-01-29 16:06:53', '2016-01-29 16:07:07', '交易成功', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-01-29 16:07:07', '确认收货', '', '2.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('36', 'XS16010002', '', 'KH16010001', '黄晓明', '13254874585', '', '', '吉林省,辽源市,东丰县,dwewe', '', '正常单', '', '货到付款', '无发票', '', '0.00', '432.00', '0.00', '432.00', '111.00', '321.00', '', '2016-01-21 11:34:26', '1900-01-01 00:00:00', '2016-02-03 16:44:06', '1900-01-01 00:00:00', '2016-03-07 15:00:18', '1900-01-01 00:00:00', '已发货', '已客审', '', '', 'admin', '', '', '', 'admin', 'admin', '2016-03-07 15:00:18', '发货', '', '2.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '2016-03-22 18:07:18', '2016-03-22 17:28:23', '是', '否', '', '1111.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('38', 'XS16010004', '', 'KH16010002', '邓超', '13565874898', '', '', '内蒙古,通辽市,库伦旗,单位的温度为', '', '正常单', '', '货到付款', '无发票', '', '0.00', '210.00', '0.00', '210.00', '0.00', '0.00', '', '2016-01-22 09:29:58', '1900-01-01 00:00:00', '2016-03-08 14:29:18', '1900-01-01 00:00:00', '2016-03-08 14:29:40', '1900-01-01 00:00:00', '已发货', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-03-08 14:29:40', '发货', '', '1.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '2016-03-22 18:07:18', '2016-03-22 17:28:23', '是', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('39', 'XS16010005', '', 'KH16010002', '邓超', '13565874898', '', '', '内蒙古,通辽市,库伦旗,单位的温度为', '', '正常单', '', '货到付款', '无发票', '', '0.00', '123.00', '0.00', '123.00', '0.00', '0.00', '', '2016-01-22 09:30:13', '1900-01-01 00:00:00', '2016-03-21 17:44:40', '1900-01-01 00:00:00', '2016-03-22 14:49:06', '1900-01-01 00:00:00', '拒收', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-03-31 10:20:27', '拒收。原因：拒绝收方开箱验货', '', '1.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '退', '是', '2016-03-31 10:20:27', '2016-03-22 16:34:28', '2016-03-22 16:26:40', '否', '是', '', '111.00', '321.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('40', 'XS16010006', '', 'KH16010002', '邓超', '13565874898', '', '', '内蒙古,通辽市,库伦旗,单位的温度为', '', '正常单', '', '货到付款', '无发票', '', '0.00', '14103.00', '0.00', '13635.00', '0.00', '0.00', '', '2016-01-22 09:30:26', '1900-01-01 00:00:00', '2016-03-22 14:22:59', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '待发货', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-03-22 14:22:59', '审单通过', '', '8.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('41', 'XS16010007', '', 'KH16010002', '邓超', '13565874898', '', '', '内蒙古,通辽市,库伦旗,单位的温度为', '', '正常单', '', '货到付款', '无发票', '', '0.00', '222.00', '0.00', '222.00', '0.00', '0.00', 'admin', '2016-01-22 09:30:38', '1900-01-01 00:00:00', '2016-01-26 11:51:56', '1900-01-01 00:00:00', '2016-01-28 13:59:40', '1900-01-01 00:00:00', '拒收', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-01-28 14:52:59', '拒收。原因：快递人员服务差', '', '1.00', '2016-01-28 15:01:29', '222.00', '是', '1.00', '未审核', 'admin', '退', '是', '2016-01-28 14:52:59', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('42', 'XS16010008', '', 'KH16010001', '黄晓明', '13826191927', '', '', '吉林省,辽源市,东丰县,dwewe', '', '正常单', '', '货到付款', '无发票', '', '0.00', '222.00', '0.00', '222.00', '0.00', '0.00', '', '2016-01-22 09:30:49', '1900-01-01 00:00:00', '2016-03-07 14:52:05', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '等待支付', '', '', '', 'admin', '', '', '', 'admin', 'admin', '2016-03-08 10:52:10', '撤回未确认', '', '1.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '否', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('43', 'XS16010009', '', 'KH16010002', '邓超', '13565874898', '', '', '内蒙古,通辽市,库伦旗,单位的温度为', '', '正常单', '', '货到付款', '无发票', '', '0.00', '222.00', '0.00', '222.00', '0.00', '0.00', 'admin', '2016-01-22 09:31:03', '1900-01-01 00:00:00', '2016-02-03 10:43:45', '1900-01-01 00:00:00', '2016-02-03 10:44:24', '1900-01-01 00:00:00', '拒收', '已客审', '', '', 'admin', '', '', '312321', 'admin', '管理员', '2016-02-03 10:55:16', '拒收。原因：擅自退回', '', '1.00', '2016-02-03 10:55:35', '222.00', '是', '1.00', '未审核', 'admin', '退', '是', '2016-02-03 10:55:16', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('44', 'XS16010010', '', 'KH16010001', '黄晓明', '13826191927', '', '', '吉林省,辽源市,东丰县,dwewe', '', '正常单', '', '货到付款', '无发票', '', '0.00', '152.00', '0.00', '152.00', '0.00', '201.00', '', '2016-01-22 09:31:14', '1900-01-01 00:00:00', '2016-02-03 16:44:06', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '已确认', '已确认', '', '', 'admin', '', '', '', 'admin', 'admin', '2016-03-21 11:03:25', '确认到审单', '', '1.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('45', 'XS16010011', '', 'KH16010001', '黄晓明', '13826191927', '', '', '吉林省,辽源市,东丰县,dwewe', '', '正常单', '', '货到付款', '无发票', '', '0.00', '242.00', '0.00', '232.00', '0.00', '0.00', '', '2016-01-22 09:31:27', '1900-01-01 00:00:00', '2016-02-02 10:18:18', '1900-01-01 00:00:00', '2016-02-02 16:16:01', '2016-03-31 10:19:44', '交易成功', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-03-31 10:19:44', '确认收货', '', '3.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('46', 'XS16010012', '', 'KH16010013', '范冰冰', '15847458965', '', '', '山东省,烟台市,长岛县,rfergetrg', '', '正常单', '', '货到付款', '无发票', '', '0.00', '400.00', '0.00', '680.00', '0.00', '680.00', 'admin', '2016-01-22 16:22:09', '1900-01-01 00:00:00', '2016-02-03 10:56:32', '1900-01-01 00:00:00', '2016-02-03 10:56:42', '1900-01-01 00:00:00', '拒收', '已客审', '', '', 'admin', '', '', '321321', 'admin', 'admin', '2016-02-03 10:57:41', '拒收。原因：订单重复', '', '2.00', '2016-02-03 10:57:54', '400.00', '是', '2.00', '未审核', 'admin', '退', '是', '2016-02-03 10:57:41', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('47', 'XS16020001', '111', 'KH16020001', 'test1111', '13213124321', '', '', '河北省,石家庄市,长安区,123123213', '', '正常单', '', '支付宝', '无发票', '', '0.00', '246.00', '0.00', '246.00', '246.00', '0.00', '1111', '2016-02-03 16:48:59', '1900-01-01 00:00:00', '2016-02-24 14:40:35', '1900-01-01 00:00:00', '2016-02-24 14:41:02', '1900-01-01 00:00:00', '拒收', '已财审', '', '', 'admin', '', '', '', 'admin', 'admin', '2016-02-24 15:12:16', '拒收。原因：快递人员服务差', '圆通快递', '2.00', '2016-02-24 16:43:21', '738.00', '止', '6.00', '未审核', 'admin', '退', '是', '2016-02-24 15:12:16', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '是', '否', '', '0.00', '0.00', '0.00', '', null, '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('48', 'XS16020002', '', 'KH16020001', 'test1111', '13213124321', '', '', '河北省,石家庄市,长安区,213213', '', '正常单', '', '货到付款', '无发票', '', '0.00', '246.00', '0.00', '246.00', '0.00', '246.00', 'admin', '2016-02-19 11:41:56', '1900-01-01 00:00:00', '2016-02-23 16:51:18', '1900-01-01 00:00:00', '2016-02-23 16:55:14', '1900-01-01 00:00:00', '拒收', '已客审', '', '', 'admin:0.5*dsc:0.5', '', '', 'dadas', 'admin:1', 'admin', '2016-02-23 16:55:32', '拒收。原因：快递人员服务差', '', '2.00', '2016-02-23 16:58:01', '246.00', '是', '2.00', '未审核', 'admin', '退', '是', '2016-02-23 16:55:32', '2016-03-04 15:06:55', '1900-01-01 00:00:00', '是', '否', '', '0.00', '0.00', '0.00', '', '2016-02-19', '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('49', 'XS16020003', '', 'KH16020014', '林心如', '15232651548', '', '', '河北省,秦皇岛市,北戴河区,asdasd', '', '正常单', '', '货到付款', '无发票', '', '0.00', '123.00', '0.00', '123.00', '0.00', '0.00', '', '2016-02-23 16:31:36', '1900-01-01 00:00:00', '2016-03-21 14:23:20', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '已支付', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-03-21 14:23:20', '审单通过', '', '1.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', '2016-02-23', '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('50', 'XS16030001', '', 'KH16020013', '陈坤', '13625684584', '', '', '黑龙江,双鸭山市,宝山区,11111', '', '正常单', '', '货到付款', '无发票', '', '0.00', '246.00', '0.00', '246.00', '0.00', '0.00', '', '2016-03-04 11:58:19', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '已支付', '已确认', '', '', 'admin:0.5*wac:0.5', '', '', '', 'admin', '管理员', '2016-03-21 11:21:49', '确认到审单', '', '2.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', '2016-03-04', '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('51', 'XS16030002', '', 'KH16020014', '林心如', '15232651548', '', '', '河北省,秦皇岛市,青龙满族自治县,31231da', '', '正常单', '', '支付宝', '无发票', '', '0.00', '123.00', '0.00', '123.00', '123.00', '0.00', '', '2016-03-04 15:19:08', '1900-01-01 00:00:00', '2016-03-08 14:41:48', '1900-01-01 00:00:00', '2016-03-08 14:41:54', '1900-01-01 00:00:00', '拒收', '已财审', '', '', 'admin', '', '', '31232', 'admin', '管理员', '2016-03-08 16:53:37', '拒收。原因：快递人员服务差', '', '1.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '退', '是', '2016-03-08 16:53:37', '2016-03-22 17:04:02', '1900-01-01 00:00:00', '否', '否', '', '22.00', '33.00', '0.00', '', '2016-03-04', '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('52', 'XS16030003', '', 'KH16020013', '陈坤', '13625684584', '', '', '辽宁省,鞍山市,立山区,111', '', '正常单', '', '现金支付', '无发票', '', '0.00', '246.00', '0.00', '246.00', '246.00', '0.00', '', '2016-03-07 15:37:10', '1900-01-01 00:00:00', '2016-03-08 14:12:12', '1900-01-01 00:00:00', '2016-03-08 14:12:18', '1900-01-01 00:00:00', '拒收', '已财审', '', '', 'admin', '', '', '3123123', 'admin', '管理员', '2016-03-08 16:52:07', '拒收。原因：快递人员服务差', '', '2.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '退', '是', '2016-03-08 16:52:07', '2016-03-22 16:34:28', '2016-03-14 14:27:34', '否', '否', '是', '1.00', '22.00', '0.00', '', '2016-03-07', '2016-03-08 16:52:34');
INSERT INTO `xsaa` VALUES ('53', 'XS16030004', '', 'KH16020006', '王祖蓝', '15845845125', '3123123', '', '山西省,长治市,襄垣县,1321dsadsa', 'ddsads', '换货单', '', '财付通', '增值发票', '', '0.00', '123.00', '0.00', '21.00', '21.00', '0.00', '', '2016-03-08 15:13:34', '1900-01-01 00:00:00', '2016-03-21 14:25:50', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '已支付', '', '', '', 'admin', '', '', '312213', 'admin', '管理员', '2016-04-01 11:05:57', '保存订单：已收金额21', '', '1.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '否', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', '2016-03-08', '0000-00-00 00:00:00');
INSERT INTO `xsaa` VALUES ('54', 'XS16030005', '', 'KH16020014', '林心如', '15232651548', '', '', '广东省,广州市,荔湾区,12321321', '', '正常单', '', '货到付款', '无发票', '', '0.00', '278.00', '0.00', '278.00', '0.00', '0.00', 'admin', '2016-03-23 16:50:35', '1900-01-01 00:00:00', '2016-03-23 16:54:05', '1900-01-01 00:00:00', '2016-03-23 16:54:42', '1900-01-01 00:00:00', '拒收', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-03-23 17:15:32', '拒收。原因：拒绝收方开箱验货', '', '3.00', '2016-03-23 17:05:05', '0.00', '是', '3.00', '未审核', 'admin', '退', '是', '2016-03-23 17:15:32', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', '2016-03-23', '1900-01-01 00:00:00');
INSERT INTO `xsaa` VALUES ('55', 'XS16030006', '', 'KH16020014', '林心如', '15232651548', '', '', '广东省,广州市,荔湾区,12321321', '', '正常单', '', '货到付款', '无发票', '', '0.00', '222.00', '0.00', '222.00', '111.00', '111.00', '', '2016-03-24 16:31:53', '1900-01-01 00:00:00', '2016-03-25 19:54:52', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '已确认', '已客审', '', '', 'admin', '', '', '', 'admin', '管理员', '2016-03-25 19:54:52', '审单通过', '', '2.00', '1900-01-01 00:00:00', '0.00', '否', '0.00', '未审核', 'admin', '', '是', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '否', '否', '', '0.00', '0.00', '0.00', '', '2016-03-24', '1900-01-01 00:00:00');

-- ----------------------------
-- Table structure for xsab
-- ----------------------------
DROP TABLE IF EXISTS `xsab`;
CREATE TABLE `xsab` (
  `xsab01` varchar(50) DEFAULT '' COMMENT '订单号',
  `xsab02` varchar(30) DEFAULT '' COMMENT '商品名称',
  `xsab03` int(11) DEFAULT '0' COMMENT '商品编号',
  `xsab04` decimal(10,2) DEFAULT '0.00' COMMENT '购买数量',
  `xsab05` decimal(10,2) DEFAULT '0.00' COMMENT '商品价格',
  `xsab06` decimal(10,2) DEFAULT '0.00' COMMENT '折后售价',
  `xsab07` decimal(10,2) DEFAULT '0.00' COMMENT '商品总价',
  `xsab08` decimal(10,2) DEFAULT '0.00' COMMENT '折后总价',
  `xsab09` varchar(1) DEFAULT 'F' COMMENT '是否作废(T为作废,F为为作废,默认为F)',
  `xsab10` decimal(10,2) DEFAULT '0.00' COMMENT '优惠价格',
  `xsab11` decimal(10,2) DEFAULT '0.00' COMMENT '优惠总价',
  `xsab12` varchar(20) DEFAULT '' COMMENT '商品状态[退货已入仓、退货未入仓](针对拒收订单的商品)',
  `xsab13` varchar(50) DEFAULT '' COMMENT '批次(入库、出库的批次)',
  `xsab14` decimal(10,2) DEFAULT '0.00' COMMENT '退货数量',
  `xsab15` decimal(10,2) DEFAULT '0.00' COMMENT '退货总额',
  `xsab16` varchar(50) DEFAULT '' COMMENT '备注[退货入仓]',
  `xsab17` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '操作时间(退货入仓操作时间)',
  `xsab18` varchar(30) DEFAULT '' COMMENT '属性',
  `xsab19` decimal(10,2) DEFAULT '0.00' COMMENT '成本',
  `xsab20` varchar(1) DEFAULT '' COMMENT '是否退换货',
  `xsab21` varchar(30) DEFAULT '' COMMENT '快递单号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xsab
-- ----------------------------
INSERT INTO `xsab` VALUES ('XS16010001', '金龙鱼', '9', '1.00', '222.00', '222.00', '222.00', '222.00', 'F', '0.00', '0.00', '', '1511180002', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010001', '沐浴露', '14', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '1512220002', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010002', '胡椒粉', '13', '1.00', '210.00', '210.00', '210.00', '210.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010002', '洗衣液', '7', '1.00', '222.00', '222.00', '222.00', '222.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010004', '胡椒粉', '13', '1.00', '210.00', '210.00', '210.00', '210.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010005', '测试1123', '16', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '1603160001', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '未', '');
INSERT INTO `xsab` VALUES ('XS16010007', '洗衣液', '7', '1.00', '222.00', '222.00', '222.00', '222.00', 'F', '0.00', '0.00', '退货已入仓', '1511180002', '1.00', '222.00', '退货入仓', '2016-01-28 15:01:29', '', '0.00', '已', '');
INSERT INTO `xsab` VALUES ('XS16010008', '洗衣服', '8', '1.00', '222.00', '222.00', '222.00', '222.00', 'F', '0.00', '0.00', '', '1511180002', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010009', '洗衣液', '7', '1.00', '222.00', '222.00', '222.00', '222.00', 'F', '0.00', '0.00', '退货已入仓', '1511260001', '1.00', '222.00', '退货入仓', '2016-02-03 10:55:35', '', '0.00', '已', '');
INSERT INTO `xsab` VALUES ('XS16010010', '沐浴露', '14', '1.00', '152.00', '152.00', '152.00', '152.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010011', '洗衣服', '8', '1.00', '222.00', '222.00', '222.00', '222.00', 'F', '0.00', '0.00', '', '1511180002', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010012', '洗衣服', '8', '2.00', '200.00', '200.00', '400.00', '400.00', 'F', '0.00', '0.00', '退货已入仓', '1511260001', '2.00', '400.00', '退货入仓', '2016-02-03 10:57:54', '', '0.00', '已', '');
INSERT INTO `xsab` VALUES ('XS16010006', '沐浴露', '14', '5.00', '4545.00', '4545.00', '13881.00', '13635.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010006', '金龙鱼', '9', '2.00', '222.00', '222.00', '222.00', '0.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010006', '洗衣粉', '8', '1.00', '222.00', '222.00', '0.00', '0.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16010011', '菜刀', '12', '2.00', '10.00', '10.00', '20.00', '20.00', 'F', '0.00', '0.00', '', '1512160001', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16020001', '药测试', '15', '1.00', '123.00', '123.00', '123.00', '123.00', 'T', '0.00', '0.00', '终止', '1512220002', '1.00', '123.00', '终止退货入仓', '2016-02-24 16:43:21', '', '0.00', '未', '111');
INSERT INTO `xsab` VALUES ('XS16020001', '衣服1号！123', '14', '1.00', '123.00', '123.00', '123.00', '123.00', 'T', '0.00', '0.00', '终止', '1512220002', '1.00', '123.00', '终止退货入仓', '2016-02-24 16:40:34', '', '0.00', '未', '111');
INSERT INTO `xsab` VALUES ('XS16020002', '药测试', '15', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '退货已入仓', '1512220002', '1.00', '123.00', '退货入仓', '2016-02-23 16:58:01', '', '0.00', '已', '');
INSERT INTO `xsab` VALUES ('XS16020002', '衣服1号！123', '14', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '退货已入仓', '1512220002', '1.00', '123.00', '退货入仓', '2016-02-23 16:58:01', '', '0.00', '已', '');
INSERT INTO `xsab` VALUES ('XS16020003', '药测试', '15', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16030001', '药测试', '15', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16030001', '衣服1号！123', '14', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16030002', '衣服1号！123', '14', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '1512220002', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '未', '');
INSERT INTO `xsab` VALUES ('XS16030003', '衣服1号！123', '14', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '1512220002', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '未', '');
INSERT INTO `xsab` VALUES ('XS16030003', '药测试', '15', '1.00', '123.00', '123.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '1512220002', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '未', '');
INSERT INTO `xsab` VALUES ('XS16030004', '药测试', '15', '1.00', '21.00', '21.00', '21.00', '21.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16030005', '玛莎玻尿酸原液250ml', '26', '1.00', '80.00', '80.00', '80.00', '80.00', 'F', '0.00', '0.00', '退货已入仓', '1603140005', '1.00', '80.00', '退货入仓', '2016-03-23 17:05:05', '', '0.00', '未', '');
INSERT INTO `xsab` VALUES ('XS16030005', '碧生源减肥茶2012', '25', '2.00', '99.00', '99.00', '198.00', '198.00', 'F', '0.00', '0.00', '退货已入仓', '1603020002', '2.00', '198.00', '退货入仓', '2016-03-23 17:05:05', '', '0.00', '未', '');
INSERT INTO `xsab` VALUES ('XS16030006', '碧生源减肥茶2012', '25', '1.00', '99.00', '99.00', '99.00', '99.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');
INSERT INTO `xsab` VALUES ('XS16030006', '衣服1号！123', '14', '1.00', '0.00', '0.00', '123.00', '123.00', 'F', '0.00', '0.00', '', '', '0.00', '0.00', '', '1900-01-01 00:00:00', '', '0.00', '', '');

-- ----------------------------
-- Table structure for xsac
-- ----------------------------
DROP TABLE IF EXISTS `xsac`;
CREATE TABLE `xsac` (
  `xsac01` varchar(50) DEFAULT '' COMMENT '订单号',
  `xsac02` varchar(30) DEFAULT '' COMMENT '登录账号',
  `xsac03` varchar(30) DEFAULT '' COMMENT '登录姓名',
  `xsac04` varchar(10) DEFAULT '' COMMENT '业绩比例',
  `xsac05` decimal(10,2) DEFAULT '0.00' COMMENT '业绩金额'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xsac
-- ----------------------------
INSERT INTO `xsac` VALUES ('XS15120001', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS15120002', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS15120003', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS15120004', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS15120005', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS16010001', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS16010002', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS16020001', 'admin', '', '1', '0.00');
INSERT INTO `xsac` VALUES ('XS16020002', 'admin', '', '0.5', '123.00');
INSERT INTO `xsac` VALUES ('XS16020002', 'dsc', '', '0.5', '123.00');
INSERT INTO `xsac` VALUES ('XS16020003', 'admin', '', '1', '123.00');
INSERT INTO `xsac` VALUES ('XS16030001', '1', '', '5', '1230.00');
INSERT INTO `xsac` VALUES ('XS16030001', '1', '', '4', '984.00');
INSERT INTO `xsac` VALUES ('XS16030001', 'admin', '', '0.5', '123.00');
INSERT INTO `xsac` VALUES ('XS16030001', 'wac', '', '0.5', '123.00');
INSERT INTO `xsac` VALUES ('XS16030003', 'admin', '', '1', '246.00');
INSERT INTO `xsac` VALUES ('XS16030002', 'admin', '', '1', '123.00');
INSERT INTO `xsac` VALUES ('XS16030005', 'admin', '', '1', '278.00');
INSERT INTO `xsac` VALUES ('XS16030006', 'admin', '', '1', '222.00');
INSERT INTO `xsac` VALUES ('XS16030004', 'admin', '', '1', '21.00');

-- ----------------------------
-- Table structure for xsad
-- ----------------------------
DROP TABLE IF EXISTS `xsad`;
CREATE TABLE `xsad` (
  `xsad01` varchar(50) NOT NULL DEFAULT '' COMMENT '订单号',
  `xsad02` varchar(30) DEFAULT '' COMMENT '跟进人工号',
  `xsad03` varchar(30) DEFAULT '' COMMENT '跟进人姓名',
  `xsad04` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '跟进时间',
  `xsad05` datetime DEFAULT '1900-01-01 00:00:00' COMMENT '待办时间',
  `xsad06` varchar(500) DEFAULT '' COMMENT '跟进记录',
  `xsad07` varchar(30) DEFAULT '' COMMENT '安排人工号',
  `xsad08` varchar(30) DEFAULT '' COMMENT '安排人姓名',
  `xsad09` varchar(30) DEFAULT '' COMMENT '分组',
  `xsad10` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `xsad11` varchar(1) DEFAULT '否' COMMENT '是否待办事项',
  `xsad12` varchar(10) DEFAULT '未完成' COMMENT '是否完成',
  PRIMARY KEY (`xsad10`)
) ENGINE=InnoDB AUTO_INCREMENT=296 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xsad
-- ----------------------------
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2015-12-29 14:20:43', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '1', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120002', 'admin', '管理员', '2015-12-29 14:30:37', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '2', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2015-12-29 14:51:11', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '3', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-29 15:02:39', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '4', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120004', 'admin', '管理员', '2015-12-29 16:00:48', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '5', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120004', 'admin', '管理员', '2015-12-29 16:00:59', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '6', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2015-12-30 15:14:09', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '7', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 15:14:26', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '8', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 15:14:52', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '9', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 15:22:46', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '10', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 15:27:56', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '11', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 15:36:13', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '14', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120005', 'admin', '管理员', '2015-12-30 16:07:30', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '19', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120005', 'admin', '管理员', '2015-12-30 16:07:56', '1900-01-01 00:00:00', '保存订单：已收金额2131', 'admin', '管理员', '', '20', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120005', 'admin', '管理员', '2015-12-30 16:14:36', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '21', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 16:14:45', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '22', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 16:15:42', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '24', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120004', 'admin', '管理员', '2015-12-30 16:16:01', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '26', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 16:20:07', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '30', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120004', 'admin', '管理员', '2015-12-30 16:58:03', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '32', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120004', 'admin', '管理员', '2015-12-30 16:58:24', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '33', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 17:11:53', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '35', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120003', 'admin', '管理员', '2015-12-30 17:12:01', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '36', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 11:34:45', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '37', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120005', 'admin', '管理员', '2016-01-05 14:57:09', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '38', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 14:57:41', '1900-01-01 00:00:00', '保存订单：已收金额215242', 'admin', '管理员', '', '39', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 14:57:45', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '40', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 15:02:10', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '41', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 15:02:14', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '42', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 15:02:18', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '43', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-05 15:02:32', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '44', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-05 15:02:35', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '45', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-05 15:02:38', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '46', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-05 15:02:43', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '47', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 16:12:59', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '52', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-05 16:13:12', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '53', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:25:02', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '54', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:26:00', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '55', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:26:19', '1900-01-01 00:00:00', '保存订单：已收金额215242', 'admin', '管理员', '', '56', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:26:39', '1900-01-01 00:00:00', '保存订单：已收金额215242', 'admin', '管理员', '', '57', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:28:09', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '58', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:28:14', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '59', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:28:20', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '60', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:35:19', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '61', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:35:57', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '62', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:36:01', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '63', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:36:07', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '64', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 11:36:59', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '65', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:47:25', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '66', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:48:36', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '67', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:48:44', '1900-01-01 00:00:00', '保存订单：已收金额215242', 'admin', '管理员', '', '68', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:48:56', '1900-01-01 00:00:00', '保存订单：已收金额215242', 'admin', '管理员', '', '69', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:48:59', '1900-01-01 00:00:00', '保存订单：已收金额215242', 'admin', '管理员', '', '70', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:58:54', '1900-01-01 00:00:00', '保存订单：已收金额21524', 'admin', '管理员', '', '71', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:59:02', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '72', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010001', 'admin', '管理员', '2016-01-08 11:59:11', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '73', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120002', 'admin', '管理员', '2016-01-08 12:03:27', '1900-01-01 00:00:00', '保存订单：已收金额444', 'admin', '管理员', '', '74', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120002', 'admin', '管理员', '2016-01-08 12:03:31', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '75', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120001', 'admin', '管理员', '2016-01-08 14:42:46', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '76', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120005', 'admin', '管理员', '2016-01-08 17:07:21', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '77', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS15120005', 'admin', '管理员', '2016-01-08 17:08:42', '1900-01-01 00:00:00', '确认收货', 'admin', '管理员', '', '78', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010002', 'admin', '管理员', '2016-01-21 15:33:05', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '79', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010002', 'admin', '管理员', '2016-02-02 16:24:56', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '81', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010010', 'admin', '管理员', '2016-02-03 10:43:38', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '82', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010009', 'admin', '管理员', '2016-02-03 10:43:45', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '83', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010009', 'admin', '管理员', '2016-02-03 10:44:07', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '84', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010009', 'admin', '管理员', '2016-02-03 10:44:24', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '85', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010009', 'admin', '管理员', '2016-02-03 10:46:58', '1900-01-01 00:00:00', '拒收。原因：快递人员服务差', 'admin', '管理员', '', '86', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010009', 'admin', '管理员', '2016-02-03 10:54:54', '1900-01-01 00:00:00', '撤销到已发货', 'admin', '管理员', '', '87', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010009', 'admin', '管理员', '2016-02-03 10:55:16', '1900-01-01 00:00:00', '拒收。原因：擅自退回', 'admin', '管理员', '', '88', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010012', 'admin', '管理员', '2016-02-03 10:56:26', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '89', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010012', 'admin', '管理员', '2016-02-03 10:56:32', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '90', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010012', 'admin', '管理员', '2016-02-03 10:56:42', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '91', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010012', 'admin', '管理员', '2016-02-03 10:57:41', '1900-01-01 00:00:00', '拒收。原因：订单重复', 'admin', '管理员', '', '92', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010002', 'admin', '管理员', '2016-02-03 16:43:56', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '93', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010002', 'admin', '管理员', '2016-02-03 16:43:59', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '94', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010002', 'admin', '管理员', '2016-02-03 16:44:06', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '95', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010010', 'admin', '管理员', '2016-02-03 16:44:06', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '96', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-03 16:48:59', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '97', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-03 16:49:08', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '98', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-03 16:49:11', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '99', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-03 16:49:20', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '100', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010004', 'admin', '管理员', '2016-02-04 18:12:34', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '101', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010011', 'admin', '超级管理员', '2016-02-18 16:22:16', '0000-00-00 00:00:00', 'dadsad', 'admin', '超级管理员', '', '102', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 11:41:56', '1900-01-01 00:00:00', '下单', 'admin', '超级管理员', '', '103', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 12:31:33', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '104', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 12:54:08', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '105', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 12:56:40', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '106', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 14:01:04', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '107', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 14:01:51', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '108', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 14:02:35', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '109', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 14:02:52', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '110', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '超级管理员', '2016-02-19 14:04:13', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '超级管理员', '', '111', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-23 16:26:20', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '112', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020003', 'admin', '管理员', '2016-02-23 16:31:36', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '113', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '管理员', '2016-02-23 16:49:41', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '114', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '管理员', '2016-02-23 16:51:18', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '115', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '管理员', '2016-02-23 16:55:14', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '116', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '管理员', '2016-02-23 16:55:32', '1900-01-01 00:00:00', '拒收。原因：快递人员服务差', 'admin', '管理员', '', '117', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020003', 'admin', '管理员', '2016-02-24 10:56:04', '2016-02-24 10:56:04', '312321', 'admin', '管理员', '', '118', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '管理员', '2016-02-24 10:56:16', '2016-02-24 10:56:16', '11111', 'admin', '管理员', '', '119', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '管理员', '2016-02-24 10:57:05', '2016-02-24 10:57:05', '312312', 'admin', '管理员', '', '120', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-24 11:00:14', '2016-02-24 11:00:14', '111111', 'admin', '管理员', '', '121', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-24 11:02:26', '2016-02-24 11:02:26', '112233', 'admin', '管理员', '', '122', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020002', 'admin', '管理员', '2016-02-24 11:02:57', '2016-02-24 11:02:57', '321321', 'admin', '管理员', '', '123', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-24 14:37:44', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '124', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-24 14:37:52', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '125', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-24 14:40:35', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '126', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-24 14:41:02', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '127', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020001', 'admin', '管理员', '2016-02-24 15:12:16', '1900-01-01 00:00:00', '拒收。原因：快递人员服务差', 'admin', '管理员', '', '128', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030001', 'admin', '管理员', '2016-03-04 11:58:19', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '129', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-04 15:19:08', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '130', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-04 15:19:15', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '131', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-04 15:19:20', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '132', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-04 15:19:29', '1900-01-01 00:00:00', '保存订单：已收金额123', 'admin', '管理员', '', '133', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-04 15:19:39', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '134', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010008', 'admin', '管理员', '2016-03-07 14:52:05', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '135', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010010', 'admin', '管理员', '2016-03-07 14:57:46', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '136', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 14:58:12', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '137', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010002', 'admin', '管理员', '2016-03-07 15:00:18', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '138', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020003', 'admin', '管理员', '2016-03-07 15:00:59', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '139', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020003', 'admin', '管理员', '2016-03-07 15:01:07', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '140', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:01:30', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '141', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:01:42', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '142', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:01:52', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '143', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:04:33', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '144', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:05:28', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '145', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:05:35', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '146', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:05:44', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '147', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:07:29', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '148', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:07:37', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '149', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:07:43', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '150', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:07:52', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '151', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:25:00', '1900-01-01 00:00:00', '物流撤销：仓库原因', 'admin', '管理员', '', '152', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:25:09', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '153', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:25:15', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '154', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:25:22', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '155', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:33:49', '1900-01-01 00:00:00', '物流撤销：销售原因', 'admin', '管理员', '', '156', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 15:37:10', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '157', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 15:37:22', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '158', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 15:37:27', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '159', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:37:34', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '160', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:37:42', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '161', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 15:37:42', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '162', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 15:37:57', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '163', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 15:37:57', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '164', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 15:40:33', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '165', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 15:40:40', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '166', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 16:44:39', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '167', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 16:46:24', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '168', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 16:46:31', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '169', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 16:46:39', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '170', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 16:47:00', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '171', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 16:47:49', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '172', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 16:47:56', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '173', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 16:51:46', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '174', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-07 16:51:52', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '175', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:19:20', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '176', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:22:14', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '177', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:22:19', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '178', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:22:26', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '179', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:22:34', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '180', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:24:03', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '181', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:24:21', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '182', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:26:27', '1900-01-01 00:00:00', '物流撤销：仓库原因', 'admin', '管理员', '', '183', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:30:41', '1900-01-01 00:00:00', '保存订单：已收金额222', 'admin', '管理员', '', '184', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:30:55', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '185', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:30:59', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '186', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:31:05', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '187', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:31:11', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '188', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:31:29', '1900-01-01 00:00:00', '物流撤销：销售原因', 'admin', '管理员', '', '189', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:55:01', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '190', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:55:08', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '191', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 17:55:17', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '192', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 18:36:56', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '193', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 18:37:16', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '194', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 18:37:19', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '195', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 18:37:28', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '196', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 18:46:58', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '197', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:17:32', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '198', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:22:47', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '199', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:22:50', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '200', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:22:57', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '201', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:23:08', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '202', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:23:31', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '203', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:23:44', '1900-01-01 00:00:00', '物流撤销：客户原因', 'admin', '管理员', '', '204', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:27:22', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '205', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:27:28', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '206', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-07 19:27:35', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '207', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010008', 'admin', '管理员', '2016-03-08 10:52:10', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '208', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-08 10:52:25', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '209', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-08 14:11:03', '1900-01-01 00:00:00', '保存订单：已收金额246', 'admin', '管理员', '', '210', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-08 14:11:07', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '211', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-08 14:12:06', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '212', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-08 14:12:12', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '213', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-08 14:12:18', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '214', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010004', 'admin', '管理员', '2016-03-08 14:29:18', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '215', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010004', 'admin', '管理员', '2016-03-08 14:29:40', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '216', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:16', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '217', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:24', '1900-01-01 00:00:00', '保存订单：已收金额123', 'admin', '管理员', '', '218', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:28', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '219', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:33', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '220', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:36', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '221', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:41', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '222', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:48', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '223', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 14:41:54', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '224', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-08 15:13:34', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '225', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-08 15:13:45', '1900-01-01 00:00:00', '保存订单：已收金额123', 'admin', '管理员', '', '226', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-08 15:13:48', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '227', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-08 15:13:53', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '228', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-08 15:14:02', '1900-01-01 00:00:00', '财务审核通过', 'admin', '管理员', '', '229', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-08 15:14:39', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '230', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030003', 'admin', '管理员', '2016-03-08 16:52:07', '1900-01-01 00:00:00', '拒收。原因：快递人员服务差', 'admin', '管理员', '', '231', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030002', 'admin', '管理员', '2016-03-08 16:53:37', '1900-01-01 00:00:00', '拒收。原因：快递人员服务差', 'admin', '管理员', '', '232', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-10 11:30:48', '1900-01-01 00:00:00', '修改价格', 'admin', '管理员', '', '233', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:31:37', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '234', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:32:23', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '235', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:32:28', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '236', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:36:44', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '237', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:36:52', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '238', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:36:56', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '239', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:37:00', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '240', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-11 10:37:03', '1900-01-01 00:00:00', '保存订单：已收金额0', 'admin', '管理员', '', '241', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030001', 'admin', '管理员', '2016-03-18 11:47:33', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '242', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-18 11:51:27', '1900-01-01 00:00:00', '保存订单：已收金额21', 'admin', '管理员', '', '243', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-18 11:51:52', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '244', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-18 11:52:06', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '245', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030001', 'admin', '管理员', '2016-03-21 09:58:42', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '246', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030001', 'admin', '管理员', '2016-03-21 10:01:59', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '247', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030001', 'admin', '管理员', '2016-03-21 10:02:20', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '248', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030001', 'admin', '管理员', '2016-03-21 10:58:07', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '249', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020003', 'admin', '管理员', '2016-03-21 10:58:07', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '250', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010010', 'admin', '管理员', '2016-03-21 11:03:25', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '252', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 11:03:43', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '253', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 11:07:57', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '254', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 11:13:34', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '255', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030001', 'admin', '管理员', '2016-03-21 11:21:49', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '256', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020003', 'admin', '管理员', '2016-03-21 11:21:49', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '257', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010005', 'admin', '管理员', '2016-03-21 11:25:56', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '258', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16020003', 'admin', '管理员', '2016-03-21 14:23:20', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '259', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 14:25:50', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '260', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 14:53:05', '1900-01-01 00:00:00', '修改联系信息', 'admin', '管理员', '', '266', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 14:53:19', '1900-01-01 00:00:00', '修改联系信息', 'admin', '管理员', '', '267', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 14:53:28', '1900-01-01 00:00:00', '修改联系信息', 'admin', '管理员', '', '268', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 14:53:41', '1900-01-01 00:00:00', '修改联系信息', 'admin', '管理员', '', '269', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 15:13:54', '1900-01-01 00:00:00', '更改订单类型为正常单', 'admin', '管理员', '', '274', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-21 15:14:51', '1900-01-01 00:00:00', '更改订单类型为换货单', 'admin', '管理员', '', '275', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010005', 'admin', '管理员', '2016-03-21 17:44:40', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '278', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010006', 'admin', '管理员', '2016-03-22 14:22:59', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '279', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010005', 'admin', '管理员', '2016-03-22 14:49:06', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '280', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030005', 'admin', '管理员', '2016-03-23 16:50:35', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '281', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030005', 'admin', '管理员', '2016-03-23 16:50:40', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '282', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030005', 'admin', '管理员', '2016-03-23 16:54:05', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '283', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030005', 'admin', '管理员', '2016-03-23 16:54:43', '1900-01-01 00:00:00', '发货', 'admin', '管理员', '', '284', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030005', 'admin', '管理员', '2016-03-23 17:04:03', '1900-01-01 00:00:00', '拒收。原因：快递人员服务差', 'admin', '管理员', '', '285', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030005', 'admin', '管理员', '2016-03-23 17:06:09', '1900-01-01 00:00:00', '撤销到已发货', 'admin', '管理员', '', '286', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030005', 'admin', '管理员', '2016-03-23 17:15:32', '1900-01-01 00:00:00', '拒收。原因：拒绝收方开箱验货', 'admin', '管理员', '', '287', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030006', 'admin', '管理员', '2016-03-24 16:31:53', '1900-01-01 00:00:00', '下单', 'admin', '管理员', '', '288', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030006', 'admin', '管理员', '2016-03-25 19:54:38', '1900-01-01 00:00:00', '保存订单：已收金额111', 'admin', '管理员', '', '289', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030006', 'admin', '管理员', '2016-03-25 19:54:41', '1900-01-01 00:00:00', '确认到审单', 'admin', '管理员', '', '290', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030006', 'admin', '管理员', '2016-03-25 19:54:52', '1900-01-01 00:00:00', '审单通过', 'admin', '管理员', '', '291', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-03-28 17:05:29', '1900-01-01 00:00:00', '撤回未确认', 'admin', '管理员', '', '292', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010011', 'admin', '管理员', '2016-03-31 10:19:44', '1900-01-01 00:00:00', '确认收货', 'admin', '管理员', '', '293', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16010005', 'admin', '管理员', '2016-03-31 10:20:27', '1900-01-01 00:00:00', '拒收。原因：拒绝收方开箱验货', 'admin', '管理员', '', '294', '否', '未完成');
INSERT INTO `xsad` VALUES ('XS16030004', 'admin', '管理员', '2016-04-01 11:05:57', '1900-01-01 00:00:00', '保存订单：已收金额21', 'admin', '管理员', '', '295', '否', '未完成');

-- ----------------------------
-- Table structure for xsae
-- ----------------------------
DROP TABLE IF EXISTS `xsae`;
CREATE TABLE `xsae` (
  `xsae01` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `xsae02` varchar(50) DEFAULT '' COMMENT '拒收原因',
  PRIMARY KEY (`xsae01`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xsae
-- ----------------------------
INSERT INTO `xsae` VALUES ('1', '物流原因');
INSERT INTO `xsae` VALUES ('2', '客户原因');
INSERT INTO `xsae` VALUES ('3', '客服原因');
INSERT INTO `xsae` VALUES ('4', '寄方要求退回');

-- ----------------------------
-- Table structure for xsaf
-- ----------------------------
DROP TABLE IF EXISTS `xsaf`;
CREATE TABLE `xsaf` (
  `xsaf01` int(11) unsigned DEFAULT '0',
  `xsaf02` varchar(100) DEFAULT '' COMMENT '内容',
  `xsaf03` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  PRIMARY KEY (`xsaf03`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xsaf
-- ----------------------------
INSERT INTO `xsaf` VALUES ('1', '快递人员服务差', '1');
INSERT INTO `xsaf` VALUES ('1', '派送范围超区', '2');
INSERT INTO `xsaf` VALUES ('1', '擅自退回', '3');
INSERT INTO `xsaf` VALUES ('1', '拒绝收方开箱验货', '4');
INSERT INTO `xsaf` VALUES ('1', '当地操作点滞留，延误派送', '5');
INSERT INTO `xsaf` VALUES ('1', '顾客无法自提\r\n', '6');
INSERT INTO `xsaf` VALUES ('1', '派送时效慢', '7');
INSERT INTO `xsaf` VALUES ('1', '未按照顾客约定时间派送', '8');
INSERT INTO `xsaf` VALUES ('2', '无法联系顾客', '9');
INSERT INTO `xsaf` VALUES ('2', '经济紧张\r\n', '10');
INSERT INTO `xsaf` VALUES ('2', '周围人用过或不同意使用', '11');
INSERT INTO `xsaf` VALUES ('2', '收方不在当地，无法代提', '12');
INSERT INTO `xsaf` VALUES ('2', '已购买其他产品', '13');
INSERT INTO `xsaf` VALUES ('2', '开箱验货后拒收', '14');
INSERT INTO `xsaf` VALUES ('2', '否认订购', '15');
INSERT INTO `xsaf` VALUES ('2', '身体条件不允许', '16');
INSERT INTO `xsaf` VALUES ('2', '无理由拒收', '17');
INSERT INTO `xsaf` VALUES ('2', '被同行截单', '18');
INSERT INTO `xsaf` VALUES ('3', '强推强卖导致退单', '19');
INSERT INTO `xsaf` VALUES ('3', '重复下单', '20');
INSERT INTO `xsaf` VALUES ('3', '客服服务差\r\n', '21');
INSERT INTO `xsaf` VALUES ('4', '地址错误', '22');
INSERT INTO `xsaf` VALUES ('4', '订单重复\r\n', '23');
INSERT INTO `xsaf` VALUES ('4', '更改付款方式', '24');
