<?php

declare(strict_types=1);

namespace ThomasNetScraper;

enum Area: string
{
    // All regions
    case All = 'NA';

    // Texas
    case TexasNorth = 'NT';
    case TexasSouth = 'GT';

    // California
    case CaliforniaNorth = 'CN';
    case CaliforniaSouth = 'CS';

    // New York
    case NewYorkMetro = 'DN';
    case NewYorkUpstate = 'UN';

    // Major states
    case Illinois = 'IL';
    case Michigan = 'MI';

    // Ohio
    case OhioNorth = 'NO';
    case OhioSouth = 'SO';

    // Pennsylvania
    case PennsylvaniaEast = 'EP';
    case PennsylvaniaWest = 'WP';

    // Canada
    case Ontario = 'ON';
    case Quebec = 'QC';

    // Additional US states
    case Alabama = 'AL';
    case Alaska = 'AK';
    case Arizona = 'AZ';
    case Arkansas = 'AR';
    case Colorado = 'CO';
    case Connecticut = 'CT';
    case Delaware = 'DE';
    case DistrictOfColumbia = 'DC';
    case Florida = 'FL';
    case Georgia = 'GA';
    case Hawaii = 'HI';
    case Idaho = 'ID';
    case Indiana = 'IN';
    case Iowa = 'IA';
    case Kansas = 'KS';
    case Kentucky = 'KY';
    case Louisiana = 'LA';
    case Maine = 'ME';
    case Maryland = 'MD';
    case Massachusetts = 'MA';
    case Minnesota = 'MN';
    case Mississippi = 'MS';
    case Missouri = 'MO';
    case Montana = 'MT';
    case Nebraska = 'NE';
    case Nevada = 'NV';
    case NewHampshire = 'NH';
    case NewJersey = 'NJ';
    case NewMexico = 'NM';
    case NorthCarolina = 'NC';
    case NorthDakota = 'ND';
    case Oklahoma = 'OK';
    case Oregon = 'OR';
    case RhodeIsland = 'RI';
    case SouthCarolina = 'SC';
    case SouthDakota = 'SD';
    case Tennessee = 'TN';
    case Utah = 'UT';
    case Vermont = 'VT';
    case Virginia = 'VA';
    case Washington = 'WA';
    case WestVirginia = 'WV';
    case Wisconsin = 'WI';
    case Wyoming = 'WY';

    // Additional Canadian provinces
    case Alberta = 'AB';
    case BritishColumbia = 'BC';
    case Manitoba = 'MB';
    case NewBrunswick = 'NB';
    case NewfoundlandAndLabrador = 'NL';
    case NovaScotia = 'NS';
    case PrinceEdwardIsland = 'PE';
    case Saskatchewan = 'SK';
}
