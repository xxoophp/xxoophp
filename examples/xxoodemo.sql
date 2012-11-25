/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50162
Source Host           : localhost:3306
Source Database       : xxoodemo

Target Server Type    : MYSQL
Target Server Version : 50162
File Encoding         : 65001

Date: 2012-11-25 17:28:40
*/

CREATE DATABASE `xxoodemo`;
USE `xxoodemo`;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '越南雷人“天团”是谎言', '即使在娱乐业水平并不高的越南，HKT也是个小角色，因为故意走搞怪路线、故意扮丑才得到观众的注意，其音乐被一些媒体批为“垃圾”。', '爆炸式的冲天长发、城乡结合部的非主流服装、农业重金属摇滚范儿的音乐——自11月初在新浪注册微博以来，凭借着“幽怨的眼神、不羁的手势、洒脱的发型”，来自越南的“90后天团”HKT以令人咋舌的速度在网络上蹿红，每条微博都被转发10万次以上。\r\n\r\n在早期的MV中，这个3人组合中的“黑毛哥”、“白毛哥”和“黄毛哥”以极其大胆的手法，将忧郁深沉的中国歌曲《黄昏》硬生生地改编成动感十足的迪斯科音乐。他们在制作粗糙的MV中搔首弄姿、大展拳脚，舞蹈动作神似健美操，令网友大呼“刺瞎你的钛合金狗眼”。\r\n\r\n而翻唱了中文歌曲的MV《错错错》的剧情更是集狗血之大成：“黄毛哥”将出轨女友捉奸在床，第三者是个女人，受伤的“黄毛哥”夜店买醉，雨夜跪地痛哭，回忆起二人并肩看夕阳的美好过去，“以忧郁的表情和纯洁的内心一举俘获了众多女粉丝的芳心”。\r\n\r\n爆炸头、一字眉、烟熏妆、晃得人眼晕的黑白条纹装……HKT因造型酷似街头理发店招揽顾客的小工而被网友戏称为“洗剪吹少年”，再加上电子音、太空步、“山寨”中国“神曲”等吸引眼球的元素，不禁让人觉得似曾相识——以“雷”为卖点，赚眼球、搏出位，不惜一切代价出名，出名后再寻机转变形象，正是“审丑时代”的网络红人推销自己的一贯路数。', '越南，谎言', '2012-11-23 22:38:47');
INSERT INTO `article` VALUES ('2', '李新玲：农村学校撤并何去何从', '撤并乡村学校，应该充分考虑农民的利益主张。如何建立必要的民主程序，通过广泛的公众参与，推进教育决策的科学化、民主化，仍然是我国教育改革有待解决的重大命题。', '21世纪农村教育高峰论坛上公布的一系列数据，着实让人沉重：《农村教育布局调整十年评价报告》显示，2000年到2010年，在我国农村，平均每一天就要消失63所小学、30个教学点、3所初中，几乎每过一小时，就要消失4所农村学校。对十省农村中小学的抽样调查显示，农村小学生学校离家的平均距离为5.4公里，农村初中生离家的平均距离为17.47公里。（《燕赵都市报》11月19日）\r\n近些年，伴随着学龄人口的减少，学校适当调整是一个自然过程，但这个过程在其他力量的推动下，撤并速度之快、幅度之大超出想象。十年里，全国小学学生减少了37%，学校减少了52%。可以说，许多地方学校撤并的规模幅度，远远大于学生减少的幅度。', '农村，学校', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('3', '“尊严死”争议未决', '哈姆雷特的老命题，“活着还是死去，这是一个问题”，如今却成了全球性的新命题。', '这绝不只是一根看起来仅有小拇指粗、一米长的管子。它在一个人生命的最后时刻，有与“老天”讨价还价的能力。\r\n\r\n它穿过老许的鼻子，插进肺，每隔一会儿，就能吸出满满一管痰。当痰被吸出时，老许就能从昏迷中苏醒过来。起初，他能醒两三个小时，后来只能醒几分钟。\r\n\r\n几个月过去，这根管子眼看就要输了。因为，“吸的速度不如产生得快”。疼痛难忍的老许用尽全力，写下几个歪歪斜斜的字：“痰在肚子里！”\r\n\r\n这是他留下的最后的笔迹。\r\n\r\n就在老许靠管子“活着”的时候，在遥远的美国，另一根管子插在佛罗里达州一家养护院里一个名叫特丽的女人身上。这一年是2003年。植物人特丽依靠喂食管，已经存活了13年。', '尊严死，争议', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('4', '研究发现肥胖基因抗抑郁 胖人比瘦人更快乐', '核心提示：据英国媒体报道，一项新的研究结果显示，胖人比瘦人更加快乐，原因是导致他们肥胖的基因事实上也是“快乐基因”。', '据英国媒体11月21日报道，一项新的研究结果显示，胖人比瘦人更加快乐，原因是导致他们肥胖的基因事实上也是“快乐基因”。\r\n\r\nFTO是造成人体肥胖的关键遗传因素。但加拿大麦克玛斯特大学一个研究小组通过对来自21个国家的1.72万DNA样本进行分析后发现，那些拥有FTO的人出现抑郁的迹象要明显低于没有这种基因的人。据初步统计，FTO可以将抑郁风险降低8%。\r\n\r\n据悉，这项研究已得到了其他三项研究病患基因状况的国际研究的证实。', '快乐', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('5', '美国为何没有统一身份证？', '美国是一个建立在数据上的国度。不过，公民的自由特别是隐私权，给政府搜集个人信息的行为设定了边界，直接体现为统一身份证的难产。', '国会不同意，百姓不答应\r\n\r\n统一身份证，是美国近百年来隐私风波中的中心话题之一。\r\n\r\n在美国历史上，联邦政府从来没有发放过全国统一的身份证件。但在现实生活中，有3个证件，不同程度起到了身份证的作用。\r\n\r\n一是驾驶证。二是护照。三是社会安全号。罗斯福新政期间，他为了建立社会保障系统，提出为每一个有工作的人员，建立一个社会安全账号。设想一出，立刻遭到了“隐私派”激烈反对。最后，罗斯福向国会妥协并保证：这个号码仅仅用于社会保险，一定不会用于身份标识的领域，并且会被保密，这个提案才最终在国会通过。\r\n\r\n严格地说，社会安全号还算不上统一的身份证件。因为它只记录姓名，男女、年龄、住址、相片等基本信息都没有，公民也不需要随身携带，该号码被明确规定为个人隐私。1974年的《隐私法》，甚至还有专门的条文写明：“要控制社会安全号对个人隐私造成的威胁”。', '身份证，美国', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('6', '美国大选的那些“失败者”', '每届总统选举，胜利者只有一位，其余的竞争者都不得不成为败者，美国自然也不会例外。', '当地时间11月6日，美国大选结果出炉，奥巴马战胜罗姆尼成功赢得连任。\r\n\r\n如今，在绝大多数共和制国家中，不论实行总统制、半总统制或内阁制，总统是直接还是间接选出，在同一时期都只有一人。因此，每届总统选举，胜利者只有一位，其余的竞争者都不得不成为败者，美国自然也不会例外。\r\n\r\n不过，在当代民主政治体系中，败者并非一定意味着永不翻身。在美国历史上，不乏虽在总统选举中失败，却活得更加精彩的人物。', '美国，大选', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('7', '一名女大学生的非正常死亡', '青岛求实学院依然认为自己不应该承担法律上的责任。该院宣传部提供的《关于刘晓傲事件告社会书》强调，事情已得到圆满解决，60万元的赔偿金分别由涉事酒店以及当事老师赔付。', '19岁的刘晓傲，一直梦想大学毕业后做一名空姐。然而，这名花季女孩，读了不到两个月的空乘专业，还没来得及展翅高飞，就折翅陨落了。\r\n\r\n2012年9月1日，刘晓傲入读青岛求实职业技术学院（以下简称“青岛求实学院”）。10月27日，她与4名同学、6名老师一起喝了48瓶啤酒后，从酒店卫生间坠楼死亡。\r\n\r\n事情发生后，青岛求实学院坚称学校不应该承担法律责任，迟迟未能与死者家属达成赔偿协议。死者家属为此不断上访申诉，为化解社会矛盾，青岛求实学院所在的城阳区流亭街道办事处先期垫付60万元赔偿金，暂时平息了事态。\r\n\r\n这一广受舆论关注的大学生坠楼事件背后有何隐情，政府财政是否应该垫付赔偿金？中国青年报记者对此展开了调查。', '正常，死亡', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('8', '\r\n质疑“平坟”不是“网上吵闹”', '从周口平坟一开始启动，就伴随着汹涌的质疑之声，遗憾的是，这样的声音并没有被听进去', '此前有消息称，河南周口市“平坟复耕”工作已暂停推行，但周口市民政局社会事务科科长胡朝阳日前则向媒体表示，“绝对不会是网上一吵闹，这事就不干了。”下个月初，周口市将会对前一段的平坟复耕以及公墓建设方面，搞一个验收，做得好的单位要给予一定的奖励。（《法制日报》11月22日）\r\n周口市坚持“平坟复耕”的底气从何而来？根据报道披露，一是打铁先要自身硬，“市里一些家在周口区域的领导，都带头平了”；再一个是老百姓也认可，“老百姓在这件事里面，整体上是认为政府做了件好事的”；还有一个就是“省委、省政府都很认可，主流媒体也认可”。因此，公众通过网络发出的质疑，在周口这位官员看来，自然就是既不主流也无足轻重，“吵闹”而已。', '网上吵闹', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('9', '媒体制造“数学天才”神话', '轰动之后，往往紧跟着的是质疑。国内一些数学研究者发现，王骁威所获得的结果在好几年前就被俄罗斯人公布了，但人家并没有把它当什么“世界数学难题”，连论文都没发。', '王骁威本不愿意接受采访，他说，过多的采访没意义。但近来网络上对他的质疑声，让他愿意面对媒体并回复质疑。\r\n\r\n这是一个原本被视为又一个刘路（22岁破解“西塔潘猜想”，现为中南大学学生）的年轻人。刚被媒体报道时，外界发现两人有许多相似之处：同样生于1990年，同样并非优等生，同样据媒体称破解了悬而未决的“世界数学难题”而引起轰动，同样在国际知名学术刊物上发表论文。\r\n\r\n轰动之后，往往紧跟着的是质疑。国内一些数学研究者发现，王骁威所获得的结果在好几年前就被俄罗斯人公布了，但人家并没有把它当什么“世界数学难题”，连论文都没发。', '数学，天才', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('10', '流浪儿童之死引发各方追问', '就像很多较为复杂的社会问题一样，流浪儿童救助保护工作的确也是一项“责任落实”较为困难、有时甚至说不清责任在谁的事情。', '“如果有社会组织给他们送去水、食物和御寒衣物，他们或许不会死。”11月19日，广东省广州市的市中心办公楼里，广州启智社会工作服务中心总干事李森为3天前5名流浪儿童的意外死亡扼腕叹息，尽管事件发生在距离广州千里之遥的贵州省毕节市……\r\n\r\n11月16日清晨，5名身份不详、10岁左右的男童，被发现死于贵州省毕节市七星关区环东路人行道路边的一处垃圾箱内。警方初步分析得出结论，5个男孩可能是躲进垃圾箱避寒，窒息“闷死”。\r\n\r\n据附近居民描述，5个孩子住在垃圾箱附近的拆迁工地，用一些写有广告语的塑料篷布、水泥砖和三合板围成“小房子”居住。毕节近来天气寒冷，事发当晚还下起小雨，孩子们可能为避寒躲进垃圾箱。\r\n\r\n尸检结果显示，5名男孩为一氧化碳中毒死亡，其死亡垃圾箱内尚有用木炭生火取暖的痕迹。', '各方，追问', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('11', '“虐童女幼师被释放”追踪', '温岭警方披露虐童老师颜艳红被拘和释放决策过程，“罪名争执”影响案件定性。', '新京报讯 “对颜艳红，关她是依法，放她也是依法。”11月20日，在虐童案犯罪嫌疑人颜艳红被无罪释放后的第四天，浙江温岭警方接受采访详细披露了颜艳红刑拘和释放的决策过程。\r\n\r\n虐童案报案人并非家长\r\n\r\n温岭市公安局宣传科科长陈秋高表示，在虐童照片在网络上曝光后，反响强烈，考虑到当时的社会影响，警方对此事非常关注。\r\n\r\n据介绍，虐童案的报案人并非受害儿童家长，而是事发地附近的城西街道中心幼儿园。因为在此案初期，他们被误以为是事发地点，给他们造成负面影响。\r\n\r\n陈秋高表示，当时发现照片700多张，其中有10多张有明显虐童嫌疑，比如揪耳朵使小孩双脚离地，用胶带粘住嘴巴，把小孩倒置在垃圾桶等。根据这些线索，警方认为有必要立案，侦查是否有更多的虐童行为。\r\n\r\n温岭公安的法律依据是刑诉法第83条规定，公安机关或者检察院发现犯罪事实或者犯罪嫌疑人，应立案侦查。', '幼师，释放', '0000-00-00 00:00:00');
INSERT INTO `article` VALUES ('12', '小而精的典范 刨根问底一汽-大众奥迪Q3', '在2012年广州国际车展奥迪展台中，虽然有超级限量的中国版奥迪R8亮相，但主角显然还不是它，国产一汽奥迪Q3被单独摆在了最显眼的位置上，而且人气最旺。', '网易汽车11月22日广州车展现场报道 在2012年广州国际车展奥迪展台中，虽然有超级限量的中国版奥迪R8亮相，但主角显然还不是它，国产一汽奥迪Q3被单独摆在了最显眼的位置上，而且人气最旺。这款外形可爱而且精致的Q3国产化意味着价格将在进口版37.70-47.90万元的基础上进一步下探，新车预计在2013年上半年正式在国内上市。', '刨根，问底', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `page`
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `sign` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', '关于', 'about', '关于', '2012-11-23 23:16:57');
