<?php

if ($_SESSION['LANG'] == 'de') {
	echo 'var tmenuItems = [
    ["Registrieren","menue_call.php?go=tcontacts_data.inc&func=user_reg&dir=includes", "", "", "", "Als neuer User registrieren", "", "", "", ],
    ["Support","mailto:facebook@a-t-c.ch", "", "", "", "", "", "", "", ],
    ["Blog","http://alpenentransit.blogspot.com", "", "", "", "", "_blank", "", "", ],
    ["Sitemap","menue_call.php?go=atc_sitemap_&dir=stat", "", "", "", "", "", "", "", ],
    ["INFOS","", "", "", "", "", "", "", "", ],
        ["|Alpenschutz","", "", "", "", "", "", "", "", ],
			["||monitraf","http://www.monitraf.org/", "", "", "", "", "_blank", "", "", ],            
            ["||Alpenkonvention","http://www.alpenkonvention.org/page1_de.htm", "", "", "", "", "_blank", "", "", ],
            ["||Cipra","http://cipra.4teamwork.ch/de", "", "", "", "", "_blank", "", "", ],
            ["||Alpentransitboerse","http://www.alpentransitboerse.ch", "", "", "", "", "_blank", "", "", ],
            ["||Schweiz","http://www.uvek.admin.ch/themen/umwelt/00640/00642/index.html?lang=de", "", "", "", "", "_blank", "", "", ],
        ["|Zoll","", "", "", "", "", "", "", "", ],
            ["||Schweiz","http://www.ezv.admin.ch/index.html?lang=de", "", "", "", "", "_blank", "", "", ],
            ["||Oesterreich","http://www.bmf.gv.at/zoll/_start.htm", "", "", "", "", "_blank", "", "", ],
            ["||EU","http://ec.europa.eu/taxation_customs/customs/customs_controls/risk_management/customs_eu/index_de.htm", "", "", "", "", "_blank", "", "", ],
            ["||Frankreich","http://www.douane.gouv.fr/menu.asp?id=511", "", "", "", "", "_blank", "", "", ],
            ["||Slovenia","http://e-uprava.gov.si/e-uprava/en/zivljenjskeSituacijeDrevo.euprava?dogodek.id=12485", "", "", "", "", "_blank", "", "", ],
         ["WIR","", "", "", "", "XP Title Tip", "", "", "", ],
        ["|Impressum","menue_call.php?go=impressum_&dir=stat", "", "", "", "", "", "", "", ],
        ["|AGB","menue_call.php?go=agb_&dir=stat", "", "", "", "", "", "", "", ],
        ["|Datenschutz","menue_call.php?go=datenschutz_&dir=stat", "", "", "", "", "", "", "", ],
        ["|Wer sind Wir","http://www.a-t-c.ch/stat/LEBENSLAUF_GERT_DORN.doc", "", "", "", "", "", "", "", ],
 ];';
} elseif ($_SESSION['LANG'] == 'en'){

	echo 'var tmenuItems = [
	 ["englisch Registrieren","menue_call.php?go=tcontacts_data.inc&func=user_reg&dir=includes", "", "", "", "Als neuer User registrieren", "", "", "", ],
    ["Support","mailto:facebook@a-t-c.ch", "", "", "", "", "", "", "", ],
    ["Blog","http://alpenentransit.blogspot.com", "", "", "", "", "_blank", "", "", ],
    ["Sitemap","menue_call.php?go=atc_sitemap_&dir=stat", "", "", "", "", "", "", "", ],
    ["INFOS","", "", "", "", "", "", "", "", ],
        ["|Alpenschutz","", "", "", "", "", "", "", "", ],
["||monitraf","http://www.monitraf.org/", "", "", "", "", "_blank", "", "", ],            
            ["||Alpenkonvention","http://www.alpenkonvention.org/page1_de.htm", "", "", "", "", "_blank", "", "", ],
            ["||Cipra","http://cipra.4teamwork.ch/de", "", "", "", "", "_blank", "", "", ],
            ["||Alpentransitboerse","http://www.alpentransitboerse.ch", "", "", "", "", "_blank", "", "", ],
            ["||Schweiz","http://www.uvek.admin.ch/themen/umwelt/00640/00642/index.html?lang=de", "", "", "", "", "_blank", "", "", ],
        ["|Zoll","", "", "", "", "", "", "", "", ],
            ["||Schweiz","http://www.ezv.admin.ch/index.html?lang=de", "", "", "", "", "_blank", "", "", ],
            ["||Oesterreich","http://www.bmf.gv.at/zoll/_start.htm", "", "", "", "", "_blank", "", "", ],
            ["||EU","http://ec.europa.eu/taxation_customs/customs/customs_controls/risk_management/customs_eu/index_de.htm", "", "", "", "", "_blank", "", "", ],
            ["||Frankreich","http://www.douane.gouv.fr/menu.asp?id=511", "", "", "", "", "_blank", "", "", ],
            ["||Slovenia","http://e-uprava.gov.si/e-uprava/en/zivljenjskeSituacijeDrevo.euprava?dogodek.id=12485", "", "", "", "", "_blank", "", "", ],
         ["WIR","", "", "", "", "XP Title Tip", "", "", "", ],
        ["|Impressum","menue_call.php?go=impressum_&dir=stat", "", "", "", "", "", "", "", ],
        ["|AGB","menue_call.php?go=agb_&dir=stat", "", "", "", "", "", "", "", ],
        ["|Wer sind Wir","http://www.a-t-c.ch/stat/LEBENSLAUF_GERT_DORN.doc", "", "", "", "", "", "", "", ],
 ];';
}

?>
dtree_init();
