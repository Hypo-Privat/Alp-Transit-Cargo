var menuItems = [

    ["SU EMPRESA","", "", "", "", "", "0", "0", "", ],
        ["|El Perfil","menue_call.php?go=tcontacts_data.inc&func=user_profile&dir=includes", "", "", "Bearbeiten Sie Ihre Kontaktdaten", "", "", "", "", ],
        ["|El Password","menue_call.php?go=tcontacts_data.inc&func=user_password&dir=includes", "", "", "Neues Passwot eingeben", "", "", "", "", ],
        ["|La Vehicular","", "", "", "", "", "", "", "", ],
            ["||inspirar","menue_call.php?go=tkfz_data.inc&func=kfz_reg&dir=includes", "", "", "Neues Fahrzeug erfassen ?", "", "", "", "", ],
            ["||editar","menue_call.php?go=tkfz_data.inc&func=kfz_list&dir=includes", "", "", "Daten eines erfassten Fahrzeugs Ã¤ndern ?", "", "", "", "", ],
        ["|El Conductor ","", "", "", "", "", "", "", "", ],
            ["||inspirar","menue_call.php?go=tpartner_data.inc&func=part_new&dir=includes", "", "", "Neuen Fahrer erfassen ?", "", "", "", "", ],
            ["||editar","menue_call.php?go=tpartner_data.inc&func=part_list&dir=includes", "", "", "Daten eines erfassten Fahrers Ã¤ndern ?", "", "", "", "", ],
        ["|La Tour","", "", "", "", "", "", "", "", ],
            ["||Oferta del la carga ","menue_call.php?go=ttourkfz_data.inc&func=tourkfz_reg&dir=includes", "", "", "Fracht angebot anpassen ?", "", "", "", "", ],
            ["||Trabajo del la carga encendido","menue_call.php?go=ttourkfz_data.inc&func=tourkfz_list&dir=includes", "", "", "Neuen Fahrer erfassen ?", "", "", "", "", ],
            ["||Oferta del el veh�culo","menue_call.php?go=ttourlad_data.inc&func=tourlad_reg&dir=includes", "", "", "Fahrzeug fÃ¼r Tour anbieten ?", "", "", "", "", ],
            ["||Trabajo del el veh�culo encendido","menue_call.php?go=ttourlad_data.inc&func=tourlad_list&dir=includes", "", "", "Fahrzeug angebot anpassen ?", "", "", "", "", ],
        ["||Oferta del retiro","menue_call.php?go=tumz_data.inc&func=umz_reg&dir=includes", "", "", "Umzug Tour anbieten ?", "", "", "", "", ],
            ["||Trabajo del retiro encendido","menue_call.php?go=tumz_data.inc&func=umz_list&dir=includes", "", "", "Umzug Angebot anpassen ?", "", "", "", "", ],
          ["|La Cuenta","menue_call.php?go=profil&dir=dyn", "", "", "", "", "", "", "", ],
    ["DE OFRECIMIENTO","", "", "", "", "", "0", "", "", ],
        ["|veh�culo","menue_call.php?go=toursuchen_data.inc&func=such_list&value=kfz&dir=includes", "", "", "", "", "", "", "", ],
        ["|carga","menue_call.php?go=toursuchen_data.inc&func=such_list&value=lad&dir=includes", "", "", "", "", "", "", "", ],
        ["|mudanza","menue_call.php?go=toursuchen_data.inc&func=such_list&value=umz&dir=includes", "", "", "", "", "", "", "", ],
    ["EL RAIL","", "", "", "", "", "0", "", "", ],
        ["|los biennes la embarque","", "", "", "", "_parent", "", "", "", ],
            ["||DB Carga","http://www.railion.com/site/railion/en/start.html", "", "", "", "_blank", "", "", "", ],
            ["||SBB Carga","https://cis3.sbbcargo.ch/ciso/start.do?lang=en", "", "", "", "_blank", "", "", "", ],
            ["||Austria Carga","http://www.railcargo.at", "", "", "", "_blank", "", "", "", ],
            ["||SLOVENSKE Carga","http://www.sz-tovornipromet.si/en/", "", "", "", "_blank", "", "", "", ],
       ["||CHINA(Peking)","menue_call.php?go=china&dir=dyn", "", "", "", "_blank", "", "", "", ],
       ["|Los trenes a cuestas","", "", "", "", "", "", "", "", ],
            ["||el autotr�n","http://www.autoreisezuege-in-europa.de/", "", "", "", "_blank", "", "", "", ],
            ["||DB","http://www.dbautozug.de/site/dbautozug/de/start.html", "", "", "", "_blank", "", "", "", ],
            ["||SBB","http://mct.sbb.ch/mct/reiselust/europareisen/autoreisezug.htm", "", "", " ", "_blank", "", "", "", ],
    ["EL TR�NSITO","", "", "", "", "", "0", "", "", ],
        ["|Reservar","menue_call.php?go=trans_reser&dir=dyn", "", "", "", "", "", "", "", ],
        ["|Aforo y pago de aduana","menue_call.php?go=profil&dir=dyn", "", "", "", "", "", "", "", ],
        ["|Hacer una proposici�n","menue_call.php?go=profil&dir=dyn", "", "", "", "_parent", "", "", "", ],
      ["EL SPONSOR","", "", "", "", "", "0", "", "", ],
        ["|la informaci�n","menue_call.php?go=sponsor_info_&dir=stat", "", "", "", "", "", "", "", ],
        ["|donar","menue_call.php?go=spenden&dir=dyn", "", "", "", "_parent", "", "", "", ],
];