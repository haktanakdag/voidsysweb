CREATE TABLE `admin` (
  `admin` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `admin` (`admin`, `sifre`, `mail`) VALUES
('admin', 'pass', 'haktan.akdag@gmail.com');

CREATE TABLE `anahtarlar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `anahtarad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ozel` tinyint(2) DEFAULT NULL,
  `grup` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `defter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `projeid` int(10) DEFAULT NULL,
  `islemtip` int(10) DEFAULT NULL,
  `tutar` decimal(10,0) DEFAULT NULL,
  `islemtarih` varchar(12) COLLATE utf8_turkish_ci DEFAULT NULL,
  `islemaciklama` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `detayaciklama` text COLLATE utf8_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `kullanicilar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `sifre` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `telefon` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `seviyeid` int(10) DEFAULT NULL,
  `birimid` int(10) DEFAULT NULL,
  `unvanid` int(10) DEFAULT NULL,
  `gorevid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `kullanicilar` (`id`, `adsoyad`, `email`, `sifre`, `telefon`, `seviyeid`) VALUES
(1, 'Haktan Akdağ', 'haktan.akdag@gmail.com', '1', '05556634987', 0);


CREATE TABLE `listebaslik` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lbaciklama` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `listedetay` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `baslikid` int(10) DEFAULT NULL,
  `ldaciklama` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(1, 'Bilgi_Islem_Gorev_Tipleri');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(1, 1,'Kullanıcı Hatası'),
(2, 1,'Donanım Arızası'),
(3, 1,'Uygulama Hatası'),
(4, 1,'Yazılım Hatası'),
(5, 1,'Yeni Uygulama'),
(6, 1,'Kayıt Ekleme Silme Güncelleme');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(2, 'Anahtar_Gruplari');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(7, 2,'Kayıtlar'),
(8, 2,'Görevler'),
(9, 2,'Yazılar'),
(10,2,'Ürünler'),
(11,2,'Resimler'),
(12,2,'Menüler'),
(14,2,'Görev Tanım');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(3, 'Görev Durum');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(15,3,'Aktif'),
(16,3,'Beklemede'),
(17,3, 'Pasif'),
(18,3, 'İptal'),
(19,3, 'Kapalı'),
(20,3,'Aktif'),
(21,3,'Beklemede');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(4, 'Aciliyet');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(22,4, 'Düşük'),
(23,4, 'Normal'),
(24,4, 'Yüksek');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(5, 'Kaynak');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(25,5, 'Müşteri'),
(26,5, 'Test'),
(27,5, 'Kalite');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(6, 'İşlem Tür');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(28,6, 'Montaj'),
(29,6, 'Boyama'),
(30,6, 'Kodlama');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(7, 'Anket Tanım Durum');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(31,7, 'Aktif'),
(32,7, 'Pasif');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(8, 'Anket Soru Tip');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(33,8, 'karakter'),
(34,8, 'sayisal');
INSERT INTO `listebaslik` (`id`, `lbaciklama`) VALUES
(9,'Cinsiyet');
INSERT INTO `listedetay` (`id`, `baslikid`, `ldaciklama`) VALUES
(35,9, 'ERKEK'),
(36,9, 'KADIN');

CREATE TABLE `olay` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bastarih` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bittarih` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `olay` text COLLATE utf8_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `lisans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uygulama` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bayikodu` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `musterinumarasi` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL ,
  `bilgisayar` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bastarih` date DEFAULT NULL,
  `bittarih` date DEFAULT NULL,
  `durum` tinyint(4) DEFAULT NULL,
  `aciklama` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

insert into lisans(uygulama,bayikodu,musterinumarasi,bilgisayar,bastarih,bittarih,durum,aciklama)
values('VOIDRPT','0','0','BFEBFBFF000506E3BSN12345678901234567','2019-01-01','2099-01-01',1,'HAKTANPC');
insert into lisans(uygulama,bayikodu,musterinumarasi,bilgisayar,bastarih,bittarih,durum,aciklama)
values('VOIDRPT','0','0','BFEBFBFF000506E3BSN12345678901234567','2019-01-01','2099-01-01',1,'HAKTANPC');
--
-- insert into lisans (uygulama,bilgisayar,bastarih,bittarih,durum,aciklama)Values('VOIDRPT','BFEBFBFF000506E3BSN12345678901234567','2018-06-01','2018-12-31',1,'HAKTANPC')
-- insert into lisans (uygulama,bilgisayar,bastarih,bittarih,durum,aciklama)Values('VOIDRPT','BFEBFBFF000406E3MP16N7RE','2018-06-01','2018-12-31',1,'FURKANPC')
-- insert into lisans (uygulama,bilgisayar,bastarih,bittarih,durum,aciklama)Values('VOIDRPT','1FABFBFF000306F2, 1FABFBFF000006F2None','2018-06-01','2018-12-31',1,'17NOLUSUNUCU')
--
CREATE TABLE `parametreler` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `paciklama` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `deger` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `parametreler` (`id`, `paciklama`, `deger`) VALUES
(1, '5', '1'),
(2, '6', '1'),
(3, '7', '1'),
(4, '8', '1'),
(5, '11', '-1'),
(6, '12', '-1'),
(7, '13', '-1'),
(8, '14', '-1'),
(9, '15', '-1');

INSERT INTO `parametreler` (`paciklama`, `deger`) VALUES
('kaynak_liste_bag', '5'),
('durum_liste_bag', '3'),
('aciliyet_liste_bag', '4'),
('islemtur_liste_bag', '6'),
('anketdurum_liste_bag', '7'),
('anketsorutip_liste_bag', '8'),
('cinsiyet_liste_bag', '9');

CREATE TABLE `dersler` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dersad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;



CREATE TABLE `raporlar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `raporad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kaynak` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `tip` tinyint(5) DEFAULT NULL,
  `veritip` tinyint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


INSERT INTO `raporlar` (`id`, `raporad`, `kaynak`, `tip`, `veritip`) VALUES
(9, 'defter_rapor', 'vw_defter', 1, 1),
(10, 'defter_rapor_ozet_ssp', 'ssp_rpt_defter_ozet', 1, 0),
(11, 'defter_rapor_detay_ssp', 'ssp_rpt_defter_detay', 1, 0),
(12, 'defter_rapor_ssp', 'ssp_rpt_defter', 1, 0),
(13, 'defter_rapor2', 'vw_defter_ozet', 1, 1),
(14, 'adisyon_detay', 'vw_rpt_adisyon_detay', 1, 1),
(15, 'adisyon_baslik', 'vw_rpt_adisyon_baslik', 1, 1),
(16, 'adisyon_toplam', 'vw_rpt_adisyon_toplam', 1, 1),
(17, 'satis_yapilan_urun', 'vw_rpt_satilan_urun', 1, 1),
(18,'RptGorevler','bt_gorevler_ssp',1,0),
(19, 'rpt_anketsonuc', 'view_anketsonuc', 0, 1);


CREATE TABLE `secenekler` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `secenekad` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `secenekbagid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


INSERT INTO `secenekler` (`id`, `secenekad`, `secenekbagid`) VALUES
(1, 'Genel', 0),
(2, 'Giriş Çıkış Tipi', 1),
(3, 'Giriş', 2),
(4, 'Çıkış', 2),
(5, 'Nakit Giriş', 3),
(6, 'Çek Giriş', 3),
(7, 'Senet Giriş', 3),
(8, 'Kredi Kartı Giriş', 3),
(9, 'Resmi Ödemeler', 4),
(10, 'Diğer Ödemeler', 4),
(11, 'Mal Alımları', 4),
(12, 'Belediye Ödemeleri', 9),
(13, 'Maaş Ödemeleri', 9),
(14, 'Yemek Ödemeleri', 9),
(15, 'Ürün Alımları', 10),
(16, 'Hizmet Alımları', 10);

CREATE TABLE `projeler` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sirketid` int(10) DEFAULT NULL,
  `projead` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

insert  into `projeler`(`id`,`sirketid`,`projead`) values (1,1,'Proje 1');

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `menuad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `baglanti` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `menubag` int(10) DEFAULT NULL,
  `menubaslik` tinyint(2) DEFAULT NULL,
  `sira` int(10) DEFAULT NULL,
  `anasayfa` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;



INSERT INTO `menu` (`id`, `menuad`, `baglanti`, `menubag`, `menubaslik`, `sira`, `anasayfa`) VALUES
(1, 'Genel', NULL, 0, 1, 1, 0),
(2, 'Tanımlamalar', NULL, 0, 1, 2, 0),
(3, 'Adisyon', NULL, 0, 1, 3, 0),
(4, 'Üretim', NULL, 0, 1, 4, 0),
(5, 'Kalite', NULL, 0, 1, 5, 0),
(6, 'Ön Muhasebe', NULL, 0, 1, 6, 0),
(7, 'İşlemler', NULL, 0, 1, 7, 0),
(8, 'Quiz', NULL, 0, 1, 7, 0),
(9, 'Raporlar', NULL, 0, 1, 8, 0),

--
-- GENEL MENÜ
--

(100, 'Mail Değiştir', 'adminpanel.php?lx=maildegistir.php', 1, 0, 1, 0),
(101, 'Şifre Değiştir', 'adminpanel.php?lx=sifredegistir.php', 1, 0, 1, 0),
(102, 'Sirketler', 'adminpanel.php?lx=sirketler.php', 1, 0, 1, 0),
(103, 'Şubeler', 'adminpanel.php?lx=subeler.php', 1, 0, 2, 0),
(104, 'Projeler', 'adminpanel.php?lx=projeler.php', 1, 0, 2, 0),
(105, 'Lisanslar', 'adminpanel.php?lx=lisanslar.php', 1, 0, 2, 0),
(106, 'Bayiler', 'adminpanel.php?lx=bayiler.php', 1, 0, 2, 0),
--
-- TANIMLAMALAR MENÜSÜ
--
(201, 'Anahtarlar', 'adminpanel.php?lx=anahtarlar.php', 2, 0, 1, 0),
(202, 'Liste Baslık ', 'adminpanel.php?lx=listebasliklar.php', 2, 0, 2, 0),
(203, 'Liste Detay', 'adminpanel.php?lx=listedetaylar.php', 2, 0, 3, 0),
(204, 'Parametreler', 'adminpanel.php?lx=parametreler.php', 2, 0, 4, 0),
(205, 'Kullanıcılar', 'adminpanel.php?lx=kullanicilar.php', 2, 0, 5, 0),
--
-- ADİSYON MENÜSÜ
--
(301, 'Ürünler', 'adminpanel.php?lx=urunler.php', 3, 0, 1, 0),
(302, 'Ürün Birimler', 'adminpanel.php?lx=urunbirimler.php', 3, 0, 2, 0),
(303, 'Fiyatlar', 'adminpanel.php?lx=fiyatlar.php', 3, 0, 3, 0),
(304, 'Masalar', 'adminpanel.php?lx=masalar.php', 3, 0, 4, 0),
(305, 'Kuryeler', 'adminpanel.php?lx=kuryeler.php', 3, 0, 4, 0),
(306, 'Adisyon', 'adminpanel.php?lx=./adisyon/index.php', 3, 0, 5, 0),
--
-- ÜRETİM MENÜSÜ
--
(401, 'Üretim', 'adminpanel.php?lx=uretimler.php', 4, 0, 2, 0),
--
-- KALİTE MENÜSÜ
--
(501,'Birimler', 'adminpanel.php?lx=birimler.php', 5, 0, 1, 1),
(502,'Ünvanlar', 'adminpanel.php?lx=unvanlar.php', 5, 0, 2, 1),
(503,'Görev Tanımlar', 'adminpanel.php?lx=gorevtanimlari.php', 5, 0, 3, 0),
(504,'İş tanımları', 'adminpanel.php?lx=istanimlari.php', 5, 0, 4, 1),
(505,'Anket Tanımlama', 'adminpanel.php?lx=ankettanim.php', 5, 0, 5, 0),
(506,'Anketler', 'adminpanel.php?lx=anketler.php', 5, 0, 6, 0),
(507,'Görev Atama', 'adminpanel.php?lx=b_gorevatama.php', 5, 0, 7, 1),
(508,'Görevler', 'adminpanel.php?lx=b_gorevler.php', 5, 0, 8, 1),
(509,'Görevlerim', 'adminpanel.php?lx=b_gorevlerim.php', 5, 0, 9, 1),
--
-- ÖN MUHASEBE MENÜSÜ
--
(601, 'Seçenekler', 'adminpanel.php?lx=secenekler.php', 6, 0, 1, 0),
(602, 'Defter', 'adminpanel.php?lx=defter.php', 6, 0, 2, 0),
(603, 'Depolar', 'adminpanel.php?lx=depolar.php', 6, 0, 3, 0),
(604, 'Stok Gruplar', 'adminpanel.php?lx=stokgruplar.php', 6, 0, 4, 0),
(605, 'Stok EkGruplar', 'adminpanel.php?lx=stokekgruplar.php', 6, 0, 5, 0),
(606, 'Stoklar', 'adminpanel.php?lx=stoklar.php', 6, 0, 6, 0),
(607, 'Müşteri Gruplar', 'adminpanel.php?lx=musterigruplar.php', 6, 0, 7, 0),
(608, 'Müşteri EkGruplar', 'adminpanel.php?lx=musteriekgruplar.php', 6, 0, 8, 0),
(609, 'Müşteriler', 'adminpanel.php?lx=musteriler.php', 6, 0, 9, 0),
(610, 'Fis Girisi', 'adminpanel.php?lx=fisler.php', 6, 0, 9, 0),
(611, 'Aktarımlar', 'adminpanel.php?lx=aktarimlar.php', 6, 0, 9, 0),
--
-- İŞLEMLER MENÜSÜ
--
(701, 'Kayıtlar', 'adminpanel.php?lx=kayitlar.php', 7, 0, 1, 0),
(702, 'Yazılar', 'adminpanel.php?lx=yazilar.php', 7, 0, 2, 0),
(703,'Döküman', 'adminpanel.php?lx=dokuman.php', 7, 0, 3, 0),
(704,'Olaylar', 'adminpanel.php?lx=olaylar.php', 7, 0, 4, 0),
(705, 'Gorevler', 'adminpanel.php?lx=gorevler.php', 7, 0, 5, 0),
(706, 'Sosyal Medya', 'adminpanel.php?lx=sosyalmedyakayitlari.php', 7, 0, 5, 0),

-- Quiz MENÜSÜ
--
(801, 'Dersler', 'adminpanel.php?lx=dersler.php', 8, 0, 1, 0),
(802, 'Quiz', 'adminpanel.php?lx=quizler.php', 8, 0, 2, 0),
--
-- RAPORLAR MENÜSÜ
--
(901,'Bt iş listesi', 'adminpanel.php?lx=../raporlar/btrapor.php', 9, 0, 1, 0),
(902,'Cafe Raporları', 'adminpanel.php?lx=../raporlar/caferaporlari.php', 9, 0, 2, 0),
(903,'Defter Raporu', 'adminpanel.php?lx=../raporlar/defterraporu.php', 9, 0, 3, 0),
(904,'Üretim Raporu', 'adminpanel.php?lx=../raporlar/uretimraporu.php', 9, 0, 4, 0),
(905,'Quiz Raporu', 'adminpanel.php?lx=../raporlar/quizraporu.php', 9, 0, 4, 0);


CREATE TABLE `mobilmenu` (
  `id` int(10) NOT NULL,
  `menuad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `baglanti` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `sira` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `mobilmenu` (`id`, `menuad`, `baglanti`, `sira`) VALUES 
(1,'Adisyonlar','',1),
(2,'Anket','',2),
(3,'Üretim','',3),
(4,'Defter','',4),
(5,'Raporlar','',5);

CREATE TABLE `sirketler` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sirketad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

insert  into `sirketler`(`id`,`sirketad`) values (1,'Sirket 1');

CREATE TABLE `adisyonbaslik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaid` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kuryeid` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bastarihsaat` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bittarihsaat` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `toplamtutar` decimal(8,2) DEFAULT NULL,
  `acikkapali` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `adisyondetay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslikid` int(11) DEFAULT NULL,
  `urunid` int(11) DEFAULT NULL,
  `satmiktar` int(11) DEFAULT NULL,
  `sattutar` decimal(8,2) DEFAULT NULL,
  `odmiktar` int(11) DEFAULT NULL,
  `odtutar` decimal(8,2) DEFAULT NULL,
  `islemtarihsaat` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;



CREATE TABLE `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urunkod` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `urunad` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `anahtarlar` text COLLATE utf8_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


--
-- Tablo döküm verisi `urunler`
--



/*drop table masalar*/
CREATE TABLE `masalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaad` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `masalar`
--

INSERT INTO `masalar` (`id`, `masaad`) VALUES
(1, 'Masa1');


CREATE TABLE `kuryeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kuryead` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `kuryeler` (`id`, `kuryead`) VALUES
(1, 'Kurye1');

CREATE TABLE `urunbirimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aciklama` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `refurunid` int(11) DEFAULT NULL,
  `bagurunid` int(11) DEFAULT NULL,
  `carpan` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fiyatlar`
--
CREATE TABLE `fiyatlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aciklama` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `urunid` int(11) DEFAULT NULL,
  `alisfiyat` decimal(8,2) DEFAULT NULL,
  `satisfiyat` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;




CREATE TABLE `quiz` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`quizad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
 `aciklama` text COLLATE utf8_turkish_ci,
`dersid` int(10) NOT NULL,
`durumid` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

create view vquiz as
select q.id,q.quizad,d.dersad from quiz q inner join dersler d on d.id=q.dersid;


CREATE TABLE `quizsoru` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `soru`  varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `quizid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;



CREATE TABLE `quizcevap` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `quizid` int(10) DEFAULT NULL,
  `cevap` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `soruid` int(10) DEFAULT NULL,
  `dy` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `quizsonucbaslik` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `quizid` int(10) DEFAULT NULL,
  `adsoyad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aciklama` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `quizsonucdetay` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `baslikid` int(10) NOT NULL,
  `quizid` int(10) DEFAULT NULL,
 `soruid` int(10) DEFAULT NULL,
  `cevapid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `anketbaslik` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `anketad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aciklama` text COLLATE utf8_turkish_ci,
  `durumid` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `anketsoru` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `anketid` int(10) DEFAULT NULL,
  `sorutip` tinyint(5) DEFAULT NULL,
  `soru` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `anketcevapbaslik` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `anketid` int(10) DEFAULT NULL,
  `adsoyad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cinsiyet` tinyint(2) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `telefon` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adres` text COLLATE utf8_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `anketcevapdetay` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `anketid` int(10) DEFAULT NULL,
  `anketsoruid` int(10) DEFAULT NULL,
  `anketcevapid` int(10) DEFAULT NULL,
  `cevapsayi` int(10) DEFAULT NULL,
  `cevapyazi` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `kayitlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kayitad` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `kayitdetay` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `anahtarlar` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `okunma` int(11) NOT NULL,
  `anasayfadagoster` tinyint(4) DEFAULT NULL,
  `tamam` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `sosyalmedyakayitlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kayitad` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `kayitdetay` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `kayitbaglanti` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `anahtarlar` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `okunma` int(11) NOT NULL,
  `anasayfadagoster` tinyint(4) DEFAULT NULL,
  `tamam` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `gorevler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gorevad` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `gorevdetay` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `anahtarlar` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `okunma` int(11) NOT NULL,
  `kullanici` int(11) NOT NULL,
  `tamam` tinyint(4) DEFAULT NULL,
  `gorevtarih` varchar(45) DEFAULT NULL,
  `duzenlemetarih` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `konular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konuad` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `konudetay` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `anahtarlar` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `okunma` int(11) NOT NULL,
  `kullanici` int(11) NOT NULL,
  `tamam` tinyint(4) DEFAULT NULL,
  `kayittarih` varchar(45) DEFAULT NULL,
  `duzenlemetarih` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `yazilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yaziad` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `yazidetay` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `anahtarlar` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `yazibaglanti` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `okunma` int(11) DEFAULT NULL,
  `anasayfadagoster` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `subeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subead` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `subedetay` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `ent_urunler` (
  `urunkod` VARCHAR(50) NOT NULL,
  `urunad` VARCHAR(100) NULL,
  `grup` VARCHAR(100) NULL,
  `ekgrup` VARCHAR(100) NULL,
  PRIMARY KEY (`urunkod`));
  
  CREATE TABLE `ent_recete` (
  `mamulkod` VARCHAR(50) NOT NULL,
  `hamkod` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`mamulkod`));


CREATE TABLE `uretimbaslik` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mamkod` VARCHAR(50) NULL,
  `mamad` VARCHAR(100) NULL,
  `uretmiktar` DECIMAL(28,8) NULL,
  `depokod` INT NULL,
  `tarih` VARCHAR(45) NULL,
PRIMARY KEY (`id`));

  
CREATE TABLE `uretimdetay` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `baslikid` INT NOT NULL,
  `hamkod` VARCHAR(50) NULL,
  `hamad` VARCHAR(100) NULL,
  `tuketmiktar` DECIMAL(28,8) NULL,
PRIMARY KEY (`id`));

CREATE TABLE `birimler` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `birimad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `birimbagid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `birimyetki` (
  `birimid` int(11) DEFAULT NULL,
  `yetkibirimid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `gorevtanim` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `birimid` int(10) DEFAULT NULL,
  `unvanid` int(10) DEFAULT NULL,
  `bagliunvanid` int(10) DEFAULT NULL,
  `adsoyad` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `gorevinamaci` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `gorevkisatanimi` text COLLATE utf8_turkish_ci,
  `vekaletid` int(10) DEFAULT NULL,
  `issorumluluklari` text COLLATE utf8_turkish_ci,
  `yetkileri` text COLLATE utf8_turkish_ci,
  `anahtarlar` text COLLATE utf8_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `istanimlari` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `isne` text COLLATE utf8_turkish_ci,
  `iskimden` text COLLATE utf8_turkish_ci,
  `isinozeti` text COLLATE utf8_turkish_ci,
  `amac` text COLLATE utf8_turkish_ci,
  `yontem` text COLLATE utf8_turkish_ci,
  `surec` text COLLATE utf8_turkish_ci,
  `ortam` text COLLATE utf8_turkish_ci,
  `iskime` text COLLATE utf8_turkish_ci,
  `gorevid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

create view view_istanimlari
 AS select i.id AS id
 ,g.adsoyad AS adsoyad
 ,i.isne AS isne
 ,g.id as gorevid
 from istanimlari i join gorevtanim g on g.id = i.gorevid;

CREATE TABLE `dokumanlar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `konu` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `icerik` text COLLATE utf8_turkish_ci,
  `dosya` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `izinler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kulid` int(11) DEFAULT NULL,
  `aciklama` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bastarih` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bittarih` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `izinyeri` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `izintel` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `onay` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `unvanlar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bagliunvanid` int(10) DEFAULT NULL,
  `unvanad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `gorevbaslik` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `konu` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kaynakid` int(10) DEFAULT NULL,
  `nedenid` int(10) DEFAULT NULL,
  `aciliyetid` int(10) DEFAULT NULL,
  `durumid` int(10) DEFAULT NULL,
  `acankulid` int(10) DEFAULT NULL,
  `kapatankulid` int(10) DEFAULT NULL,
  `acilistarih` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `acilissaat` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kapanistarih` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kapanissaat` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `dissistemno1` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `dissistemno2` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `dissistemno3` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `gorevdetay` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gorevbaslikid` int(10) DEFAULT NULL,
  `islemturid` int(10) DEFAULT NULL,
  `detayaciklama` text COLLATE utf8_turkish_ci,
  `islemtarih` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `islemsaat` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `islemyapankulid` int(10) DEFAULT NULL,
  `sonkulid` int(10) DEFAULT NULL,
  `suresaat` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `kullaniciyetki` (
  `kulid` int(11) DEFAULT NULL,
  `yetkibirimid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `depo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `depokod` varchar(50) DEFAULT NULL,
  `depoad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `musteri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `musterikod` varchar(50) DEFAULT NULL,
  `musteriunvan` varchar(100) DEFAULT NULL,
  `grupkod` varchar(100) DEFAULT NULL,
  `ekgrupkod` varchar(100) DEFAULT NULL,
  `ilgilikisi` varchar(100) DEFAULT NULL,
  `vd` varchar(50) DEFAULT NULL,
  `vn` varchar(11) DEFAULT NULL,
  `telno` varchar(20) DEFAULT NULL,
  `adres` varchar(250) DEFAULT NULL,
  `aciklama` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `musterigrup` (
`grupkod` varchar(50) DEFAULT NULL,
`grupad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `musteriekgrup` (
`ekgrupkod` varchar(50) DEFAULT NULL,
`ekgrupad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `stok` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`stokkod` varchar(50) DEFAULT NULL,
`stokad` varchar(100) DEFAULT NULL,
`grupkod` varchar(50) DEFAULT NULL,
`ekgrupkod` varchar(50) DEFAULT NULL,
`birim` varchar(20) DEFAULT NULL,
`kdvoran` int(11) DEFAULT NULL,
`aciklama` varchar(250) DEFAULT NULL,
`alisfiyat` decimal(28,8) DEFAULT NULL,
`satisfiyat` decimal(28,8) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `stokgrup` (
`grupkod` varchar(50) DEFAULT NULL,
`grupad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `stokekgrup` (
  `ekgrupkod` varchar(50) DEFAULT NULL,
  `ekgrupad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `belge` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`belgekod` varchar(15) DEFAULT NULL,
`yil` int(11) DEFAULT NULL,
`tarih` date DEFAULT NULL,
`musteriid` int(11) DEFAULT NULL,
`tip` tinyint(4) DEFAULT NULL,
`tur` tinyint(4) DEFAULT NULL,
`kdvtoplam` decimal(28,8) DEFAULT NULL,
`isktoplam` decimal(28,8) DEFAULT NULL,
`bruttoplam` decimal(28,8) DEFAULT NULL,
`nettoplam` decimal(28,8) DEFAULT NULL,
`durum` tinyint(4) DEFAULT NULL,
`yazdirildi` tinyint(4) DEFAULT NULL,
`faturano` varchar(15) DEFAULT NULL,
`irsaliyeno` varchar(15) DEFAULT NULL,
`siparisno` varchar(15) DEFAULT NULL,
`fisno` varchar(15) DEFAULT NULL,
`kayitkul` int(11) DEFAULT NULL,
`kayittarih` datetime DEFAULT NULL,
`duzenlekul` int(11) DEFAULT NULL,
`duzenletarih` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

CREATE TABLE `belgedetay` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`belgeid` int(11) DEFAULT NULL,
`yil` int(11) DEFAULT NULL,
`stokid` int(11) DEFAULT NULL,
`miktar` decimal(28,8) DEFAULT NULL,
`birimfiyat` decimal(28,8) DEFAULT NULL,
`netfiyat` decimal(28,8) DEFAULT NULL,
`brutfiyat` decimal(28,8) DEFAULT NULL,
`kdvoran` decimal(28,8) DEFAULT NULL,
`kdvtutar` decimal(28,8) DEFAULT NULL,
`stoktip` tinyint(4) DEFAULT NULL,
`tarih` varchar(20) DEFAULT NULL,
`depokodu` int(11) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


CREATE TABLE `bayiler` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`bayikodu` VARCHAR(45) NULL,
	`bayiadi` VARCHAR(45) NULL,
	`logokucuk` VARCHAR(45) NULL,
	`logobuyuk` VARCHAR(45) NULL,
	`logoico` VARCHAR(45) NULL,
	`sunucuadresi` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_turkish_ci;


CREATE TABLE `bayidetay` (
	`bayiid` INT NOT NULL,
	`sabittel` VARCHAR(45) NULL,
	`ceptel` VARCHAR(45) NULL,
	`fax` VARCHAR(45) NULL,
	`adres` VARCHAR(45) NULL,
	`email` VARCHAR(45) NULL,
	`www` VARCHAR(45) NULL,
	`calsaathici` VARCHAR(45) NULL,
	`calsaathsonu` VARCHAR(45) NULL,
	`bizkimiz` VARCHAR(45) NULL,
	`facebookadr` VARCHAR(45) NULL,
	`twitteradr` VARCHAR(45) NULL,
	`instagramadr` VARCHAR(45) NULL,
	`detaybilgi` VARCHAR(45) NULL,
	`anahtarkelimeler` VARCHAR(45) NULL,
  PRIMARY KEY (`bayiid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_turkish_ci;


CREATE TABLE `bayiyetki` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`bayiid` INT NOT NULL,
	`haberduyurular` VARCHAR(45) NULL,
	`urunler` VARCHAR(45) NULL,
	`kampanyalar` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_turkish_ci;

DELIMITER $$
CREATE PROCEDURE `ssp_rpt_defter`(
  IN bastarih VARCHAR(12),
  IN bittarih VARCHAR(12),
  IN sirketid int
)
BEGIN
select d.id
,f.sirketad
,p.projead
,s.secenekad as islem
,d.islemaciklama as aciklama
,d.islemtarih
,case when d.tutar<0 then d.tutar else 0 end cikis
,(case when d.tutar>0 then d.tutar else 0 end) giris 
,d.detayaciklama
from defter d 
left join secenekler s on s.id=islemtip
inner join projeler p on p.id = d.projeid
inner join sirketler f on f.id=p.sirketid and f.id=sirketid
where d.islemtarih between bastarih and bittarih
union all
select 
0,'TOPLAM','TOPLAM','TOPLAM','TOPLAM',''
,sum(case when d.tutar<0 then d.tutar else 0 end)
,sum(case when d.tutar>0 then d.tutar else 0 end)  
,concat('TOPLAM = ',sum(case when d.tutar<0 then d.tutar else 0 end)+sum(case when d.tutar>0 then d.tutar else 0 end) )
from defter d 
inner join projeler p on p.id = d.projeid
inner join sirketler f on f.id=p.sirketid and f.id=sirketid
where d.islemtarih between bastarih and bittarih;

END $$

DELIMITER ;

DELIMITER $$
CREATE PROCEDURE ssp_rpt_defter_detay(
  IN bastarih VARCHAR(12),
  IN bittarih VARCHAR(12)
)
BEGIN
select d.id
,s.secenekad as islem
,d.islemaciklama as aciklama
,d.islemtarih
,case when d.tutar<0 then d.tutar else '' end cikis
,case when d.tutar>0 then d.tutar else '' end giris 
,d.detayaciklama
from defter d 
left join secenekler s on s.id=islemtip
where d.islemtarih between bastarih and bittarih;

END $$

DELIMITER ;

create view vw_defter_ozet
as
select 
sum(case when d.tutar<0 then d.tutar else '' end) cikis
,sum(case when d.tutar>0 then d.tutar else '' end) giris 
,sum(case when d.tutar<0 then d.tutar else '' end)+sum(case when d.tutar>0 then d.tutar else '' end) durum
from defter d;

create view vw_defter
as
select d.id
,s.secenekad as islem
,d.islemaciklama as aciklama
,d.islemtarih
,case when d.tutar<0 then d.tutar else '' end cikis
,case when d.tutar>0 then d.tutar else '' end giris 
,d.detayaciklama
from defter d 
left join secenekler s on s.id=d.islemtip;

create view vw_adisyon_masa_acik
as
select m.id as masaid,a.id adisyonid,m.masaad,a.bastarihsaat,a.bittarihsaat,a.toplamtutar,a.acikkapali from adisyonbaslik a
inner join masalar m on m.id =a.masaid
where a.acikkapali=1;


create view vw_adisyon_kurye_acik
as
select k.id as kuryeid ,a.id adisyonid,k.kuryead,a.bastarihsaat,a.bittarihsaat,a.toplamtutar,a.acikkapali from adisyonbaslik a
inner join kuryeler k on k.id =a.kuryeid
where a.acikkapali=1;



create view vw_rpt_adisyon_baslik
as
select ad.baslikid adsNo
,m.masaad
,ab.bastarihsaat bastarihsaat
,ab.bittarihsaat bittarihsaat
,case when ab.acikkapali =1 then 'Açık' Else 'Kapalı' end durum
,sum(ad.satmiktar) satmiktar
,sum(ad.sattutar) sattutar
,sum(ad.odmiktar) odmiktar
,sum(ad.odtutar) odtutar
from adisyondetay ad 
inner join adisyonbaslik ab on ab.id = ad.baslikid
inner join masalar m on m.id=ab.masaid
inner join urunler u on u.id=ad.urunid
group by
ad.baslikid
,m.masaad
,ab.bastarihsaat
,ab.bittarihsaat
,ab.acikkapali
order by ad.baslikid desc;

create view vw_rpt_paketservis_baslik
as
select ad.baslikid adsNo
,k.kuryead
,ab.bastarihsaat bastarihsaat
,ab.bittarihsaat bittarihsaat
,case when ab.acikkapali =1 then 'Açık' Else 'Kapalı' end durum
,sum(ad.satmiktar) satmiktar
,sum(ad.sattutar) sattutar
,sum(ad.odmiktar) odmiktar
,sum(ad.odtutar) odtutar
from adisyondetay ad 
inner join adisyonbaslik ab on ab.id = ad.baslikid
inner join kuryeler k on k.id=ab.kuryeid
inner join urunler u on u.id=ad.urunid
group by
ad.baslikid
,k.kuryead
,ab.bastarihsaat
,ab.bittarihsaat
,ab.acikkapali
order by ad.baslikid desc;


create view vw_rpt_adisyon_detay
as
select ad.baslikid AS adsNo
,m.masaad AS masaad
,ab.bastarihsaat AS bastarihsaat
,ab.bittarihsaat AS bittarihsaat
,(case when (ab.acikkapali = 1) then 'Açık' else 'Kapalı' end) AS durum
,u.urunad AS urunad
,ad.satmiktar AS satmiktar
,ad.sattutar AS sattutar
,ad.odmiktar AS odmiktar
,ad.odtutar AS odtutar
,ad.islemtarihsaat AS detaytarih 
from adisyondetay ad 
inner join adisyonbaslik ab on ab.id = ad.baslikid
inner join masalar m on m.id = ab.masaid
inner join urunler u on u.id = ad.urunid
order by ad.baslikid desc;

create view vw_rpt_paketservis_detay
as
select ad.baslikid AS adsNo
,k.kuryead AS kuryead
,ab.bastarihsaat AS bastarihsaat
,ab.bittarihsaat AS bittarihsaat
,(case when (ab.acikkapali = 1) then 'Açık' else 'Kapalı' end) AS durum
,u.urunad AS urunad
,ad.satmiktar AS satmiktar
,ad.sattutar AS sattutar
,ad.odmiktar AS odmiktar
,ad.odtutar AS odtutar
,ad.islemtarihsaat AS detaytarih 
from adisyondetay ad 
inner join adisyonbaslik ab on ab.id = ad.baslikid
inner join kuryeler k on k.id = ab.kuryeid
inner join urunler u on u.id = ad.urunid
order by ad.baslikid desc;


create view vw_rpt_adisyon_toplam
as
select 
substr(ab.bastarihsaat,1,10) as tarih
,sum(ad.satmiktar) satmiktar
,sum(ad.sattutar) sattutar
,sum(ad.odmiktar) odmiktar
,sum(ad.odtutar) odtutar
from adisyondetay ad
inner join adisyonbaslik ab on ab.id=ad.baslikid
group by
substr(bastarihsaat,1,10)
order by substr(bastarihsaat,1,10) desc;

create view vw_rpt_gunluksatilanurunsayisi as
select u.urunad, sum(ad.satmiktar) as satmiktar
from adisyondetay ad
inner join urunler u on u.id=ad.urunid
inner join adisyonbaslik ab on ab.id=ad.baslikid 
group by u.urunad;

create view vw_rpt_satilan_urun
as
select 
substr(ab.bastarihsaat,1,10) as tarih
,u.urunad
,sum(ad.satmiktar) as satmiktarkayitlar
from adisyondetay ad
inner join adisyonbaslik ab on ab.id=ad.baslikid
inner join urunler u on u.id=ad.urunid
group by u.urunad,substr(ab.bastarihsaat,1,10)
order by substr(ab.bastarihsaat,1,10) desc;


create view v_list_konular
as
select t.id
,t.konuad
,t.konudetay
,case when tamam =1 then 'OK' ELSE 'NOK' end durum
,k.adsoyad kullanici
 from konular t inner join kullanicilar k on k.id=t.kullanici;

DELIMITER $$
CREATE procedure bt_gorevler_ssp (
	bastarih varchar(50), bittarih varchar(50)
)
begin
select t.id
,t.gorevad
,t.gorevdetay
,case when tamam =1 then 'OK' ELSE 'NOK' end durum
,k.adsoyad kullanici
,t.gorevtarih
,t.duzenlemetarih
 from gorevler t inner join kullanicilar k on k.id=t.kullanici
 where DATE_FORMAT(left(t.gorevtarih,10),'%Y-%m-%d') between 
 DATE_FORMAT(str_to_date(bastarih,"%m/%d/%Y"),'%Y-%m-%d') and  
 DATE_FORMAT(str_to_date(bittarih,"%m/%d/%Y"),'%Y-%m-%d');
END$$
DELIMITER ;

-- call mb_sistem_db.bt_gorevler_ssp ('01/01/2017','12/31/2017'); use bt;

create view v_list_gorevler
as
select t.id
,t.gorevad
,t.gorevdetay
,case when tamam =1 then 'OK' ELSE 'NOK' end durum
,k.adsoyad kullanici
 from gorevler t inner join kullanicilar k on k.id=t.kullanici;
 
create view v_rpt_gorevler
as
select t.id
,t.gorevad
,t.gorevdetay
,case when tamam =1 then 'OK' ELSE 'NOK' end durum
,k.adsoyad kullanici
 from gorevler t inner join kullanicilar k on k.id=t.kullanici;


create view v_rpt_uretim
as
select ub.id
,mamkod
,mamad
,REPLACE(cast(uretmiktar as decimal(28,3)),'.',',') uretmiktar
,hamkod
,hamad
,REPLACE(cast(tuketmiktar as decimal(28,3)),'.',',') tuketmiktar
,depokod
,tarih 
FROM uretimbaslik ub
inner join uretimdetay ud on ud.baslikid=ub.id;


create view view_anketcevaplar as
select s.id AS id
,s.anketid AS anketid
,acd.anketcevapid AS anketcevapid
,s.soru AS soru
,case when ld.ldaciklama = 'sayisal' then acd.cevapsayi else acd.cevapyazi end AS cevap 
from anketsoru s 
inner join listedetay ld on ld.id = s.sorutip 
inner join anketcevapdetay acd on acd.anketsoruid = s.id;

create view view_anketsonuc
as
select ab.id AS id
,ab.anketad AS anketad
,ldanketdurum.ldaciklama AS anketdurum
,acb.id AS cevapid
,acb.adsoyad AS adsoyad
,ldcinsiyet.ldaciklama AS cinsiyet
,acb.email AS email
,acb.telefon AS telefon
,cevaplar
.soru AS soru
,cevaplar.cevap AS cevap 
from anketbaslik ab
inner join listedetay ldanketdurum on ldanketdurum.id = ab.durumid
inner join anketcevapbaslik acb on acb.anketid = ab.id 
inner join listedetay ldcinsiyet on ldcinsiyet.id=acb.cinsiyet 
inner join view_anketcevaplar cevaplar on cevaplar.anketid = ab.id and cevaplar.anketcevapid = acb.id;

CREATE view view_yetki_birimler AS 
select ky.kulid AS kulid
,ky.yetkibirimid AS yetkibirimid 
from kullaniciyetki ky 
union 
select k.id AS kulid
,biy.yetkibirimid AS yetkibirimid
 from kullanicilar k
 inner join birimler b on b.id = k.birimid
 inner join birimyetki biy on biy.yetkibirimid = b.id;
 
 
CREATE view view_gorev_son AS select gb.id AS gorevbaslikid
,max(gd.id) AS maxgorevdetayid 
from gorevbaslik gb 
inner join gorevdetay gd on gd.gorevbaslikid = gb.id group by gb.id;


create view view_gorevbaslik
 AS select gb.id AS id
 ,gb.konu AS konu
 ,gb.kaynakid AS kaynakid
 ,ldkaynak.ldaciklama AS kaynak
 ,gb.nedenid AS nedenid
 ,ldneden.ldaciklama AS neden
 ,gb.aciliyetid AS aciliyetid
 ,ldaciliyet.ldaciklama AS aciliyet
 ,gb.durumid AS durumid
 ,lddurum.ldaciklama AS durum
 ,concat(gb.acilistarih,' - ',gb.acilissaat) AS acilis
 ,concat(gb.kapanistarih,' - ',gb.kapanissaat) AS kapanis
 ,gb.dissistemno1 AS dissistemno1
 ,gb.dissistemno2 AS dissistemno2
 ,gb.dissistemno3 AS dissistemno3
 ,acankul.adsoyad AS acankul
 ,kapatankul.adsoyad AS kapatankul
 ,gd.sonkulid AS sonkulid
 ,sonkul.adsoyad AS sonkul
 from view_gorev_son vg
 inner join gorevbaslik gb on gb.id = vg.gorevbaslikid
 inner join gorevdetay gd on gd.gorevbaslikid = gb.id and vg.maxgorevdetayid = gd.id
 left join listedetay ldkaynak on ldkaynak.id = gb.kaynakid
 left join listedetay ldneden on ldneden.id = gb.nedenid
 left join listedetay lddurum on lddurum.id = gb.durumid 
 left join listedetay ldaciliyet on ldaciliyet.id = gb.aciliyetid 
 left join kullanicilar acankul on acankul.id = gb.acankulid 
 left join kullanicilar kapatankul on kapatankul.id = gb.kapatankulid
 left join kullanicilar sonkul on sonkul.id = gd.sonkulid 
 order by gb.id desc;


CREATE view view_gorevdetay AS 
select gb.id AS gorevbaslikid
,gd.id AS gorevdetayid
,gd.islemturid AS islemturid
,ldislemtur.ldaciklama AS islemtur
,gd.detayaciklama AS detayaciklama
,concat(gd.islemtarih,' - ',gd.islemsaat) AS detayislemtarihsaat
,islemyapankul.adsoyad AS islemyapankul
,sonkul.adsoyad AS sonkul
,gd.suresaat AS suresaat
,lddurum.ldaciklama AS durum
 from gorevbaslik gb
 inner join gorevdetay gd on gd.gorevbaslikid = gb.id
 left join listedetay lddurum on lddurum.id = gb.durumid 
 left join listedetay ldislemtur on ldislemtur.id = gd.islemturid
 left join kullanicilar islemyapankul on islemyapankul.id = gd.islemyapankulid
 left join kullanicilar sonkul on sonkul.id = gd.sonkulid;
 
 CREATE view view_gorevler AS 
 select gb.id AS gorevid
 ,gb.konu AS konu
 ,gb.kaynakid AS kaynakid
 ,gb.nedenid AS nedenid
 ,gb.aciliyetid AS aciliyetid
 ,gb.durumid AS durumid
 ,gb.acankulid AS acankulid
 ,gb.acilistarih AS acilistarih
 ,gb.acilissaat AS acilissaat
 ,gb.kapanistarih AS kapanistarih
 ,gb.kapanissaat AS kapanissaat
 ,gb.dissistemno1 AS dissistemno1
 ,gb.dissistemno2 AS dissistemno2
 ,gb.dissistemno3 AS dissistemno3
 ,gd.islemturid AS islemturid
 ,gd.detayaciklama AS detayaciklama
 ,gd.islemtarih AS islemtarih
 ,gd.islemsaat AS islemsaat
 ,gd.islemyapankulid AS islemyapankulid
 ,gd.sonkulid AS sonkulid
 ,gd.suresaat AS suresaat
 from gorevbaslik gb 
 inner join gorevdetay gd on gb.id = gd.gorevbaslikid;



