var menuItems = [

    ["IHRE FIRMA","", "", "", "", "", "0", "0", "", ],
        ["|Profil","menue_call.php?go=tcontacts_data.inc&func=user_profile&dir=includes", "", "", "Bearbeiten Sie Ihre Kontaktdaten", "", "", "", "", ],
        ["|Passwort","menue_call.php?go=tcontacts_data.inc&func=user_password&dir=includes", "", "", "Neues Passwot eingeben", "", "", "", "", ],
        ["|Fahrzeuge","", "", "", "", "", "", "", "", ],
            ["||Neu Eingeben","menue_call.php?go=tkfz_data.inc&func=kfz_reg&dir=includes", "", "", "Neues Fahrzeug erfassen ?", "", "", "", "", ],
            ["||Bearbeiten","menue_call.php?go=tkfz_data.inc&func=kfz_list&dir=includes", "", "", "Daten eines erfassten Fahrzeugs Ã¤ndern ?", "", "", "", "", ],
        ["|Fahrer","", "", "", "", "", "", "", "", ],
            ["||Neu Eingeben","menue_call.php?go=tpartner_data.inc&func=part_new&dir=includes", "", "", "Neuen Fahrer erfassen ?", "", "", "", "", ],
            ["||Bearbeiten","menue_call.php?go=tpartner_data.inc&func=part_list&dir=includes", "", "", "Daten eines erfassten Fahrers Ã¤ndern ?", "", "", "", "", ],
        ["|Touren","", "", "", "", "", "", "", "", ],
            ["||Fahrzeug anbieten","menue_call.php?go=ttourkfz_data.inc&func=tourkfz_reg&dir=includes", "", "", "Fahrzeug f�r Tour anbieten ?", "", "", "", "", ],
            ["||Fahrzeug bearbeiten","menue_call.php?go=ttourkfz_data.inc&func=tourkfz_list&dir=includes", "", "", "Fahrzeug angebot anpassen ?", "", "", "", "", ],
            ["||Fracht anbieten","menue_call.php?go=ttourlad_data.inc&func=tourlad_reg&dir=includes", "", "", "Fracht angebot anpassen ?", "", "", "", "", ],
            ["||Fracht bearbeiten","menue_call.php?go=ttourlad_data.inc&func=tourlad_list&dir=includes", "", "", "Neuen Fahrer erfassen ?", "", "", "", "", ],
            ["||Umzug anbieten","menue_call.php?go=tumz_data.inc&func=umz_reg&dir=includes", "", "", "Umzug Tour anbieten ?", "", "", "", "", ],
            ["||Umzug bearbeiten","menue_call.php?go=tumz_data.inc&func=umz_list&dir=includes", "", "", "Umzug Angebot anpassen ?", "", "", "", "", ],
         ["|Konto","menue_call.php?go=profil&dir=dyn", "", "", "", "", "", "", "", ],
    ["SUCHEN","", "", "", "", "", "0", "", "", ],
        ["|Fahrzeuge","menue_call.php?go=toursuchen_data.inc&func=such_list&value=kfz&dir=includes", "", "", "", "", "", "", "", ],
        ["|Ladung","menue_call.php?go=toursuchen_data.inc&func=such_list&value=lad&dir=includes", "", "", "", "", "", "", "", ],
        ["|Umzug","menue_call.php?go=toursuchen_data.inc&func=such_list&value=umz&dir=includes", "", "", "", "", "", "", "", ],
    ["SCHIENE","", "", "", "", "", "0", "", "", ],
        ["|Verladen Gueter","", "", "", "", "_parent", "", "", "", ],
            ["||DB Cargo","http://gueterfahrplan.hacon.de/cgi-bin/query.exe", "", "", "", "_blank", "", "", "", ],
            ["||SBB Cargo","https://cis3.sbbcargo.ch/ciso/start.do?lang=de", "", "", "", "_blank", "", "", "", ],
            ["||Austria Cargo","http://www.railcargo.at", "", "", "", "_blank", "", "", "", ],
            ["||SLOVENSKE Cargo","http://www.sz-tovornipromet.si/en/", "", "", "", "_blank", "", "", "", ],
         ["||CHINA(Peking)","menue_call.php?go=china&dir=dyn", "", "", "", "_blank", "", "", "", ],
     ["|Huckepack Zuege","", "", "", "", "", "", "", "", ],
            ["||Autoreisezuege","http://www.autoreisezuege-in-europa.de/", "", "", "", "_blank", "", "", "", ],
            ["||DB","http://www.dbautozug.de/site/dbautozug/de/start.html", "", "", "", "_blank", "", "", "", ],
            ["||SBB","http://mct.sbb.ch/mct/reiselust/europareisen/autoreisezug.htm", "", "", " ", "_blank", "", "", "", ],
        ["|Abwicklung ueber uns","menue_call.php?go=profil&dir=dyn", "", "", "", "_parent", "", "", "", ],
    ["TRANSIT","", "", "", "", "", "0", "", "", ],
        ["|Reservieren","menue_call.php?go=trans_reser&dir=dyn", "", "", "", "", "", "", "", ],
        ["|Verzollung","menue_call.php?go=profil&dir=dyn", "", "", "", "", "", "", "", ],
        ["|Antr�ge","menue_call.php?go=profil&dir=dyn", "", "", "", "_parent", "", "", "", ],
    ["SPONSOREN","", "", "", "", "", "0", "", "", ],
        ["|Info","menue_call.php?go=sponsor_info_&dir=stat", "", "", "", "", "", "", "", ],
        ["|Spenden","menue_call.php?go=spenden&dir=dyn", "", "", "", "_parent", "", "", "", ],
];