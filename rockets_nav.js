// The script rockets.js defines stuff used by both the old tall format and the
// new navigable format.  This supplements it by defining things which are used
// only in the new format.  Uses SPARE (https://github.com/paulkienitz/SPARE).
// We stuck to ECMAScript 3 originally.  Nowadays 6 should be perfectly safe.


// First, enhanced functionality for the filter form.

function collectNames(names)
{
    var name, ret = "";
    while ((name = names.shift()))
    {
        var checkbox = document.forms["filter"].elements[name];
        var labelText = document.querySelector("label[for='" + checkbox.id + "']").innerHTML;
        ret += labelText.toLowerCase().replace(/[!,;?)(]+/g, "");
        if (names.length > 0)
            ret += " or ";
    }
    return ret;
}

function describeFilter(set)
{
    var offs = [], ons = [];
    for (var i in filtersets[set])
        (isChecked(filtersets[set][i]) ? ons : offs).push(filtersets[set][i]);
    if (offs.length === 0)
        return "";
    else if (ons.length === 0)
        return set + ": oops, ALL EXCLUDED";
    else if (ons.length > offs.length)
        return set + ": not " + collectNames(offs);
    else
        return set + ": " + collectNames(ons) + " only";
}

function displayFilters()   // invoked by filtrate
{
    var filterlist = document.getElementById("filterlist");
    if (!filterlist)
        return;
    var newlist = "";
    for (var set in filtersets)
    {
        var description = describeFilter(set);
        if (description)
            newlist += "&ensp;<span class=activefilter>" + description +
                       "<button onclick='clearFilterSet(this, true)' value=" + set +
                       ">×</button></span>";
    }
    filterlist.innerHTML = newlist || "none";
    positionSelectedTab();    // filter change means position change
    countHiddenTabs();
}

function clearFilterSet(button, check)
{
    var names = filtersets[button.value];
    for (var ch in names)
        SetCheck(names[ch], check);
    filtrate(false);
}

function clearAllFilters()
{
    for (var fs in filtersets)
        for (var ch in filtersets[fs])
            SetCheck(filtersets[fs][ch], true);
    filtrate(false);
}

// This must run before the DOMContentLoaded event:
if (!(/(^|;\s*)filter=([^;]*)/.test(document.cookie)))
    defaultCookie = "fvv7v";        // can't call clearAllFilters, DOM isn't loaded yet


// ----------
// The alphabetic index is the first page they see, and the filters are right above it,
// so we need to style the items to indicate outcomes of changing the filters.

function applyFilterClassesToIndex()
{
    var lnx = document.querySelectorAll('#alpha a');    // no match on most pages
    for (var k = 0; k < lnx.length; k++)
    {
        var who = lnx[k].getAttribute("href");
        if (who in targetsR)
            lnx[k].className = targetsR[who];
        else if (who in targetsV)
            lnx[k].className = targetsV[who];
        else if (who in targetsH)
            lnx[k].className = targetsH[who];
    }
    if (lnx.length)
        filtrate(true);
}

window.addEventListener("DOMContentLoaded", applyFilterClassesToIndex);

// ----------
// Let's make a horizontally scrolling row of tabs which loads content with SPARE.

function positionSelectedTab()
{
    var sel = document.querySelector(".selectedtab");
    if (sel)
    {
        // sel.scrollIntoView();
        if (sel.offsetLeft < sel.offsetParent.scrollLeft ||
                 sel.offsetLeft + sel.offsetWidth > sel.offsetParent.scrollLeft + sel.offsetParent.offsetWidth)
            sel.offsetParent.scrollLeft = sel.offsetLeft + sel.offsetWidth + 50 - sel.offsetParent.offsetWidth;
    }
}

function countHiddenTabs()
{
    var tabtainer = document.getElementById('tabset');
    if (tabtainer)      // can be null for some navigations
    {
        var hiddenct = tabtainer.querySelectorAll('.articletab.hidey:not(.selectedtab), ' +
                                                  '.articletab.hideySize:not(.selectedtab), ' +
                                                  '.articletab.hideyNation:not(.selectedtab)').length;
        var ceptacle = document.getElementById('rejectcount');
        ceptacle.innerHTML = String(hiddenct);
        ceptacle.parentElement.style.display = hiddenct > 0 ? 'inline' : 'none';
    }
}

function selectTab(newtab)
{
    var tabs = newtab.parentElement.querySelectorAll(".selectedtab");
    for (var t = 0; t < tabs.length; t++)
        tabs[t].classList.remove("selectedtab");
    newtab.classList.add("selectedtab");            // also makes it visible if hidden
    positionSelectedTab();
    countHiddenTabs();
    // fix the label in topstripe:
    var sectioname = document.getElementById("sectioname");
    var rocketname = document.getElementById("rocketname");
    if (sectioname && rocketname)
        if (overviewPath === newtab.pathname)
        {
            sectioname.style.display = 'inline';
            rocketname.style.display = 'none';
            filtrate(true);                         // update freshly-displayed rocket list
        }
        else
        {
            sectioname.style.display = 'none';
            rocketname.style.display = 'inline';
            rocketname.innerHTML = newtab.innerHTML;
        }
    titlel = null;       // tell scrollHandler to recheck article name
}

function sparBack(event)
{
    if (typeof event.state === "object")   // else this is a click on a new tab, not a popstate
    {
        var tab = document.querySelector(".articletab[href$='" + location.pathname + "'], .articletab[href$='" + location.pathname + "/']");
        if (tab)
            selectTab(tab);
        else if (typeof console === "object")
            console.error("SPARE apparently loaded URL " + location.href + " for which no tab is identifiable");
    }
}

function spar(event)    // if SPARE is usable, this is our click handler for tabs within an era
{
    var tab = this;
    var urlAbs = tab.href;
    var urlRel = tab.getAttribute("href");     // the raw string value from the markup, not URL()ized

    var sparSuccess = function ()
    {
        selectTab(tab);
    };
    var sparFail = function (ex)
    {
        if (typeof console === "object")    // ex will always exist and have httpStatus and httpMessage properties:
            console.error("SPARE ran into " + ex.httpStatus + " " + ex.httpMessage + " when loading " + urlRel);
        window.location = urlAbs;
    };

    event.preventDefault();
    if (urlRel === overviewPath || enableComments)
        // for overviews, use full php render to generate things like the filter visibility list,
        // and likewise if a comments section has to be rendered below an article
        SPARE.simulateNavigation("mainContent", urlRel, "mainContent", eraTitles[urlRel], urlAbs)
             .then(sparSuccess, sparFail);
    else
    {
        // if we're rendering just article content, we can grab it directly, which is more efficient
        var source = articleContentPath + urlRel.substring(urlRel.lastIndexOf('/') + 1) + ".html-content";
        SPARE.simulateNavigation("mainContent", source, undefined, eraTitles[urlRel], urlAbs)
             .then(sparSuccess, sparFail);
    }
}
/* TEST CASES: Overview to tabs and back and forward.  Rocket to tabs incl overview and back and forward.
               Hashed location to tabs to hash and back and forward.  Each of the above with long jumps.
               Intermix SPARE with navigation and test long jumps across.  Use something to detect SPARE vs reload.
               Change content and then navigate tabs in Firefox to check stale content bug.
*/

function initSpar()
{
    if (typeof SPARE === "object")
    {
        var tabs = document.querySelectorAll(".articletab");
        for (var t = 0; t < tabs.length; t++)
            tabs[t].addEventListener("click", spar);
        document.addEventListener("SPAREContentLoaded", sparBack);
    }
}

// -----------
// Finally, let's implement popup menus and dialogs.

var popups;

// Based on menuHandler from capejeer, but with less compatibility for older browsers:
function popupHandler(e)
{
    for (var m in popups)
    {
        if (this.id === m && popups[m].style.display === "none")
        {
            popups[m].style.display = "block";
            //this.innerHTML = this.innerHTML.replace("▼", "▲");
            var arrow = this.getElementsByTagName("IMG")[0];
            if (arrow) arrow.style.transform = "scaleY(1)";
            e.stopPropagation();
        }
        else
        {
            popups[m].style.display = "none";
            var but = document.getElementById(m);
            //but.innerHTML = but.innerHTML.replace("▲", "▼");
            var arrow = but.getElementsByTagName("IMG")[0];
            if (arrow) arrow.style.transform = "scaleY(-1)";
        }
    }
    return true;
}

function initPopups()
{
    popups = [];
    popups["filterButton"]      = document.getElementById("filterPopup");
    popups["mainSectionButton"] = document.getElementById("mainSectionPopup");
    // ...add more to that list if any future popouts get created
    for (var id in popups)
        document.getElementById(id).addEventListener("click", popupHandler);
    window.addEventListener("click", popupHandler);     // attaching to body doesn't cover page margins
    initSpar();
    var topper = document.getElementById("topper");
    if (topper) topper.addEventListener("click", function () { window.scrollTo(0, 0); });

    titlel = document.getElementById("mainSeparateHeader") || document.querySelector("h2.rocket");
    topstripe = document.getElementById("topstripe");
    //clientlog = document.getElementById("clientlog");
}

window.addEventListener("DOMContentLoaded", initPopups);


// And let's show and hide the mini title stripe.

var titlel, topstripe;  //, clientlog;

//function log(m)           // this piggybacks on the output area used in the test page for PHP serverside log content
//{
//    if (clientlog && m)
//        clientlog.innerHTML += m + "\n";
//}

function scrollHandler(e)
{
    if (!titlel)
        titlel = document.getElementById("mainSeparateHeader") || document.querySelector("h2.rocket");
    if (titlel && topstripe) {
        var re = titlel.getBoundingClientRect();
        var up = re.top < 0 && re.bottom < -0.5 * re.top;
        // console.log("bottom at " + re.bottom + " so it " + (up ? "IS" : "is NOT") + " up.");
        if (up && topstripe.style.visibility === "hidden")
            topstripe.style.visibility = "visible", topstripe.style.top = "0";
        else if (!up && topstripe.style.visibility === "visible")
            topstripe.style.visibility = "hidden", topstripe.style.top = "-3em";
    }       // those have timed transitions in CSS
}

window.addEventListener("scroll", scrollHandler);   // TODO: scrollend event has recently come to Safari and Opera
window.addEventListener("load", scrollHandler);     // don't wait for a user input to get it right

