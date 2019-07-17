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

    ["YOUR COMPANY","", "", "", "Alle Daten zu Ihrer Firma", "", "0", "0", "", ],
        ["|profile","menue_call.php?$GLOBALS['GO']=tcontacts_data.inc&$GLOBALS['FUNC']=user_profile&$GLOBALS['DIR']=includes", "", "", "Bearbeiten Sie Ihre Kontaktdaten", "", "", "", "", ],
        ["|password","menue_call.php?$GLOBALS['GO']=tcontacts_data.inc&$GLOBALS['FUNC']=user_password&$GLOBALS['DIR']=includes", "", "", "Neues Passwot eingeben", "", "", "", "", ],
        ["|vehicle","", "", "menue/atc_main.files/Bearbeiten Sie die Fahrzeuge Ihrer Firma", "", "", "", "", "", ],
            ["||Insert","menue_call.php?$GLOBALS['GO']=tkfz_data.inc&$GLOBALS['FUNC']=kfz_reg&$GLOBALS['DIR']=includes", "", "", "Neues Fahrzeug erfassen ?", "", "", "", "", ],
            ["||Change","menue_call.php?$GLOBALS['GO']=tkfz_data.inc&$GLOBALS['FUNC']=kfz_list&$GLOBALS['DIR']=includes", "", "", "Daten eines erfassten Fahrzeugs Ã¤ndern ?", "", "", "", "", ],
        ["|drivers","", "", "Bearbeiten Sie die Fahrer Ihrer Firma", "", "", "", "", "", ],
            ["||insert","menue_call.php?$GLOBALS['GO']=tpartner_data.inc&$GLOBALS['FUNC']=part_new&$GLOBALS['DIR']=includes", "", "", "Neuen Fahrer erfassen ?", "", "", "", "", ],
            ["||change","menue_call.php?$GLOBALS['GO']=tpartner_data.inc&$GLOBALS['FUNC']=part_list&$GLOBALS['DIR']=includes", "", "", "Daten eines erfassten Fahrers Ã¤ndern ?", "", "", "", "", ],
        ["|offer a tour","", "", "", "", "", "", "", "", ],
            ["||cargo offer","menue_call.php?$GLOBALS['GO']=ttourlad_data.inc&$GLOBALS['FUNC']=tourlad_reg&$GLOBALS['DIR']=includes", "", "", "Fracht angebot anpassen ?", "", "", "", "", ],
            ["||change cargo offer","menue_call.php?$GLOBALS['GO']=ttourlad_data.inc&$GLOBALS['FUNC']=tourlad_list&$GLOBALS['DIR']=includes", "", "", "Neuen Fahrer erfassen ?", "", "", "", "", ],
            ["||vehicle offer","menue_call.php?$GLOBALS['GO']=ttourkfz_data.inc&$GLOBALS['FUNC']=tourkfz_reg&$GLOBALS['DIR']=includes", "", "", "Fahrzeug fÃ¼r Tour anbieten ?", "", "", "", "", ],
            ["||change vehicle offer","menue_call.php?$GLOBALS['GO']=ttourkfz_data.inc&$GLOBALS['FUNC']=tourkfz_list&$GLOBALS['DIR']=includes", "", "", "Fahrzeug angebot anpassen ?", "", "", "", "", ],
        ["|your requests","", "", "", "", "", "", "", "", ],
            ["||to cargo","menue_call.php?$GLOBALS['GO']=profil&$GLOBALS['DIR']=dyn", "", "", "", "", "", "", "", ],
            ["||to a vehicle","menue_call.php?$GLOBALS['GO']=profil&$GLOBALS['DIR']=dyn", "", "", "", "", "", "", "", ],
        ["|transit reservations","menue_call.php?$GLOBALS['GO']=profil&$GLOBALS['DIR']=dyn", "", "", "", "", "", "", "", ],
        ["|account","menue_call.php?$GLOBALS['GO']=profil&$GLOBALS['DIR']=dyn", "", "", "", "", "", "", "", ],
        ["|third party offers","menue_call.php?$GLOBALS['GO']=profil&$GLOBALS['DIR']=dyn", "", "", "", "", "", "", "", ],
    ["TRANSIT","", "", "", "", "", "0", "", "", ],
        ["|book","menue_call.php?$GLOBALS['GO']=trans_reser&$GLOBALS['DIR']=dyn", "", "", "", "", "", "", "", ],
        ["|payment of duty","menue_call.php?$GLOBALS['GO']=profil&$GLOBALS['DIR']=stat", "", "", "", "", "", "", "", ],
        ["|officail request","menue_call.php?$GLOBALS['GO']=profil&$GLOBALS['DIR']=dyn", "", "", "", "_parent", "", "", "", ],
    ["ROAD","", "", "", "", "", "0", "", "", ],
        ["|vehicles","menue_call.php?$GLOBALS['GO']=toursuchen_data.inc&$GLOBALS['FUNC']=such_list&value=kfz&$GLOBALS['DIR']=includes", "", "", "", "", "", "", "", ],
        ["|cargo","menue_call.php?$GLOBALS['GO']=toursuchen_data.inc&$GLOBALS['FUNC']=such_list&value=lad&$GLOBALS['DIR']=includes", "", "", "", "", "", "", "", ],
        ["|allowance for removal","menue_call.php?$GLOBALS['GO']=toursuchen_data.inc&$GLOBALS['FUNC']=such_list&value=umz&$GLOBALS['DIR']=includes", "", "", "", "", "", "", "", ],
    ["RAILWAY","", "", "", "", "", "0", "", "", ],
        ["|load cargo","", "", "", "", "_parent", "", "", "", ],
            ["||RAILION Logistics","http://www.railion.com/site/railion/en/start.html", "", "", "", "_blank", "", "", "", ],
            ["||SBB Cargo","https://cis3.sbbcargo.ch/ciso/start.do?lang=en", "", "", "", "_blank", "", "", "", ],
            ["||RAIL CARGO AUSTRIA","http://www.railcargo.at/en/index.jsp", "", "", "", "_blank", "", "", "", ],
            ["||SLOVENSKE Cargo","http://www.sz-tovornipromet.si/en/", "", "", "", "_blank", "", "", "", ],
      ["||CHINA(Peking)","menue_call.php?$GLOBALS['GO']=china&$GLOBALS['DIR']=dyn", "", "", "", "_blank", "", "", "", ],
        ["|trailer shipment","", "", "", "", "", "", "", "", ],
            ["||motorail trains","http://www.autoreisezuege-in-europa.de/", "", "", "", "_blank", "", "", "", ],
            ["||DB","http://www.dbautozug.de/site/dbautozug/en/start.html", "", "", "", "_blank", "", "", "", ],
            ["||SBB","http://mct.sbb.ch/mct/en/reiselust/europareisen/zuege-international-2/autoreisezug.htm", "", "", " ", "_blank", "", "", "", ],
       		["|deal handling","menue_call.php?$GLOBALS['GO']=auftrag.php&$GLOBALS['DIR']=dyn", "", "", "", "_parent", "", "", "", ],
    ["SPONSORS","", "", "", "", "", "0", "", "", ],
        ["|info","menue_call.php?$GLOBALS['GO']=sponsor_info_&$GLOBALS['DIR']=stat", "", "", "", "", "", "", "", ],
        ["|to subscribe money","menue_call.php?$GLOBALS['GO']=spenden_&$GLOBALS['DIR']=stat", "", "", "", "_parent", "", "", "", ],
];
dm_init();