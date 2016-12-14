-- --------------------------------------------------------
-- Hostitel:                     127.0.0.1
-- Verze serveru:                10.1.13-MariaDB - mariadb.org binary distribution
-- OS serveru:                   Win32
-- HeidiSQL Verze:               9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportování struktury databáze pro
CREATE DATABASE IF NOT EXISTS `sem_web_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sem_web_db`;


-- Exportování struktury pro tabulka sem_web_db.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postTitle` text CHARACTER SET utf8 NOT NULL,
  `postContent` longtext CHARACTER SET utf8 NOT NULL,
  `file` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`),
  UNIQUE KEY `id_post_UNIQUE` (`id_post`),
  KEY `fk_posts_users1_idx` (`id_user`),
  CONSTRAINT `fk_posts_users1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku sem_web_db.posts: ~4 rows (přibližně)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id_post`, `id_user`, `postDate`, `postTitle`, `postContent`, `file`, `published`) VALUES
	(1, 1, '2016-12-07 00:12:40', 'Quamquam haec quidem praeposita recte et reiecta dicere licebit.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quia studebat laudi et dignitati, multum in virtute processerat. <b>Invidiosum nomen est, infame, suspectum.</b> Ita relinquet duas, de quibus etiam atque etiam consideret. Dicet pro me ipsa virtus nec dubitabit isti vestro beato M. Sint ista Graecorum; Nam de summo mox, ut dixi, videbimus et ad id explicandum disputationem omnem conferemus. Atqui pugnantibus et contrariis studiis consiliisque semper utens nihil quieti videre, nihil tranquilli potest. </p>\n\n<p>Collige omnia, quae soletis: Praesidium amicorum. Ergo id est convenienter naturae vivere, a natura discedere. Est tamen ea secundum naturam multoque nos ad se expetendam magis hortatur quam superiora omnia. Haec et tu ita posuisti, et verba vestra sunt. <a href=\'http://loripsum.net/\' target=\'_blank\'>Avaritiamne minuis?</a> <a href=\'http://loripsum.net/\' target=\'_blank\'>Ut id aliis narrare gestiant?</a> </p>\n\n<ol>\n	<li>Etsi ea quidem, quae adhuc dixisti, quamvis ad aetatem recte isto modo dicerentur.</li>\n	<li>Vide ne ista sint Manliana vestra aut maiora etiam, si imperes quod facere non possim.</li>\n	<li>Philosophi autem in suis lectulis plerumque moriuntur.</li>\n	<li>Sin dicit obscurari quaedam nec apparere, quia valde parva sint, nos quoque concedimus;</li>\n	<li>Sin autem eos non probabat, quid attinuit cum iis, quibuscum re concinebat, verbis discrepare?</li>\n</ol>\n\n\n<p>Duo Reges: constructio interrete. Quod cum accidisset ut alter alterum necopinato videremus, surrexit statim. Maximus dolor, inquit, brevis est. Quamquam te quidem video minime esse deterritum. Et nemo nimium beatus est; Sed haec omittamus; Prioris generis est docilitas, memoria; Illum mallem levares, quo optimum atque humanissimum virum, Cn. <i>Praeclarae mortes sunt imperatoriae;</i> </p>\n\n<ul>\n	<li>Sed ne, dum huic obsequor, vobis molestus sim.</li>\n	<li>Atqui haec patefactio quasi rerum opertarum, cum quid quidque sit aperitur, definitio est.</li>\n	<li>Nam Pyrrho, Aristo, Erillus iam diu abiecti.</li>\n</ul>\n\n\n<p>Quamquam haec quidem praeposita recte et reiecta dicere licebit. Et harum quidem rerum facilis est et expedita distinctio. Duarum enim vitarum nobis erunt instituta capienda. <b>Quis est tam dissimile homini.</b> ALIO MODO. Tanta vis admonitionis inest in locis; </p>\n\n<blockquote cite=\'http://loripsum.net\'>\n	Elicerem ex te cogeremque, ut responderes, nisi vererer ne Herculem ipsum ea, quae pro salute gentium summo labore gessisset, voluptatis causa gessisse diceres.\n</blockquote>\n\n\n<dl>\n	<dt><dfn>Immo alio genere;</dfn></dt>\n	<dd>Sed finge non solum callidum eum, qui aliquid improbe faciat, verum etiam praepotentem, ut M.</dd>\n	<dt><dfn>Stoicos roga.</dfn></dt>\n	<dd>Itaque contra est, ac dicitis;</dd>\n	<dt><dfn>Beatum, inquit.</dfn></dt>\n	<dd>Atqui pugnantibus et contrariis studiis consiliisque semper utens nihil quieti videre, nihil tranquilli potest.</dd>\n	<dt><dfn>ALIO MODO.</dfn></dt>\n	<dd>Theophrastus mediocriterne delectat, cum tractat locos ab Aristotele ante tractatos?</dd>\n	<dt><dfn>Certe non potest.</dfn></dt>\n	<dd>Verum esto: verbum ipsum voluptatis non habet dignitatem, nec nos fortasse intellegimus.</dd>\n</dl>\n\n\n<pre>\nCorporis autem voluptas si etiam praeterita delectat, non\nintellego, cur Aristoteles Sardanapalli epigramma tantopere\nderideat, in quo ille rex Syriae glorietur se omnis secum\nlibidinum voluptates abstulisse.\n\nQuod non faceret, si in voluptate summum bonum poneret.\n</pre>\n\n\n<p>An tu me de L. <code>Utram tandem linguam nescio?</code> Verum tamen cum de rebus grandioribus dicas, ipsae res verba rapiunt; Iam in altera philosophiae parte. </p>\n\n', '17873-Dokumentace.pdf', 1),
	(2, 2, '2016-12-07 13:45:10', 'Satisne ergo pudori consulat, si quis sine teste libidini pareat?aaaaad', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fortasse id optimum, sed ubi illud: Plus semper voluptatis? Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Cui Tubuli nomen odio non est? Et quod est munus, quod opus sapientiae? Duo Reges: constructio interrete. <a href="http://loripsum.net/">Etiam beatissimum?</a> Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; <a href="http://loripsum.net/">Murenam te accusante defenderem.</a></p>\r\n\r\n<pre>\r\nIdque si ita dicit, non esse reprehendendos luxuriosos, si\r\nsapientes sint, dicit absurde, similiter et si dicat non\r\nreprehendendos parricidas, si nec cupidi sint nec deos\r\nmetuant nec mortem nec dolorem.\r\n\r\nTanti autem aderant vesicae et torminum morbi, ut nihil ad\r\neorum magnitudinem posset accedere.\r\n</pre>\r\n\r\n<p>Sit enim idem caecus, debilis. Expectoque quid ad id, quod quaerebam, respondeas. Verba tu fingas et ea dicas, quae non sentias? Hanc ergo intuens debet institutum illud quasi signum absolvere. Idem adhuc; <em>Quid ergo hoc loco intellegit honestum?</em> <strong>Maximus dolor, inquit, brevis est.</strong></p>\r\n\r\n<h2>Conferam avum tuum Drusum cum C.</h2>\r\n\r\n<p>Quam nemo umquam voluptatem appellavit, appellat; Nam quid possumus facere melius? Maximas vero virtutes iacere omnis necesse est voluptate dominante. <a href="http://loripsum.net/">Istic sum, inquit.</a> Num quid tale Democritus? Ita ceterorum sententiis semotis relinquitur non mihi cum Torquato, sed virtuti cum voluptate certatio. <a href="http://loripsum.net/">Sint modo partes vitae beatae.</a></p>\r\n\r\n<p>Nihil sane.</p>\r\n\r\n<p>Si enim ad populum me vocas, eum.</p>\r\n\r\n<p>Efficiens dici potest.</p>\r\n\r\n<p>Res enim fortasse verae, certe graves, non ita tractantur, ut debent, sed aliquanto minutius.</p>\r\n\r\n<p>Erat enim Polemonis.</p>\r\n\r\n<p>Quod quidem iam fit etiam in Academia.</p>\r\n\r\n<p>Ille incendat?</p>\r\n\r\n<p>Qui potest igitur habitare in beata vita summi mali metus?</p>\r\n\r\n<p><code>Vide, quantum, inquam, fallare, Torquate.</code> Tertium autem omnibus aut maximis rebus iis, quae secundum naturam sint, fruentem vivere. <em>Sint modo partes vitae beatae.</em> <em>Bonum incolumis acies: misera caecitas.</em> Quid ergo hoc loco intellegit honestum? Refert tamen, quo modo.</p>\r\n\r\n<ul>\r\n	<li>Parvi enim primo ortu sic iacent, tamquam omnino sine animo sint.</li>\r\n	<li>Quam nemo umquam voluptatem appellavit, appellat;</li>\r\n	<li>Est enim effectrix multarum et magnarum voluptatum.</li>\r\n	<li>Respondent extrema primis, media utrisque, omnia omnibus.</li>\r\n</ul>\r\n\r\n<h3>Claudii libidini, qui tum erat summo ne imperio, dederetur.</h3>\r\n\r\n<p>Et quidem saepe quaerimus verbum Latinum par Graeco et quod idem valeat; Ergo illi intellegunt quid Epicurus dicat, ego non intellego? Dici enim nihil potest verius. <strong>Haeret in salebra.</strong></p>\r\n\r\n<blockquote>Quae etsi mihi nullo modo probantur, tamen Democritum laudatum a ceteris ab hoc, qui eum unum secutus esset, nollem vituperatum.</blockquote>\r\n\r\n<ol>\r\n	<li>Quis non odit sordidos, vanos, leves, futtiles?</li>\r\n	<li>Itaque vides, quo modo loquantur, nova verba fingunt, deserunt usitata.</li>\r\n	<li>Plane idem, inquit, et maxima quidem, qua fieri nulla maior potest.</li>\r\n	<li>Quid, si reviviscant Platonis illi et deinceps qui eorum auditores fuerunt, et tecum ita loquantur?aae</li>\r\n</ol>\r\n', '17873-Dokumentace.pdf', 1),
	(3, 2, '2016-12-07 20:25:53', 'Si mala non sunt, iacet omnis ratio Peripateticorum.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <code>Quid est igitur, inquit, quod requiras?</code> Egone non intellego, quid sit don Graece, Latine voluptas? <b>Cave putes quicquam esse verius.</b> Duo Reges: constructio interrete. Que Manilium, ab iisque M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Diodorus, eius auditor, adiungit ad honestatem vacuitatem doloris. </p>\n\n<ol>\n	<li>Ne amores quidem sanctos a sapiente alienos esse arbitrantur.</li>\n	<li>Nunc omni virtuti vitium contrario nomine opponitur.</li>\n	<li>Maximus dolor, inquit, brevis est.</li>\n</ol>\n\n\n<blockquote cite=\'http://loripsum.net\'>\n	Nemo est igitur, quin hanc affectionem animi probet atque laudet, qua non modo utilitas nulla quaeritur, sed contra utilitatem etiam conservatur fides.\n</blockquote>\n\n\n<p>Progredientibus autem aetatibus sensim tardeve potius quasi nosmet ipsos cognoscimus. Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam. Ut id aliis narrare gestiant? Sed vos squalidius, illorum vides quam niteat oratio. <mark>Age, inquies, ista parva sunt.</mark> At iste non dolendi status non vocatur voluptas. <a href=\'http://loripsum.net/\' target=\'_blank\'>Praeteritis, inquit, gaudeo.</a> Sed haec ab Antiocho, familiari nostro, dicuntur multo melius et fortius, quam a Stasea dicebantur. <a href=\'http://loripsum.net/\' target=\'_blank\'>Sed haec omittamus;</a> Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. <a href=\'http://loripsum.net/\' target=\'_blank\'>Istam voluptatem, inquit, Epicurus ignorat?</a> <mark>Hos contra singulos dici est melius.</mark> </p>\n\n<ul>\n	<li>Itaque rursus eadem ratione, qua sum paulo ante usus, haerebitis.</li>\n	<li>Cum audissem Antiochum, Brute, ut solebam, cum M.</li>\n	<li>Quod mihi quidem visus est, cum sciret, velle tamen confitentem audire Torquatum.</li>\n	<li>Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur?</li>\n	<li>Negat enim summo bono afferre incrementum diem.</li>\n</ul>\n\n\n<p>Satis est ad hoc responsum. <i>Simus igitur contenti his.</i> Verum hoc idem saepe faciamus. <a href=\'http://loripsum.net/\' target=\'_blank\'>Vide, quaeso, rectumne sit.</a> Sin dicit obscurari quaedam nec apparere, quia valde parva sint, nos quoque concedimus; Quam tu ponis in verbis, ego positam in re putabam. </p>\n\n<p>Ut proverbia non nulla veriora sint quam vestra dogmata. Te ipsum, dignissimum maioribus tuis, voluptasne induxit, ut adolescentulus eriperes P. <a href=\'http://loripsum.net/\' target=\'_blank\'>Quae cum essent dicta, discessimus.</a> Id est enim, de quo quaerimus. Ut in geometria, prima si dederis, danda sunt omnia. <code>Ratio enim nostra consentit, pugnat oratio.</code> </p>\n\n<dl>\n	<dt><dfn>Erat enim Polemonis.</dfn></dt>\n	<dd>Aliter enim explicari, quod quaeritur, non potest.</dd>\n	<dt><dfn>Avaritiamne minuis?</dfn></dt>\n	<dd>Cur id non ita fit?</dd>\n	<dt><dfn>Certe non potest.</dfn></dt>\n	<dd>Negat enim summo bono afferre incrementum diem.</dd>\n	<dt><dfn>Paria sunt igitur.</dfn></dt>\n	<dd>An est aliquid per se ipsum flagitiosum, etiamsi nulla comitetur infamia?</dd>\n</dl>\n\n\n<p><code>Hos contra singulos dici est melius.</code> Mihi enim satis est, ipsis non satis. An nisi populari fama? <a href=\'http://loripsum.net/\' target=\'_blank\'>Nemo igitur esse beatus potest.</a> Primum in nostrane potestate est, quid meminerimus? Quia nec honesto quic quam honestius nec turpi turpius. Quam ob rem tandem, inquit, non satisfacit? Utrum igitur tibi litteram videor an totas paginas commovere? <a href=\'http://loripsum.net/\' target=\'_blank\'>Sedulo, inquam, faciam.</a> Eaedem enim utilitates poterunt eas labefactare atque pervertere. </p>\n\n<pre>\nSed venio ad inconstantiae crimen, ne saepius dicas me\naberrare;\n\nNec enim ignoras his istud honestum non summum modo, sed\netiam, ut tu vis, solum bonum videri.\n</pre>\n\n\n', '23405-Dokumentace', 1),
	(4, 1, '2016-12-12 21:19:46', 'a', 'a', '', -1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Exportování struktury pro tabulka sem_web_db.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id_review` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `id_post` bigint(20) unsigned NOT NULL,
  `reviewDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewContent` longtext CHARACTER SET utf8 NOT NULL,
  `reviewKarma` int(100) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_review`),
  UNIQUE KEY `id_review_UNIQUE` (`id_review`),
  KEY `fk_reviews_posts1_idx` (`id_post`),
  KEY `fk_reviews_users1_idx` (`id_user`),
  CONSTRAINT `fk_reviews_posts1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_reviews_users1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku sem_web_db.reviews: ~3 rows (přibližně)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id_review`, `id_user`, `id_post`, `reviewDate`, `reviewContent`, `reviewKarma`, `locked`) VALUES
	(1, 3, 2, '2016-12-07 20:37:54', '<p>pěkn&yacute; čl&aacute;nekx</p>\r\n', 3, 0),
	(2, 3, 3, '2016-12-07 20:38:21', '<p>obstojn&yacute; čl&aacute;nekaaaexa</p>\r\n', 5, 1),
	(3, 1, 2, '2016-12-07 20:39:01', 'nedalo se to ani číst', -10, 1);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;


-- Exportování struktury pro tabulka sem_web_db.role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(10) unsigned NOT NULL,
  `role` varchar(60) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `id_role_UNIQUE` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku sem_web_db.role: ~2 rows (přibližně)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `role`) VALUES
	(0, 'Author'),
	(1, 'Reviewer'),
	(2, 'Administrator');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Exportování struktury pro tabulka sem_web_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(60) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_role` int(10) unsigned NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user_UNIQUE` (`id_user`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_users_role_idx` (`id_role`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku sem_web_db.users: ~5 rows (přibližně)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `login`, `email`, `password`, `creationDate`, `id_role`, `banned`) VALUES
	(1, 'admin', 'admin@admin.cz', '202cb962ac59075b964b07152d234b70', '2016-12-06 21:53:50', 2, 0),
	(2, 'autor', 'autor@autor.cz', '202cb962ac59075b964b07152d234b70', '2016-12-07 13:44:33', 0, 0),
	(3, 'review', 'review@review.cz', '202cb962ac59075b964b07152d234b70', '2016-12-07 13:44:50', 1, 0),
	(7, 'bob', '1@1.cz', 'c20ad4d76fe97759aa27a0c99bff6710', '2016-12-10 21:56:41', 0, 0),
	(15, 'admin1', 'admin@se.cz', '827ccb0eea8a706c4c34a16891f84e7b', '2016-12-11 01:34:20', 0, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
