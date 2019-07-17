/*
   Deluxe Menu Data File
   Created by Deluxe Tuner v3.0
   http://deluxe-menu.com
*/

var key="149b662exid";

// -- Deluxe Tuner Style Names
var tstylesNames=["Individual Style",];
var tXPStylesNames=[];
// -- End of Deluxe Tuner Style Names

//--- Common
var tlevelDX=20;
var texpanded=1;
var texpandItemClick=1;
var tcloseExpanded=0;
var tcloseExpandedXP=0;
var ttoggleMode=1;
var tnoWrap=1;
var titemTarget="_self";
var titemCursor="default";
var statusString="link";
var tblankImage="menue/atc_left.files/blank.gif";
var tpathPrefix_img="";
var tpathPrefix_link="";

//--- Dimensions
var tmenuWidth="200px";
var tmenuHeight="auto";

//--- Positioning
var tabsolute=0;
var tleft="";
var ttop="";

//--- Font
var tfontStyle="normal 12px Trebuchet MS, Tahoma";
var tfontColor=["#000000","#FFFFFF"];
var tfontDecoration=["none","underline"];
var tfontColorDisabled="#AAAAAA";
var tpressedFontColor="#ACACAC";

//--- Appearance
var tmenuBackColor="#FFFFFF";
var tmenuBackImage="menue/atc_left.files/back.gif";
var tmenuBorderColor="#4A536A";
var tmenuBorderWidth=2;
var tmenuBorderStyle="solid";

//--- Item Appearance
var titemAlign="left";
var titemHeight=26;
var titemBackColor=["#6696bc","#606060"];
var titemBackImage=["menue/atc_left.files/blank.gif","menue/atc_left.files/blank.gif"];

//--- Icons & Buttons
var ticonWidth=10;
var ticonHeight=10;
var ticonAlign="left";
var texpandBtn=["menue/atc_left.files/expandbtn2.gif","menue/atc_left.files/expandbtn2.gif","menue/atc_left.files/collapsebtn2.gif"];
var texpandBtnW=10;
var texpandBtnH=10;
var texpandBtnAlign="left";

//--- Lines
var tpoints=1;
var tpointsImage="menue/atc_left.files/vpoint.gif";
var tpointsVImage="menue/atc_left.files/hpoint.gif";
var tpointsCImage="menue/atc_left.files/cpoint.gif";

//--- Floatable Menu
var tfloatable=1;
var tfloatIterations=10;
var tfloatableX=1;
var tfloatableY=1;

//--- Movable Menu
var tmoveable=0;
var tmoveHeight=12;
var tmoveColor="#DECA9A";
var tmoveImage="";

//--- XP-Style
var tXPStyle=0;
var tXPIterations=10;
var tXPBorderWidth=1;
var tXPBorderColor="#FFFFFF";
var tXPTitleBackColor="#AFB1C3";
var tXPTitleBackImg="menue/atc_left.files/xptitle_s.gif";
var tXPTitleLeft="menue/atc_left.files/xptitleleft_s.gif";
var tXPTitleLeftWidth=4;
var tXPIconWidth=31;
var tXPIconHeight=32;
var tXPExpandBtn=["menue/atc_left.files/xpexpand1_s.gif","menue/atc_left.files/xpexpand1_s.gif","menue/atc_left.files/xpcollapse1_s.gif","menue/atc_left.files/xpcollapse1_s.gif"];
var tXPBtnWidth=25;
var tXPBtnHeight=23;
var tXPFilter=1;

//--- Dynamic Menu
var tdynamic=1;

//--- State Saving
var tsaveState=0;
var tsavePrefix="menu1";

var tstyles = [
    ["tfontDecoration=none,none"],
];

var tmenuItems = [
    ["Registrieren","menue_call.php?go=tcontacts_data.inc&func=user_reg&dir=includes", "", "", "", "Als neuer User registrieren", "", "", "", ],
    ["Support - Hilfe","menue_call.php?go=support&dir=dyn", "", "", "", "", "", "", "", ],
    ["Presse","menue_call.php?go=presse&dir=dyn", "", "", "", "", "", "", "", ],
   ["Sitemap","menue_call.php?go=atc_sitemap_&dir=stat", "", "", "", "", "", "", "", ],
   ["NEU ANBIETEN","", "", "", "", "", "", "", "", ],
            ["||Fahrzeug","menue_call.php?go=ttourkfz_data.inc&func=tourkfz_reg&dir=includes", "", "", "Fahrzeug fÃ¼r Tour anbieten ?", "", "", "", "", ],
            ["||Fracht","menue_call.php?go=ttourlad_data.inc&func=tourlad_reg&dir=includes", "", "", "Fracht angebot anpassen ?", "", "", "", "", ],
            ["||Umzug","menue_call.php?go=tumz_data.inc&func=umz_reg&dir=includes", "", "", "Umzug Tour anbieten ?", "", "", "", "", ],
    ["INFOS","", "", "", "", "", "", "", "", ],
           ["|Zoll","", "", "", "", "", "", "", "", ],
            ["||Schweiz","http://www.ezv.admin.ch/index.html?lang=de", "", "", "", "", "_blank", "", "", ],
            ["||Oesterreich","http://www.bmf.gv.at/zoll/_start.htm", "", "", "", "", "_blank", "", "", ],
            ["||EU","http://ec.europa.eu/taxation_customs/customs/customs_controls/risk_management/customs_eu/index_de.htm", "", "", "", "", "_blank", "", "", ],
            ["||Frankreich","http://www.douane.gouv.fr/menu.asp?id=511", "", "", "", "", "_blank", "", "", ],
            ["||Slovenia","http://e-uprava.gov.si/e-uprava/en/zivljenjskeSituacijeDrevo.euprava?dogodek.id=12485", "", "", "", "", "_blank", "", "", ],
         ["WIR","", "", "", "", "XP Title Tip", "", "", "", ],
        ["|Impressum","menue_call.php?go=impressum&dir=dyn", "", "", "", "", "", "", "", ],
        ["|AGB","menue_call.php?go=agb_&dir=stat", "", "", "", "", "", "", "", ],
 ];

dtree_init();
