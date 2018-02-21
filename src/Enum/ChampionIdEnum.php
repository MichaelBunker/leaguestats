<?php

namespace App\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class ChampionIdEnum.
 */
class ChampionIdEnum extends AbstractEnumeration
{
	/**
	 * Map id to champion name.
	 *
	 * @param integer $id
	 *
	 * @return string
	 */
	public static function getChampionName($id)
	{
		$enum      = new \ReflectionClass(__CLASS__);
		$champions = $enum->getConstants();

		return array_search($id, $champions);
	}

	const AATROX       = 266;
	const AHRI         = 103;
	const AKALI        = 84;
	const ALISTAR      = 12;
	const AMUMU        = 32;
	const ANIVIA       = 34;
	const ANNIE        = 1;
	const ASHE         = 22;
	const AURELION_SOL = 136;
	const AZIR         = 268;
	const BARD         = 432;
	const BLITZCRANK   = 53;
	const BRAND        = 63;
	const BRAUM        = 201;
	const CAITLYN      = 51;
	const CAMILLE      = 164;
	const CASSIOPEIA   = 69;
	const CHO_GATH     = 31;
	const CORKI        = 42;
	const DARIUS       = 122;
	const DIANA        = 131;
	const DRAVEN       = 119;
	const DR_MUNDO     = 36;
	const EKKO         = 245;
	const ELISE        = 60;
	const EVELYNN      = 28;
	const EZREAL       = 81;
	const FIDDLESTICKS = 9;
	const FIORA        = 114;
	const FIZZ         = 105;
	const GALIO        = 3;
	const GANGPLANK    = 41;
	const GAREN        = 86;
	const GNAR         = 150;
	const GRAGAS       = 79;
	const GRAVES       = 104;
	const HECARIM      = 120;
	const HEIMERDINGER = 74;
	const ILLAOI       = 420;
	const IRELIA       = 39;
	const IVERN        = 427;
	const JANNA        = 40;
	const JARVAN_IV    = 59;
	const JAX          = 24;
	const JAYCE        = 126;
	const JHIN         = 202;
	const JINX         = 222;
	const KALISTA      = 429;
	const KARMA        = 43;
	const KARTHUS      = 30;
	const KASSADIN     = 38;
	const KATARINA     = 55;
	const KAYLE        = 10;
	const KAYN         = 141;
	const KENNEN       = 85;
	const KHAZIX       = 121;
	const KINDRED      = 203;
	const KLED         = 240;
	const KOG_MAW      = 96;
	const LEBLANC      = 7;
	const LEE_SIN      = 64;
	const LEONA        = 89;
	const LISSANDRA    = 127;
	const LUCIAN       = 236;
	const LULU         = 117;
	const LUX          = 99;
	const MALPHITE     = 54;
	const MALZAHAR     = 90;
	const MAOKAI       = 57;
	const MASTER_YI    = 11;
	const MISS_FORTUNE = 21;
	const WUKONG       = 62;
	const MORDEKAISER  = 82;
	const MORGANA      = 25;
	const NAMI         = 267;
	const NASUS        = 75;
	const NAUTILUS     = 111;
	const NIDALEE      = 76;
	const NOCTURNE     = 56;
	const NUNU         = 20;
	const OLAF         = 2;
	const ORIANNA      = 61;
	const ORNN         = 516;
	const PANTHEON     = 80;
	const POPPY        = 78;
	const QUINN        = 133;
	const RAKAN        = 497;
	const RAMMUS       = 33;
	const REK_SAI      = 421;
	const RENEKTON     = 58;
	const RENGAR       = 107;
	const RIVEN        = 92;
	const RUMBLE       = 68;
	const RYZE         = 13;
	const SEJUANI      = 113;
	const SHACO        = 35;
	const SHEN         = 98;
	const SHYVANA      = 102;
	const SINGED       = 27;
	const SION         = 14;
	const SIVIR        = 15;
	const SKARNER      = 72;
	const SONA         = 37;
	const SORAKA       = 16;
	const SWAIN        = 50;
	const SYNDRA       = 134;
	const TAHM_KENCH   = 223;
	const TALIYAH      = 163;
	const TALON        = 91;
	const TARIC        = 44;
	const TEEMO        = 17;
	const THRESH       = 412;
	const TRISTANA     = 18;
	const TRUNDLE      = 48;
	const TRYNDAMERE   = 23;
	const TWISTED_FATE = 4;
	const TWITCH       = 29;
	const UDYR         = 77;
	const URGOT        = 6;
	const VARUS        = 110;
	const VAYNE        = 67;
	const VEIGAR       = 45;
	const VEL_KOZ      = 161;
	const VI           = 254;
	const VIKTOR       = 112;
	const VLADIMIR     = 8;
	const VOLIBEAR     = 106;
	const WARWICK      = 19;
	const XAYAH        = 498;
	const ZERATH       = 101;
	const XIN_ZHAO     = 5;
	const YASUO        = 157;
	const YORICK       = 83;
	const ZAC          = 154;
	const ZED          = 238;
	const ZIGGS        = 115;
	const ZILEAN       = 26;
	const ZOE          = 142;
	const ZYRA         = 143;
}
