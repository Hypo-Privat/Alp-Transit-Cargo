/*
   Deluxe Menu Data File
   Created by Deluxe Tuner v3.0
   http://deluxe-menu.com
*/

var key="149b662exid";

// -- Deluxe Tuner Style Names
var itemStylesNames=["Top Item",];
var menuStylesNames=["Top Menu",];
// -- End of Deluxe Tuner Style Names

//--- Common
var isHorizontal=1;
var smColumns=1;
var smOrientation=0;
var smViewType=0;
var dmRTL=0;
var pressedItem=-2;
var itemCursor="default";
var itemTarget="_self";
var statusString="link";
var blankImage="menue/atc_main.files/blank.gif";
var pathPrefix_img="";
var pathPrefix_link="";

//--- Dimensions
var menuWidth="700px";
var menuHeight="21px";
var smWidth="";
var smHeight="";

//--- Positioning
var absolutePos=0;
var posX="0px";
var posY="0px";
var topDX=0;
var topDY=1;
var DX=-5;
var DY=0;
var subMenuAlign="left";
var subMenuVAlign="bottom";

//--- Font
var fontStyle="normal 12px Trebuchet MS, Tahoma";
var fontColor=["#000000","#FFFFFF"];
var fontDecoration=["none","none"];
var fontColorDisabled="#AAAAAA";

//--- Appearance
var menuBackColor="#FFFFFF";
var menuBackImage="";
var menuBackRepeat="repeat";
var menuBorderColor="#4A536A";
var menuBorderWidth=2;
var menuBorderStyle="solid";

//--- Item Appearance
var itemBackColor=["#6696bc","#606060"];
var itemBackImage=["",""];
var beforeItemImage=["",""];
var afterItemImage=["",""];
var beforeItemImageW="";
var afterItemImageW="";
var beforeItemImageH="";
var afterItemImageH="";
var itemBorderWidth=1;
var itemBorderColor=["#D1FCCF #D1FCCF #BAE7B8 #D1FCCF","#56CB38"];
var itemBorderStyle=["solid","solid"];
var itemSpacing=0;
var itemPadding="2px 5px 2px 10px";
var itemAlignTop="left";
var itemAlign="left";

//--- Icons
var iconTopWidth=16;
var iconTopHeight=16;
var iconWidth=16;
var iconHeight=16;
var arrowWidth=7;
var arrowHeight=7;
var arrowImageMain=["menue/atc_main.files/arrv_black.gif",""];
var arrowImageSub=["menue/atc_main.files/arr_black.gif","menue/atc_main.files/arr_white.gif"];

//--- Separators
var separatorImage="";
var separatorWidth="100%";
var separatorHeight="3px";
var separatorAlignment="left";
var separatorVImage="";
var separatorVWidth="3px";
var separatorVHeight="100%";
var separatorPadding="0px";

//--- Floatable Menu
var floatable=0;
var floatIterations=6;
var floatableX=1;
var floatableY=1;

//--- Movable Menu
var movable=0;
var moveWidth=12;
var moveHeight=20;
var moveColor="#DECA9A";
var moveImage="";
var moveCursor="move";
var smMovable=0;
var closeBtnW=15;
var closeBtnH=15;
var closeBtn="";

//--- Transitional Effects & Filters
var transparency="90";
var transition=30;
var transOptions="";
var transDuration=350;
var transDuration2=200;
var shadowLen=3;
var shadowColor="#B1B1B1";
var shadowTop=0;

//--- CSS Support (CSS-based Menu)
var cssStyle=0;
var cssSubmenu="";
var cssItem=["",""];
var cssItemText=["",""];

//--- Advanced
var dmObjectsCheck=0;
var saveNavigationPath=1;
var showByClick=0;
var noWrap=1;
var smShowPause=200;
var smHidePause=1000;
var smSmartScroll=1;
var topSmartScroll=0;
var smHideOnClick=1;
var dm_writeAll=1;
var useIFRAME=0;
var dmSearch=1;

//--- AJAX-like Technology
var dmAJAX=0;
var dmAJAXCount=0;
var ajaxReload=0;

//--- Dynamic Menu
var dynamic=1;

//--- Keystrokes Support
var keystrokes=0;
var dm_focus=1;
var dm_actKey=113;

//--- Sound
var onOverSnd="";
var onClickSnd="";

var itemStyles = [
    ["itemWidth=92px","itemHeight=21px","itemBackColor=transparent,transparent","itemBorderWidth=0","fontStyle=normal 11px Tahoma","fontColor=#1A3953,#000000","itemBackImage=menue/atc_main.files/btn3_white.gif,menue/atc_main.files/btn3_white.gif"],
];
var menuStyles = [
    ["menuBackColor=transparent","menuBorderWidth=0","itemSpacing=1","itemPadding=0px 5px 0px 5px"],
];

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
            ["||Fahrzeug anbieten","menue_call.php?go=ttourkfz_data.inc&func=tourkfz_reg&dir=includes", "", "", "Fahrzeug fÃ¼r Tour anbieten ?", "", "", "", "", ],
            ["||Fahrzeug bearbeiten","menue_call.php?go=ttourkfz_data.inc&func=tourkfz_list&dir=includes", "", "", "Fahrzeug angebot anpassen ?", "", "", "", "", ],
            ["||Fracht anbieten","menue_call.php?go=ttourlad_data.inc&func=tourlad_reg&dir=includes", "", "", "Fracht angebot anpassen ?", "", "", "", "", ],
            ["||Fracht bearbeiten","menue_call.php?go=ttourlad_data.inc&func=tourlad_list&dir=includes", "", "", "Neuen Fahrer erfassen ?", "", "", "", "", ],
            ["||Umzug anbieten","menue_call.php?go=tumz_data.inc&func=umz_reg&dir=includes", "", "", "Umzug Tour anbieten ?", "", "", "", "", ],
            ["||Umzug bearbeiten","menue_call.php?go=tumz_data.inc&func=umz_list&dir=includes", "", "", "Umzug Angebot anpassen ?", "", "", "", "", ],
         ["|Konto","menue_call.php?go=profil&dir=dyn", "", "", "", "", "", "", "", ],
    ["TRANSIT","", "", "", "", "", "0", "", "", ],
        ["|Reservieren","menue_call.php?go=trans_reser&dir=dyn", "", "", "", "", "", "", "", ],
        ["|Verzollung","menue_call.php?go=profil&dir=dyn", "", "", "", "", "", "", "", ],
        ["|Antr�ge","menue_call.php?go=profil&dir=dyn", "", "", "", "_parent", "", "", "", ],
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
    ["SPONSOREN","", "", "", "", "", "0", "", "", ],
        ["|Info","menue_call.php?go=sponsor_info_&dir=stat", "", "", "", "", "", "", "", ],
        ["|Spenden","menue_call.php?go=spenden&dir=dyn", "", "", "", "_parent", "", "", "", ],
];
dm_init();