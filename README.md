# Rockets of Today source code

This is the PHP source code for a portion of my personal website which is called Rockets of Today, which contains articles about rockets and spacecraft.
Similarly to my other website, Cape Jeer, I am releasing the PHP and JS source code without releasing any of the article content of the live site.
This is a simpler implementation than Cape Jeer, using only a single PHP file.
The site’s implementation changed over the years, with early versions being implemented using SHTML, and rendering as a single tall page with openable subsections.
The current version is grouped into chronological sections, with articles within each section being selectable by a tabbed UI.
The tabs can use my SPARE library to swap content via AJAX, but have fallbacks for traditional navigation.
Some pages stand on their own.
It has a somewhat responsive layout usable on small devices.

Once I had shared the code to Cape Jeer, I decided to also make the PHP and other code of this area open-source so that others could make sites with similar features, and that’s what’s in this repo.
Note that it includes only the code (and a stylesheet) — not any of the site content displayed by the code.
If you run a local instance, you will get lots of broken links.
Note also that the code can reference a comments feature, but does not incorporate it.
You can license the commenting system I used at commentics.com.

The license is that the source code included here is freely usable without restriction.
This permission does not extend to any content hosted by paulkienitz.net which is absent here.
All of the articles there retain full copyright by their author, Paul Kienitz.
