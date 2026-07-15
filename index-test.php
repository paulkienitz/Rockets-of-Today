<?php
/*  TODO:   -- logic:
******************  GOVT EXCLUSIVE FILTER IS BUSTED, it is including commercialized government.
**BUG**  Tabbing to overview did not update "current filter" list to reflect filter change.
(already saw)  Filter list on section intro pages sometimes initiates out of sync with the current filters?  Can't reproduce.
Add formerly-popular filter category?  Maybe someday.  Or decommission the whole filter feature?
Reorganize .css file, and merge in local inline styles.  Remove .gov class?
BUG: Firefox sometimes doesn't load images after simulateNavigation -- XHR handled cache incorrectly.
...See if spare 5 mitigates that bug (it probably should have no effect... but I haven't seen the bug in some time):

**********************
ARTICLES PRESENT in Sep 2021 (earliest definite record we have):
    Alpha Angara/Amur Antares Ariane Astra Atlas Bloostar Blue-Whale [cargo]
    [china-solids] Delta Dragon-2 Dream-Chaser Electron Epsilon Falcon
    Gaganyaan GSLV/PSLV(incl LVM) H Haas Hapith ISS KSLV LauncherOne
    Long-March LOP-G Mengzhou Minotaur Miura Nebula Neptune New-Glenn New-Line
    Omega Orel Orion Pegasus Phantom-Express Prime Proton Rokot RS1 Shavit
    Shenzhou Skylon SLS Soyuz Soyuz(spacecraft) SSLV Starliner Starship
    Starship(spacecraft) Terran Tiangong-Space-Station Unha Vega Vector Vulcan
    Zenit

Have dated all of the following to 2017... this may or may not be valid, but I’m going with it... let’s say July just because it’s in the middle:
    Alpha✔ Angara✔ Antares✔ Ariane✔ Atlas✔ Bloostar✔ [cargo]✔ [china-solids]✔
    Delta✔ Electron✔ Epsilon✔ Falcon✔ GSLV/PSLV(incl LVM)✔ H✔ Haas✔
    LauncherOne✔ Long-March✔✔ Minotaur✔ Neptune✔ New-Glenn✔ Pegasus✔
    Phantom-Express✔ Prime✔ Proton✔ Rokot✔ RS1✔ Skylon✔ Soyuz✔ Starship✔
    Vega✔ Vector✔ Vulcan✔ Zenit✔

NOW, come up with some idea as for which rockets were added when in 2018-21.  Here are my best guesses:
    Astra (nov 18)✔ Blue-Whale (oct 19)✔ Hapith (feb 20)✔ Miura (jan 18)✔ Nebula (aug 21)✔
    Neutron (mar 21) New-Line (apr 19)✔ Omega (oct 18)✔ SSLV (feb 20)✔ Terran (oct 17)✔
But now I have to try to figure when I added the noncommercialized ones... did any of these predate 2019 or so?  I really can’t remember...
    KSLV (early?)✔ Phantom-Express (late?)✔ Shavit (early/middle?)✔ SLS (late?)✔ Unha (early?)✔
And when did I start adding the spacecraft and space stations?  I’m thinking maybe 2020-ish?
    Soyuz✔ Shenzhou✔ Dragon✔ Starliner✔ Orion✔ Mengzhou (later?)✔ Blue-Moon (much later, see below)✔
    Starship (definitely later)✔ Dream-Chaser✔ Gaganyaan (later?)✔ Orel✔
    ...ISS✔ Tiangong (later?)✔ LOP-G✔ Axiom (much later, see below)✔

That’s the end of the guesswork.  From now on we have at least a rough record available of what was added when, with some firm boundary dates.
The Wayback Machine goes back to Sep 17, 2021... maybe that’s when it was first made really visible to search engines etc, though it was not new.

Added before Dec 1, 2021:  none
Added before Apr 5, 2022:  (mostly a bunch of redundant company names in the index, which we can ignore)
    Aurora/Dawn✔ RFA✔
    (...private stations didn't get their own article until Sep ’23... Axiom was covered a bit in the ISS article but that was very
    thin in 2021, and not much thicker in 2022)
(by Aug 2022:  name change to Rockets of Today, so nocomm stuff might be recent here?  ...nah, I’m confident some of those are much older.)
Added before Dec 4, 2022:  none  (kinetica got a separate article only in 2026, though the index entry appears here for the solid-fuel one)
Added before Mar 29, 2023:
    LandSpace (I think)✔ Spectrum✔ Tianlong✔
Added before Sep 25, 2023:     (aside from new entries in old articles, e.g. Vast and Voyager stations)
    Axiom-etc (I decided previous content within the ISS article was too thin to count)✔
Added before Feb 24, 2024:
    Nova✔
Added before Jul 16, 2024:
    Kairos✔
Added before Oct 14, 2024:  none
Added before Dec 13, 2024:
    Eris✔
Added before Jun 13, 2025:  none           --- earliest Tigertech backup seen is Feb 2, 2025
Added before Aug 17, 2025:
    Blue-Moon✔
Added before Nov 30, 2025
    Skyrora✔ SpinLaunch✔
Added before Feb 11, 2026:                 --- my local version-control repo started on Feb 4, 2026
    Hanbit✔ Kinetica✔ (wait, this is not in the repo on Apr 25! launch was Mar 30)
Added after that:  none
---------------- Dammit I forgot the root pages want publication dates too:
    alphabetic✔ intro✔ legend✔ {upcoming✔} old✔ middle✔ revival✔ boom (12/5/22-3/29/23)✔ cancelled (later?)✔ future✔
    compare✔ spacecraft (later)✔ stations (later)✔ spaceports (3/30/23-9/25/23)✔ timeline (7/13/25-2/11/26)✔ forecasts (later?)✔


            -- content:
Go through old rockets and find the ones with insufficient significant figures, and maybe check some accuracies.
Update Ariane 6 stages, and LM 6A stages when possible.  Add stages for Starship when possible.
Flown rockets with no pics: START, Rokot, Epsilon, some Chinese solids, SSLV, Kairos, Spectrum, Eris, Hanbit.  Let's leave most of them be.
Add Space Epoch's half-scale Starship?  Other new China companies?
Move Qaem and other new Iranian to a separate article from Unha?
Watch out always for rockets well enough defined to get their own new sections.
See compare.html-content for todo on the size picture.
--- The presence of [TEST] in a comment means this line differs from the production version.
*/

$rootM = '/rockets';                // our server-side root folder — no trailing slash
$rootA = '/rockets/index-test.php'; // [TEST] client-side virtual root page — make this the same as $rootM if we are the DirectoryIndex in .htaccess
$rootU = 'https://paulkienitz.net/rockets/';    // the client-side URL that all of our content starts from
$warning = ' [test]';
$commentSystem = 'inline';          // 'inline' for Commentics ('iframe' not implemented), 'hash' for Hashover (lame) [TEST], 'none' for no comments
$cmtx_folder = '/commentix/';
//$hashover_folder = '/hashover--2-next/';      // [TEST]

$log = '';                  // [TEST] in case I need serverside breadcrumbs for debugging

$addIntro = false;
$reqPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $reqPath, 6);
// We can assume up front that part 0 is always "" and part 1 is always "rockets".  We skip these.
// Part 2 may be "index[-test].php"; if so, we skip that as well.   [TEST]
// We will use the next part for an era or a top-level section such as intro.
// When that part is an era (including spacecraft or stations), the final part will be the optional individual article name.
// That last part must be absent or empty if the part before is not an era.  No further parts should exist.

// $log .= "* last path part (length " . count($pathParts) . ") is '" . end($pathParts) . "'... comparing to '" . strtolower(substr($rootA, strlen($rootM) + 1)) . "'";
if (strtolower($pathParts[2]) == 'index.php' || strtolower($pathParts[2]) == strtolower(substr($rootA, strlen($rootM) + 1)))
{
    $mainSection = strtolower($pathParts[3] ?? null);
    $article = strtolower($pathParts[4] ?? null);
    $remainder = $pathParts[5] ?? null;
}
else
{
    $mainSection = strtolower($pathParts[2] ?? null);
    $article = strtolower($pathParts[3] ?? null);
    $remainder = ($pathParts[4] ?? null) . ($pathParts[5] ?? null);
}
if (!$mainSection)
{
    $addIntro = true;
    $mainSection = 'alphabetic-test';       // [TEST] formerly 'intro' -- *** FORCE EXPLICIT REDIRECT to get test links?
}
// $log .= "\n*** mainSection '$mainSection', article '$article', remainder '$remainder'.";

/* We keep the array index here numeric so as to guarantee correct ordering.  Each element consists of
   essentially a tuple, containing a path, a full title, and a shortened title for mobile displays.
   The eight (originally seven) single-letter path components are virtual folders, which originally
   mapped to just two physical ones, r/ and s/, but o, m, r, b, x, and f now map to ro/, rm/, rr/, rb/,
   rx/, and rf/ (but v and h still map to s/).  This gives each article a short clean url. */
$sections = [['alphabetic-test', 'Alphabetical Index',              'Index'],       // [TEST]
             ['intro',      'Introduction',                    'Intro'],
             ['legend',     'Stats and Specs Explained',       'Stats&amp;Specs'],
          /* ['upcoming',   'Upcoming Milestones',             'Upcoming'], */
             ['o',          'The Space Race Era, 1957–1976',   '1957–1976'],
             ['m',          'The Shuttle Era, 1977–2007',      '1977–2007'],
             ['r',          'The Revival, 2008–2016',          '2008–2016'],
             ['b',          'The Boom, 2017–present',          '2017–present'],
             ['x',          'Failed Plans, 2017–present',      'Failed'],
             ['f',          'Not Flown Yet',                   'Not Yet'],
             ['compare',    'Size Comparison',                 'Sizes'],
             ['v',          'Crewed Spacecraft',               'Spacecraft'],
             ['h',          'Space Stations',                  'Stations'],
             ['spaceports', 'Spaceports and Launch Complexes', 'Spaceports'],
             ['timeline',   'Timeline of Commercialization',   'Timeline'],
             ['forecasts',  'My Forecasts',                    'Forecasts']];
$sectionNumber = -1;
foreach ($sections as $index => $sec)
    if ($sec[0] == $mainSection)
    {
        $sectionNumber = $index;
        break;
    }
$show404 = $remainder || $sectionNumber < 0;
$redirection = '';

// Map virtual folders to physical content directories:
$articleFolder = $mainSection == 'v' || $mainSection == 'h' ? 's/' : "r$mainSection/";

/* These tables define which rockets live in which eras, in what order.  Updates happen from time to time.
   The name to the right of each '=>' specifies the name that appears in the tab for selecting it.
   These arrays could be local to eraToUse(), I guess — we only need the one it returns. */
$eraOld       = ['' => 'Overview', 'soyuz' => 'R7/Soyuz', 'atlas' => 'Atlas', 'delta' => 'Delta',
                 'proton' => 'Proton', 'oldlongmarch' => 'Long March (old)'];
$eraMiddle    = ['' => 'Overview', 'ariane' => 'Ariane', 'zenit' => 'Zenit &amp; Soyuz-5', 'h' => 'H',
                 'shavit' => 'Shavit', 'pegasus' => 'Pegasus', 'pslv' => 'PSLV, GSLV', /* 'start' => 'START', */
                 'minotaur' => 'Minotaur', 'rokot' => 'Rokot'];
$eraRevival   = ['' => 'Overview', 'falcon' => 'Falcon', 'unha' => 'Safir, Unha, and successors',
                 'vega' => 'Vega', 'kslv' => 'KSLV/Naro/Nuri', 'antares' => 'Antares',
                 'epsilon' => 'Epsilon', 'solids_china' => 'Chinese solids', 'angara' => 'Angara (Amur)',
                 'lvm' => 'LVM', 'newlongmarch' => 'Long March (new)'];
$eraBoom      = ['' => 'Overview', 'electron' => 'Electron', 'alpha' => 'Alpha',
                 'sslv' => 'SSLV', 'sls' => 'SLS', 'landspace' => 'LandSpace',
                 'terran' => 'Terran', 'tianlong' => 'Tianlong', 'starship' => 'Starship',
                 'vulcan' => 'Vulcan', 'newglenn' => 'New Glenn',
                 // Those have shown they can orbit; now here are the ones that have launched but not orbited yet:
                 'spectrum' => 'Spectrum', 'kinetica' => 'Lijian/Kinetica', 'kairos' => 'Kairos',
                 'eris' => 'Eris', 'hanbit' => 'Hanbit'];
$eraCancelled = ['' => 'Overview', 'vector' => 'Vector', 'phantomx' => 'Phantom Express',
                 'omega' => 'OmegA', 'launcherone' => 'LauncherOne', 'astra' => 'Astra',
                 'skylon' => 'Skylon', 'rs1' => 'RS1', 'prime' => 'Prime',  // now the ones not officially cancelled:
                 'bloostar' => 'Bloostar', 'haas' => 'Haas', 'neptune' => 'Neptune'];
$eraFuture    = ['' => 'Overview', 'rfa' => 'RFA', 'neutron' => 'Neutron', 'nova' => 'Nova',
                 'dawn' => 'Dawn', 'skyrora' => 'Skyrora', 'nebula' => 'Nebula',
                 'newline' => 'New Line', 'miura' => 'Miura', 'spinlaunch' => 'SpinLaunch',
                 'bluewhale' => 'Blue Whale', 'hapith' => 'Hapith'];
$eraVessels   = ['' => 'Overview', 'soyuz' => 'Soyuz', 'shenzhou' => 'Shenzhou', 'dragon' => 'Dragon',
                 'starliner' => 'CST-100 Starliner', 'orion' => 'Orion', 'mengzhou' => 'Mengzhou',
                 'bluemoon' => 'Blue Moon', 'starship' => 'Starship', 'dreamchaser' => 'Dream Chaser',
                 'gaganyaan' => 'Gaganyaan', 'orel' => 'Orel', 'cargo' => 'cargo carriers'];
$eraStations  = ['' => 'Overview', 'iss' => 'ISS', 'tiangong' => 'Tiangong', 'gateway' => 'LOP-G',
                 'axiom' => 'Axiom Station'];

//$privateMap = ['pegasus' => 'm', 'minotaur' => 'm', 'falcon' => 'r', 'antares' => 'r', 'electron' => 'b',
//               'astra' => 'x', 'alpha' => 'b', 'landspace' => 'b', 'rs1' => 'x', 'terran' => 'b',
//               'tianlong' => 'b', 'starship' => 'b', 'neptune' => 'x', 'vulcan' => 'b', 'newglenn' => 'b',
//               'spectrum' => 'b', 'rfa' => 'f', 'dawn' => 'f', 'prime' => 'x', 'nebula' => 'f', 'nova' => 'f',
//               'neutron' => 'f', 'newline' => 'f', 'miura' => 'f', 'bluewhale' => 'f', 'hapith' => 'f',
//               'eris' => 'b', 'haas' => 'x', 'bloostar' => 'x', 'skylon' => 'x', 'vector' => 'x', 'omega' => 'x',
//               'launcherone' => 'x', 'dragon' => 'v', 'starliner' => 'v', 'bluemoon' => 'v', /*'starship' => 'v',*/
//               'dreamchaser' => 'v', 'axiom' => 'h', 'hanbit' => 'b', 'kinetica' => 'b'];

function eraToUse($mainSection)
{
    global $eraOld, $eraMiddle, $eraRevival, $eraBoom, $eraCancelled, $eraFuture, $eraVessels, $eraStations;
    switch ($mainSection)
    {
        case 'o': return $eraOld;
        case 'm': return $eraMiddle;
        case 'r': return $eraRevival;
        case 'b': return $eraBoom;
        case 'x': return $eraCancelled;
        case 'f': return $eraFuture;
        case 'v': return $eraVessels;
        case 'h': return $eraStations;
        default:  return null;          // intro, etc
    }
}

function sectionServerPath($section)
{
    switch ($section)
    {
        case 'o':   return 'era_old.html-content';          break;
        case 'm':   return 'era_middle.html-content';       break;
        case 'r':   return 'era_transition.html-content';   break;
        case 'b':   return 'era_boom.html-content';         break;
        case 'x':   return 'era_cancelled.html-content';    break;
        case 'f':   return 'era_future.html-content';       break;
        case 'v':   return 'spacecraft.html-content';       break;
        case 'h':   return 'stations.html-content';         break;
        default:    return $section . '.html-content';      break;   // intro, legend, etc
    }
}

function lastModTimeISO($path)
{
    $modtime = new DateTime('@' . filemtime($path));
    $modtime->setTimezone(new DateTimeZone('UTC'));
    return $modtime->format(DateTime::ATOM);
}

function sitemapXmlRecord($url, $source, $pri)
{
    echo "<url>\n  <loc>$url</loc>\n  <lastmod>" . lastModTimeISO($source) . "</lastmod>\n" .
         "  <priority>$pri</priority>\n  <changefreq>monthly</changefreq>\n</url>\n";
}


$eraToUse = null;
$articleBase = substr($article, -5) !== '-test' ? $article : substr($article, 0, -5);    // [TEST]
if (!$show404)
{
    $eraToUse = eraToUse($mainSection);
    $show404 = $article && (!$eraToUse || !in_array($articleBase, array_keys($eraToUse), true));
    // if ($articleBase !== $article) $log .= "\n*** articleBase '$articleBase' — " . ($show404 ? 'not found' : 'found');
    // if ($eraToUse) $log .= "\n*** size of eraToUse is " . count($eraToUse);
    if ($show404 && $article) {         // try to mitigate -- article may have been moved
        if ($article == 'nextgen')                          // article has been renamed
            $article = $articleBase = 'mengzhou';
        foreach ($sections as $sec)
        {
            $tryEra = eraToUse($sec[0]);
            if ($tryEra && in_array($articleBase, array_keys($tryEra), true))
            {
                $redirection = $rootU . $sec[0] . '/' . $article;
                break;
            }
        }
    }
}

if ($redirection)
{
    http_response_code(301);
    header("Location: $redirection");
}
else if ($show404)
{
    if ($mainSection == 'sitemap.txt') {
        header('Content-Type: text/plain; charset=utf-8');
        foreach ($sections as $ix => $s) {
            $ath = $rootU;
            $ra = eraToUse($s[0]);
            if ($ix == 0)
                echo $ath . "\n";
            else {
                $ath .= $s[0];
                if (!$ra)
                    echo $ath . "\n";
                else
                    foreach ($ra as $pag => $dummy)
                        if (!$pag)
                            echo $ath . "\n";                   // canonical for summary pages has no trailing slash
                        else
                            echo $ath . "/$pag\n";
            }
        }
        exit(0);
    } else if ($mainSection == 'sitemap.xml') {
        header('Content-Type: text/plain; charset=utf-8');      // this is an xml fragment, not a complete valid document
        foreach ($sections as $ix => $s) {
            $ath = $rootU;
            $ra = eraToUse($s[0]);
            // The priorities used here are all above 0.5 as they are within the context of a larger
            // website which contains a lot of old outdated stuff which ranks below any of these pages.
            if ($ix == 0) {
                echo "\n<!-- ROCKETS ~ incorporate into sitemap.xml -->\n";
                sitemapXmlRecord($ath, 'alphabetic-test.html-content', '1.0');          // root
            } else {
                $ath .= $s[0];
                if (!$ra)
                    sitemapXmlRecord($ath, sectionServerPath($s[0]), '0.60');           // intro, etc
                else
                    foreach ($ra as $pag => $dummy)
                        if (!$pag) {
                            echo "\n";
                            sitemapXmlRecord($ath, sectionServerPath($s[0]), '0.90');   // era overview
                        } else {
                            $src = ($s[0] == 'v' || $s[0] == 'h' ? 's/' : "r$s[0]/") . "$pag.html-content";
                            sitemapXmlRecord("$ath/$pag", $src, '0.70');                // era item
                        }
            }
        }
        exit(0);
    } else {
        $pageTitle = '404 Not Found';
        http_response_code(404);
    }
}
else
{
    if ($commentSystem === 'inline')
        session_start();
    if ($eraToUse && $article) {
        $pageTitle = $eraToUse[$articleBase];
        $canonical = $rootU . $mainSection . '/' . $articleBase;
    } else {
        $pageTitle = $sections[$sectionNumber][1];
        if ($mainSection == 'alphabetic' || $mainSection == 'alphabetic-test')      // [TEST]
            $canonical = $rootU;
        else
            $canonical = $rootU . $mainSection;
    }
}


/* For the filters to work, the CSS classes for each rocket have to be defined serverside.
   The old page just put these on each rocket article, and then duplicated them
   manually in the filter results display, but here filters apply only to the nav
   parts, not to the articles themselves.  These are indexed by virtual path.
   These are still duplicated within each article (fix that someday?), so keep them in sync. */
$filterClasses = ['o/soyuz'         => 'rus medium astro cryo gov commz spend pop',
                  'o/atlas'         => 'usa medium astro cryo gov commz spend pop',
                  'o/delta'         => 'usa medium heavy sat cryo gov commz spend pop',
                  'o/proton'        => 'rus heavy brave golic gov commz spend pop',
                  'o/oldlongmarch'  => 'china medium astro golic gov commz spend pop',
                  'm/ariane'        => 'eu medium brave cryo gov commz spend pop',
                  'm/zenit'         => 'ukraine rus medium sat cryo gov commz spend rare',
                  'm/h'             => 'japan medium brave cryo gov commz spend pop',
                  'm/shavit'        => 'israel light sat solid gov nocomm spend rare',
                  'm/pegasus'       => 'usa light sat solid comm spend rare',
                  'm/pslv'          => 'india medium sat solid commz spend pop',
               /* 'm/start'         => 'rus light sat solid gov nocomm spend rare', */
                  'm/minotaur'      => 'usa light sat solid comm spend rare',
                  'm/rokot'         => 'rus light sat golic gov commz spend rare',
                  'r/falcon'        => 'usa heavy astro cryo comm reuse pop',
                  'r/unha'          => 'northkorea iran light sat golic gov nocomm spend rare',
                  'r/vega'          => 'eu light sat solid gov commz spend rare',               // pop soon?
                  'r/kslv'          => 'southkorea light medium sat cryo gov nocomm spend rare',
                  'r/antares'       => 'usa medium sat cryo comm spend rare',
                  'r/epsilon'       => 'japan light sat solid gov commz spend rare',
                  'r/solids_china'  => 'china light sat solid gov commz spend pop',
                  'r/angara'        => 'rus medium heavy brave cryo gov commz spend rare',      // amur reuse
                  'r/lvm'           => 'india medium brave golic gov commz spend rare',
                  'r/newlongmarch'  => 'china light medium heavy brave cryo gov commz reuse pop',
                  'b/electron'      => 'newzealand usa light sat cryo comm reuse pop',
                  'b/alpha'         => 'usa light sat cryo comm spend rare',
                  'b/sslv'          => 'india light sat solid gov commz spend rare',
                  'b/sls'           => 'usa superheavy brave cryo gov nocomm spend rare',
                  'b/landspace'     => 'china light medium sat cryo comm spend rare',
                  'b/terran'        => 'usa light sat cryo comm spend rare',
                  'b/tianlong'      => 'china light medium sat cryo comm reuse rare',
                  'b/starship'      => 'usa superheavy brave cryo comm reuse rare',
                  'b/vulcan'        => 'usa medium heavy brave cryo comm reuse rare',
                  'b/kairos'        => 'japan light sat solid comm spend rare',
                  'b/newglenn'      => 'usa heavy brave cryo comm reuse rare',
                  'b/spectrum'      => 'germany light sat cryo comm spend rare',
                  'b/eris'          => 'australia light sat solid comm spend rare',
                  'b/hanbit'        => 'southkorea light sat solid comm spend rare',
                  'b/kinetica'      => 'china light medium sat cryo comm spend rare',
                  'x/vector'        => 'usa light sat cryo comm spend rare',
                  'x/phantomx'      => 'usa light sat cryo gov nocomm reuse rare',
                  'x/omega'         => 'usa medium heavy sat solid comm spend rare',
                  'x/launcherone'   => 'usa light sat cryo comm spend rare',
                  'x/astra'         => 'usa light sat cryo comm spend pop',
                  'x/skylon'        => 'britain medium brave cryo comm reuse rare',
                  'x/rs1'           => 'usa light sat cryo comm spend rare',
                  'x/prime'         => 'britain light sat cryo comm reuse rare',
                  'x/bloostar'      => 'spain light sat cryo comm reuse rare',
                  'x/haas'          => 'romania usa light sat golic comm spend rare',
                  'x/neptune'       => 'usa light sat golic comm spend rare',
                  'f/rfa'           => 'germany light sat cryo comm spend rare',
                  'f/neutron'       => 'newzealand usa medium brave cryo comm reuse rare',
                  'f/nova'          => 'usa medium sat cryo comm reuse rare',
                  'f/dawn'          => 'newzealand germany nether light sat golic comm reuse rare',
                  'f/skyrora'       => 'britain light sat golic comm spend rare',
                  'f/nebula'        => 'china light sat cryo comm spend rare',
                  'f/newline'       => 'china light sat cryo comm reuse rare',
                  'f/miura'         => 'spain light sat cryo comm reuse rare',
                  'f/spinlaunch'    => 'usa light sat comm reuse rare',
                  'f/bluewhale'     => 'southkorea light sat cryo comm spend rare',
                  'f/hapith'        => 'taiwan light sat solid comm spend rare',
                  // ----------
                  'v/soyuz'         => 'rus gov spend commz',
                  'v/shenzhou'      => 'china gov spend nocomm',
                  'v/dragon'        => 'usa reuse comm',
                  'v/starliner'     => 'usa reuse comm',
                  'v/orion'         => 'usa gov reuse nocomm',
                  'v/mengzhou'      => 'china reuse gov nocomm',
                  'v/bluemoon'      => 'usa reuse comm',                // combine gov with comm someday?
                  'v/starship'      => 'usa reuse comm',
                  'v/dreamchaser'   => 'usa reuse comm',
                  'v/gaganyaan'     => 'india spend gov nocomm',
                  'v/orel'          => 'rus reuse gov nocomm',
                  'v/cargo'         => '',
                  'h/iss'           => 'usa rus eu japan reuse gov commz',
                  'h/tiangong'      => 'china reuse gov nocomm',
                  'h/gateway'       => 'usa eu japan reuse gov nocomm',
                  'h/axiom'         => 'usa reuse comm'];
// cases of dual nation: electron, haas, iss, gateway, dawn/aurora
// cases of dual weight: angara, newlongmarch, omega, landspace  (formerly included falcon)
// (since separating LVM there are no longer any cases of dual fuel or dual crew readiness)

function listFilteredArticles($mainSectionsToInclude)
{
    global $filterClasses, $rootA;
    $lastSection = '';
    $era = null;
    foreach ($filterClasses as $key => $classes)
    {
        $keyParts = explode('/', $key);
        if (strchr($mainSectionsToInclude, $keyParts[0]))
        {
            $separator = '·';
            if ($lastSection != $keyParts[0])
            {
                if ($lastSection)
                    $separator = '· | ·';
                $lastSection = $keyParts[0];
                $era = eraToUse($lastSection);
            }
            $name = $era[$keyParts[1]];
            echo "<span\n class='$classes'> $separator <a href='$rootA/$key'>$name</a></span>";
        }
    }
}



// ======================== MARKUP BEGINS HERE:
?><!DOCTYPE html>
<html lang="en">
<head>
<?php
if (!$redirection && $mainSection !== 'sitemap.txt')
{
?>
    <title>Rockets of Today<?= $warning?> — <?= $pageTitle ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />  <!-- fallback for future.css -->
    <meta name="Author" content="Paul Kienitz" />
    <meta name="Keywords" content="rocket, rockets, booster, orbit, space, spacex, falcon, blue origin, new glenn, phantom express, ariane, long march, angara, skylon, starship, Paul Kienitz, Kienitz, future, science, <?= $pageTitle ?>" />
    <link rel='preconnect' href='https://fonts.googleapis.com' />
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Brygada+1918:ital,wght@0,400..700;1,400..700&family=Viga&display=swap' />
    <link rel='stylesheet' href='/future/future.css' />
    <link rel='stylesheet' href='<?=$rootM?>/rockets.css' />
    <link rel="icon" type="image/png" href="/rockets/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/rockets/favicon.svg" />
    <link rel="shortcut icon" href="/rockets/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/rockets/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Rockets of Today" />
    <link rel="manifest" href="/rockets/site.webmanifest" />
<?php
    if (!$show404)
    {
?>
    <link rel='canonical' href='<?=$canonical?>' />
    <script src='<?=$rootM?>/rockets.js'></script>
    <script src='<?=$rootM?>/spare05X_single2.js'></script>
    <script src='<?=$rootM?>/rockets_nav.js'></script>
<?php
    // if we were to use hashover, we'd pull in its comments.css and comments.js here
    }
?>

<?php
    if ($eraToUse)
    {
        echo("    <script>\n        var eraTitles = {\n");
        $oti = $sections[$sectionNumber][1];
        foreach ($eraToUse as $ar => $title)
            echo("            '$rootA/$mainSection/$ar': 'Rockets of Today — " . ($ar ? $title : $oti) . "',\n");
        echo("        }\n        var overviewPath = '$rootA/$mainSection/';\n");
        echo("        var overviewName = '$oti';\n");
        echo("        var articleContentPath = '$rootM/$articleFolder';\n    </script>\n");
    }
?>

    <script>
        var targetsR = {
<?php
    foreach ($filterClasses as $path => $classy)
        if ($path[0] != 'h' && $path[0] != 'v')
            echo("            '$path': '$classy',\n");
?>
        };
        var targetsH = {
<?php
    foreach ($filterClasses as $path => $classy)
        if ($path[0] == 'h')
            echo("            '$path': '$classy',\n");
?>
        };
        var targetsV = {
<?php
    foreach ($filterClasses as $path => $classy)
        if ($path[0] == 'v')
            echo("            '$path': '$classy',\n");
?>
        };
        var rootA = "<?= $rootA ?>/";
        var enableComments = <?= array_search($commentSystem, array('inline', 'iframe', 'hash'), true) !== false ? 'true' : 'false' ?>;
    </script>

<?php
    if (!$show404)
    {
?>
    <style>
        /* Temporary or experimental styles -- migrate good ones to rockets.css: */
        main a[id] { scroll-margin-top: 2rem; }
    </style>
<?php
    }
} /* !$redirection */
?>
</head>


<!-- ======================== VISIBLE CONTENT BEGINS HERE: -->
<body>
<div class=bodied>

<?php
if ($redirection)
    echo "<p>Redirecting to $redirection</p>";
else
{
?>
<h1 class=maintitle>Rockets of Today<?= $warning?></h1>

<?php
    if (!$show404)
    {
?>
<NAV class=filtration>
    <div class=popupParent>
        <button id=filterButton class=filterDropper>select filters
            <img src='<?=$rootM?>/navarrow.svg' class='menuarrow' alt='show/hide filters'>
        </button>
        <div id=filterPopup class=inputPopup style="display: none">

<?php
            require 'filter.html-content';
            echo("\n<p class=summz>\n—&nbsp;<i>Rockets included with current filters:</i>");
            listFilteredArticles('omrbxf');
            echo("&nbsp;—\n</p>\n\n<p class=summz>\n—&nbsp;<i>Spacecraft and stations included with current filters:</i>");
            listFilteredArticles('vh');
            echo("&nbsp;—\n<br />\n(<i>Note that only the last three filters — reuse, commercialization, and country — apply to this group.</i>)\n</p>\n");
?>

        </div>
        <i>Currently selected:</i>
        <span id=filterlist>
        </span>
    </div>
</NAV>

<div itemscope itemtype="https://schema.org/BreadcrumbList">
  <NAV class="popupParent erae">
    <!-- era selector -->
<?php
        $sc = count($sections);
        $prior = $sections[($sectionNumber + $sc - 1) % $sc];
        $nextr = $sections[($sectionNumber + 1) % $sc]
?>
    <span class="eraselect left">
        <?php echo("<a href='$rootA/$prior[0]'>$prior[2]&nbsp;<img src='$rootM/ffwd.svg' class='navarrow left' alt='$prior[1]' /></a>\n"); ?>
    </span>
    <span class="eraselect center">
        <button id=mainSectionButton>
            <span class=narrow><?=$sections[$sectionNumber][2]?></span><span class=wide><?=$sections[$sectionNumber][1]?></span>
            <img src='<?=$rootM?>/navarrow.svg' class='menuarrow' alt='show/hide list of sections'>
        </button>
    </span>
    <span class="eraselect right">
        <?php echo("<a href='$rootA/$nextr[0]'><img src='$rootM/ffwd.svg' class='navarrow right' alt='$nextr[1]' />&nbsp;$nextr[2]</a>\n"); ?>
    </span>
    <div id=mainSectionPopup class="inputPopup center20" style="display: none">
<?php
        foreach ($sections as $num => $sec)   // section names form menu items in the dropdown
        {
            $path = $num == 0 ? '' : $sec[0];
            $name = $sec[1];
            if (eraToUse($sec[0]))
                $name = strtoupper($name) . " »";
            $level = $num == 0 ? 1 : 2;
            if ($num == 0 || $num == $sectionNumber)
                echo("        <div class=menuItem itemprop=itemListElement itemscope itemtype='https://schema.org/ListItem'>" .
                             "<meta itemprop=position content='$level'><meta itemprop=name content='$sec[1]'>" .
                             "<a href='$rootA/$path' itemprop=item>$name</a></div>\n");
            else
                echo("        <div class=menuItem><a href='$rootA/$path'>$name</a></div>\n");
        }
?>
    </div>
  </NAV>

<?php
        if ($eraToUse)
        {
            $itemy = $article ? " itemprop=itemListElement itemscope itemtype='https://schema.org/ListItem'" : '';
            // Tabs!  These are the links to the individual articles within the era.
            echo("  <NAV class='subtabby bigimage'>  <!-- for eras which have tabs for individual articles -->\n    <div$itemy><div id=tabset>&ensp;\n");
            foreach ($eraToUse as $item => $name)
            {
                $articlePath = $mainSection . '/' . $item;
                $sel = $item == $articleBase ? ' selectedtab' : '';
                $itemy = $sel != '' && $item != '' ? " itemprop=item" : '';
                if ($itemy)
                    echo("        <meta itemprop=position content='3'><meta itemprop=name content='$name'>\n");
                $filter = $article ? $filterClasses[$articlePath] ?? null : null;
                echo("        <a class='articletab$sel $filter'$itemy href='$rootA/$articlePath'>$name</a>\n");
            }
            echo("        <span class=tabrejects>[<span id=rejectcount>0</span> hidden]</span>&ensp;\n");
            // That ensp is for an old Firefox bug that didn't use all of the padding on the right of this scrollable region.
            // Even with actual content there instead of padding, it still allocates less space there than on the left,
            // but it's closer to symmetrical, so this partially mitigates the bug.  In Chrome it's symmetrical either way.
            echo("    </div></div>\n  </NAV>\n");
        } /* $eraToUse */
?>
</div>
<?php
    } /* !$show404 */
?>

<!-- ======================== SUBSTANTIVE NON-NAVIGATIONAL CONTENT GOES HERE: -->
<MAIN id=mainContent itemscope itemtype="https://schema.org/Article">
    <div style="display: none" itemprop=author itemscope itemtype="https://schema.org/Person"><meta itemprop=name content="Paul Kienitz"><meta itemprop=url content="https://paulkienitz.net/"></div>

<?php
    if ($show404)
    {
        echo("    <h1 style='color: #660000; font-family: initial;'>404 Not Found</h1>\n");
        echo("    <p>" . htmlspecialchars($reqPath) . " is not the URL of an article on this site.</p>\n");
        echo("    <p><a href='$rootA'>Here is the index of content.</a></p>\n");
    }
    else if ($article)
    {
        echo("    <meta itemprop=dateModified content='" . lastModTimeISO($articleFolder . $article . '.html-content') . "'>\n");
        require $articleFolder . $article . '.html-content';
        $cmtx_identifier = $mainSection . '/' . $article;
        if ($commentSystem === 'inline')
        {
            $cmtx_reference = $pageTitle;
            echo "    <div class=commentation>";
            require($_SERVER['DOCUMENT_ROOT'] . $cmtx_folder . 'frontend/index.php');
            echo '        <div class=termination><a href="#" data-cmtx-target-modal="#cmtx_terms_modal">terms and conditions for commenters</a>';
            echo '&emsp;|&emsp;<a href="#" data-cmtx-target-modal="#cmtx_privacy_modal">privacy policy</a></div>';
            echo "\n    </div>\n";
        }
//        else if ($commentSystem === 'hash')                                   // [TEST]
//            echo "    <div class=commentation><div id=hashover></div></div>";
    }
    else
    {
        echo("    <meta itemprop=dateModified content='" . lastModTimeISO(sectionServerPath($mainSection)) . "' />\n");
		echo("    <meta itemprop=headline content='" . $sections[$sectionNumber][1] . "' />\n");
        if ($addIntro)
        {
            echo('<p class=narrowp>
This is a resource for learning about the human race’s current capabilities for
spaceflight.&ensp;There’s a page for every active spacecraft or space station,
and for every rocket capable of reaching orbit.&ensp;There is also coverage for
a lot of forthcoming space hardware.&ensp;See the <a href="intro">Introduction</a>
and <a href="legend">Stats &amp; Specs</a> pages for further explanation.&ensp;It
was formerly titled “Commercial Rockets”.
</p><p class=narrowp>
<i>New feature!</i>&ensp;The individual rocket articles now let you respond with
comments, like you would on a blog post.&ensp;Keep comments civil.
</p>
');
        }

        echo("<h4 id=mainSeparateHeader class=era><span>" . strtolower($sections[$sectionNumber][1]) . "</span></h4>\n");
        require sectionServerPath($mainSection);

        if ($eraToUse)
        {
            $flavor = $mainSection == 'v' ? 'Spacecraft' : ($mainSection == 'h' ? 'Stations' : 'Rockets');
            echo("\n<p class=summz>\n—&nbsp;<i>$flavor included with current filters:</i>");
            listFilteredArticles($mainSection);
            echo("&nbsp;—\n</p>\n");
        }
    }
?>
</MAIN>
<!-- ======================== END OF SUBSTANTIVE CONTENT -->

<?php // if ($log) echo("<pre style='background-color: white'>$log</pre>\n"); ?>
<div id=clientlog style="white-space: pre-wrap;"></div>

<FOOTER>
<hr class='bottom' style='margin-top: 4em'>

<p class='bottom'><a href="/future/"><img alt="home" class="icon"
  src="/img/rocket2.png"></a>toward <a href="/future/"><i>The Future!</i></a></p>
<p class='bottom'><a href="/future/science.html"><img alt="home" class="icon"
  src="/img/atom.png"></a>over to <a href="/future/science.html"><i>Paul Tries to Understand Science</i></a></p>
<p class='bottom'><a href="/"><img alt="home" class="icon"
  src="/img/home.png"></a>back to <a href="/">my home page</a></p>
<p class='bottom'><a href="mailto:paul@paulkienitz.net"><img alt="mailbox" class="icon"
  src="/img/mailbox.png"></a><a href="mailto:paul@paulkienitz.net">send mail</a> to Paul Kienitz</p>
</FOOTER>

</div>  <!-- bodied -->
<div id=topstripe style="visibility: hidden; top: -3em;">
    <div>
        <h1 class=maintitle>Rockets of Today<?= $warning?></h1>
        <div id=topper><i>top</i>&nbsp;<!-- span id=knuth>&#8679;</span --><img src='<?= $rootM ?>/ffwd.svg' class=navarrow alt='scroll to top' /></div>
        <h2 class=rocket>&ensp;— 
            <i id=sectioname style="display: <?= $article ? 'none' : 'inline' ?>"><?= strtolower($sections[$sectionNumber][1]) ?></i>
            <span id=rocketname style="display: <?= $article ? 'inline' : 'none' ?>"><?= $article ? $eraToUse[$articleBase] : '' ?></span>
        </h2>
    </div>
</div>
<?php
} /* !$redirection */
?>
</body>
</html>
