// The rockets page where this is used once existed in two forms, both
// containing the same articles.  The old format is a single tall page with
// various sections being showable and hideable to make it manageable.  The
// new format uses two levels of navigation to show a single topic at a time.
// This script contains stuff used by both versions of the page, starting
// with stuff for the form that lets you filter articles.  Stuff used only
// by the new page format is in rockets_nav.js, which supplements this.
// Formerly, rockets_sec.js had stuff used only by the old page.

// The script material used by both pages consists mainly of support for
// the filtering options, which have a UI of grouped checkboxes.

function isChecked(checkboxName)
{
    return document.forms["filter"].elements[checkboxName].checked;
}

function SetCheck(checkboxName, check)
{
    document.forms["filter"].elements[checkboxName].checked = check;
}

// Show or hide rockets by a checkbox and a CSS selector.  The suffix lets us
// use any of several distinct CSS classes to do the hiding, to reduce crosstalk.
function ch(lector, checkboxNameOrValue, hide, suffix)
{
    var checked = typeof checkboxNameOrValue == "string"
                      ? isChecked(checkboxNameOrValue) : checkboxNameOrValue;
    if (!checked && hide)
    {
        var targets = document.querySelectorAll(lector);
        for (var i = 0; i < targets.length; i++)
            targets[i].classList.add("hidey" + (suffix || ""));
    }
    else if (checked && !hide)
    {
        var targets = document.querySelectorAll(lector);
        for (var i = 0; i < targets.length; i++)
            targets[i].classList.remove("hidey" + (suffix || ""));
    }
}

// Show/hide all rockets according to the current checkbox settings.
function filtrate(doNotSetCookie)
{
    // There are two types of filter categories: inclusive and exclusive.
    // "Inclusive" means that a case may qualify for more than one selection,
    // like both midweight and heavyweight, or both USA and New Zealand, and
    // any one match qualifies.  The only way to make this work is for each
    // inclusive criterion to have its own separate CSS class for hiding things.
    // "Exclusive" criteria are ones where one article cannot have two values.
    // Technically any category could be inclusive, as each article can cover
    // more than one item, and those items can disagree.  But for some categories,
    // we've arbitrarily defined them to apply to the group as a whole: common vs
    // rare and reusable vs expendable apply to the commonest and most reusable
    // of the group.  Crew-capable vs sat-only is exclusive, as is fuel.  (In the
    // past, both of these had one special-case exception when the GSLV Mark III
    // was grouped into the same article as the classic GSLV.  That needed some
    // hacks.)  Governmental vs private is exclusive; commercialization applies
    // to the most commercial of the group.

    // order of operations matters... first, show exclusive selections
    ch(".spend", "expendable", false);
    ch(".reuse", "reusable", false);
    ch(".pop", "regular", false);
    ch(".rare", "rare", false);
    ch(".nocomm", "govx", false);
    ch(".commz", "govc", false);
    ch(".comm", "comm", false);
    ch(".solid", "solid", false);
    ch(".golic", "golic", false);
    ch(".cryo", "cryo", false);
    ch(".astro", "astro", false);
    ch(".brave", "brave", false);
    ch(".sat", "sat", false);
    // hide inclusive nonselections
    ch(".usa", "usa", true, "Nation");
    ch(".eu, .britain, .spain, .romania, .germany, .nether", "eu", true, "Nation");
    ch(".rus, .ukraine", "rus", true, "Nation");
    ch(".china", "china", true, "Nation");
    ch(".japan, .india, .newzealand, .israel, .iran, .northkorea, .southkorea, .taiwan, .australia", "other", true, "Nation");
    ch(".light", "light", true, "Size");
    ch(".medium", "medium", true, "Size");
    ch(".heavy", "heavy", true, "Size");
    ch(".superheavy", "superheavy", true, "Size");
    // show inclusive selections
    ch(".light", "light", false, "Size");
    ch(".medium", "medium", false, "Size");
    ch(".heavy", "heavy", false, "Size");
    ch(".superheavy", "superheavy", false, "Size");
    ch(".usa", "usa", false, "Nation");
    ch(".eu, .britain, .spain, .romania, .germany, .nether", "eu", false, "Nation");
    ch(".rus, .ukraine", "rus", false, "Nation");
    ch(".china", "china", false, "Nation");
    ch(".japan, .india, .newzealand, .israel, .iran, .northkorea, .southkorea, .taiwan, .australia", "other", false, "Nation");
    // hide exclusive nonselections
    ch(".astro", "astro", true);
    ch(".brave", "brave", true);
    ch(".sat", "sat", true);
    ch(".solid", "solid", true);
    ch(".golic", "golic", true);
    ch(".cryo", "cryo", true);
    ch(".nocomm", "govx", true);
    ch(".commz", "govc", true);
    ch(".comm", "comm", true);
    ch(".rare", "rare", true);
    ch(".pop", "regular", true);
    ch(".reuse", "reusable", true);
    ch(".spend", "expendable", true);

    // remember the checkbox state
    if (!doNotSetCookie)
        document.cookie = "filter=" + encodeFilters() + "; SameSite=strict; Path=/";
    // displayFilters is defined only for the new format, in rockets_nav.js
    if (typeof displayFilters == "function")
        displayFilters();   // TODO: use an event instead
    // window.dispatchEvent(filtersChanged);
}

// This must accurately model the form's grouping of checkboxes, so
// we can save and restore their state with a session cookie.
var filtersets = {
    capacity:  ["light", "medium", "heavy", "superheavy"],
    crewed:    ["sat", "brave", "astro"],
    fuel:      ["solid", "golic", "cryo"],
    frequency: ["regular", "rare"],
    reuse:     ["expendable", "reusable"],
    creator:   ["govx", "govc", "comm"],
    origin:    ["usa", "rus", "china", "eu", "other"]
};

var defaultCookie = "";

function packSet(set)
{
    var ret = 0;
    for (var ch in filtersets[set])
        ret = 2 * ret + (isChecked(filtersets[set][ch]) ? 1 : 0);
    return ret;
}

function unpackSet(set, val)
{
    for (var i = filtersets[set].length - 1; i >= 0; i--)
    {
        SetCheck(filtersets[set][i], !!(val & 1));
        val >>= 1;
    }
}

// serialize the state of the filters into a short string for persistence
function encodeFilters()
{
    // Our encoding is alphanumeric base 32, so five digits support up to 25 checkboxes.
    var digits = [ packSet("capacity"),         // one bit unused
                   (packSet("crewed") << 2) + packSet("frequency"),
                   (packSet("fuel")   << 2) + packSet("reuse"),
                   packSet("creator"),          // two bits unused
                   packSet("origin") ];
    var ret = "";
    for (var d in digits)
        ret += String.fromCharCode(digits[d] > 9 ? digits[d] + 87 : digits[d] + 48);
    return ret;
}

function decodeFilters(code)
{
    if (!code || code.length < 5)
        return;
    var digits = [];
    for (var i = 0; i < code.length; i++)
        digits.push(code[i] >= 'A' ? code.toLowerCase().charCodeAt(i) - 87 : code.charCodeAt(i) - 48);
    unpackSet("capacity",  digits[0]);
    unpackSet("crewed",    digits[1] >> 2);
    unpackSet("frequency", digits[1] & 3);
    unpackSet("fuel",      digits[2] >> 2);
    unpackSet("reuse",     digits[2] & 3);
    unpackSet("creator",   digits[3]);
    unpackSet("origin",    digits[4]);
}

function restoreFromCookie()
{
    var cookie = document.cookie.match(/(^|;\s*)filter=([^;]*)/);
    if (cookie && cookie.length > 2)
        decodeFilters(cookie[2]);
    else if (defaultCookie)
        decodeFilters(defaultCookie);
    filtrate(true);
    // the old tall-page version had a second cookie for showing and hiding sections
}

window.addEventListener("DOMContentLoaded", restoreFromCookie);


// Show or hide a stage detail table -- the one common piece unrelated to filters.
//
// Using display: none provoked a layout bug in firefox with the absolutely positioned TH column,
// so we use max-height: 0 with overflow-y: hidden instead.  Using max-height: 44em instead of
// height: auto allows us to animate the transition.  The actual height is somewhat less, but it
// doesn’t vary much, so we don’t need a ton of margin to make it safe to set a max.
function unfold(section, toggler)
{
    var sec = document.getElementById(section);
    if (sec.style.maxHeight.substring(0, 1) == "0")
    {
        sec.style.maxHeight = "44em";           // actual height is < 40em, varying a bit
        toggler.innerHTML = "[Hide stages]";
    }
    else
    {
        sec.style.maxHeight = "0";
        toggler.innerHTML = "[Show stages]";
    }
}
