=== Universal Post Manager ===
Contributors: gVectors Team
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JHRHCQZ8N2G2W
Tags: post, save post, save post as pdf, print, pdf, xml, text, word document, doc, pdf button, print button
Requires at least: 2.7.0
Tested up to: 4.4
Stable tag: 1.5.0

Allows your visitors to print your posts content and download as PDF, Doc, TXT, HTML, XML files. 

== Description ==
Allows your visitors to print your posts content and download as PDF, Doc, TXT, HTML, XML files. This plugin adds Print, Save as PDF, MS Document, HTML, Text and XML buttons on single post page.

**Post and Pages Saving Options**

* Save as PDF file ,
* Save as XML file ,
* Save as Text file ,
* Save as HTML file ,
* Save as Word Document
* Manage Save and Print buttons displaying per post/page
* Flexible options for appearance saving and localization of buttons and strings, 
* Print Management
* Print Template settings 

Compatible with WPML. Allows to save the same content with all active languages.
Feature to Manage Saving Options By Category

For Saving WooCommerce Products as PDF, MS Doc and Printing please use this plugin:
WooCommerce PDF & Print https://wordpress.org/plugins/woocommerce-pdf-print/

== Installation ==

  * Extract "universal-post-manager.zip" archive.
  * Upload the universal-post-manager folder to the "/wp-content/plugins/" directory .
  * In your WordPress administration, go to the Plugins page.
  * Activate the Universal Post Manager plugin through the 'Plugins' menu in WordPress and a menu Post Manager  whith four submenus will appear in your admin panel menus.

== Screenshots ==

1.  Printing and Saving Button Styles (version 1.2.0) Screenshot #1
2.  Printing and Saving Icon Buttons (version 1.2.2) Screenshot #2
3.  Printing and Saving Button Styles (version 1.1.2) #3
4.  UPM buttons horizontal appearance type Screenshot #4
5.  UPM icon buttons horizontal appearance type Screenshot #5
6.  UPM buttons vertical appearance type Screenshot #6
7.  Printing and Saving buttons as simple text links Screenshot #7
8.  Saving button settings and location options Screenshot #8
9.  Print button settings and location options Screenshot #9
10.  Print button manager Screenshot #10
11.  Text button manager Screenshot #11
12.  HTML button manager Screenshot #12
13.  MS Word Document button manager Screenshot #13
14.  PDF button manager Screenshot #14
15.  XML button manager Screenshot #15

== FAQ ==

= Please Check the Following Advanced Post Pagination Resources =

* Plugin Page: <http://profprojects.com/universal-post-manager/>
* Support Forum: <http://gvectors.com/questions/>

== Changelog ==

= 1.0.0 =

Initial version.

= 1.0.1 =

* Added : Feature to set HTML filter on saving (before insert into db) or on showing (after reading from database)
* Added : Feature to set Phrase filter on saving (before insert into db) or on showing (after reading from database)
* Added : New buttons and icons for post saving
* Fixed Bug : Changing of button's url.
* Fixed Bug : Reset all of settings on new version upgrading .

= 1.0.1b =

* Fixed Bug : Problems with saving , when permalink is not default type

= 1.0.2 =

* Added : Feature to Save post and pages as PDF file ,
* Added : Feature to Save post and pages as XML file ,

= 1.0.3 =

* Fixed Bug : There was problem on some servers like this ` Warning: Invalid argument supplied for foreach() in /home/adyesha/public_html/wp-content/plugins/universal-post-manager/main.php on line 525 `
* Fixed Bug : Save as MS Word issue,
* Added : New 'Save as MS Word Document' template,
* Added : New saving buttons,
* Added : Feature to print posts and pages ,
* Added : Print Manger and Print template settings.

= 1.0.4b =

* Added : Feature to choose Microsoft Office Word or OpenOffice.org template for saving ,
* Added : Feature to Manage Saving Options By Category

= 1.0.4 =

* Fixed Bug : Issue with user roles in WPMU ,
* Fixed Bug : Issue with save as PDF document font for some languages ,
* Fixed Bug : Images loose issue in saving documents ,
* Added : Feature for putting css code to style HTML, MS Word, and Print documents ,
* Added : Social Bookmarks ( funny slider and simple types ) ,  
* Added : E-Mail This Post ( two screen types ) ,  
* Added : Subscribe via Feeds ( rdf, rss, rss2, atom ).

= 1.0.5b =

* Fixed Bug : Alpha channel not supporting in save as PDF document feature ,
* Fixed Bug : Images with external source in save as PDF document feature ,
* Fixed Bug : Wrong localization ( image as background ) of images in save as PDF document feature ,
* Fixed Bug : other bugs ,
* Added : Extension for PDF Documents in Russian Language ,
* Added : Including images (PNGs or JPGs) with alpha-channels in save as PDF document feature ,
* Added : Options to manage content of saving documents ,
* Added : Option to set alignment of saving and printing document's texts ( Arabic text's align is right ) ,
* Added : Feature to display saving, printing , email and bookmark sliders buttons together <?php upm_all() ?>,

= 1.0.6 =

* Fixed Bug : Filter and HTML manager's issues ,
* Added : Poll Manager,
* Added : Ability to set general and post/page specific polls,
* Added : HTML Manipulations ( e.g. change all link targets to new window ),

= 1.0.7 =

* Fixed Bug : HTML Tag filter, jQuery and other bugs

= 1.0.8b =

* Fixed Bug : HTML Tag filter, jQuery and other bugs

= 1.0.9 =

* Fixed Bug : Specific polls aren't beeing shown on widget
* Fixed Bug : No result after vote for specific polls.
* Fixed Bug : Infinity loading vote result 
* Fixed Bug : jQuery conflicts with WP Dashboard menus on Poll Manager admin page 
* Fixed Bug : Slow loading of Poll's Logs
* Fixed Bug : Email not send and UPM Error:128
* Fixed Bug : Fixing save/print buttons displaying on password protected posts/pages
* Added : Ability to add certain poll in certain post content (IF YOU GOING TO ADD POLLS IN POST/PAGE CONTENT YOU SHOULD REMOVE UPM-POLL WIDGET FROM YOUR SINGLE POST/PAGE SIDEBAR)
* Added : Ability to Turn on/off UPM jQuery framework loading (If you have already loaded jQuery latest vesrsion you can turn this off)
* Added : More Secure Voting
* Added : More Secure "Email this post to friends"

= 1.1.1 =

* Fixed Bug : Print password protected or not published posts
* Fixed Bug : Save as password protected or not published posts
* Fixed Bug : Email not sending issue
* Fixed Bug : Other bugs 
* Added : Ability to manage header of print document
* Added : Compatibility with Wordpress 3.2.x versions

= 1.1.2 =

* Added : More Secure
* Added : Compatibility with Wordpress 3.3.x versions

= 1.2.0 =

* Plugin has been cleared and it can only be used for printing and saving posts as PDF, MS Doc, Text, HTML, XML files.
* Added : New awesome Print and Save as PDF, MS Doc, HTML, Text, XML Buttons,
* Compatibility with Wordpress 3.9.x versions

= 1.2.1 =

* Fixed Bug : Issue with brocken paragraphs
* Fixed Bug : Prints out complete post on home and category pages instead of excerpts

= 1.2.2 =

* Compatibility with Wordpress 4.0 version
* Added : New awesome Print and Save as PDF, MS Doc, HTML, Text, XML Icon Buttons,

= 1.3.0 =

* Added : Compatible with WPML. Allows to save the same content with all active languages.
* Added : Adds Post Featured Image into saved document
* Added : Adds Post Galleries into saved document
* Added : Support all kind of Shordcodes
* Fixed Bug : Warning displayed at top of page and in page content area
* Fixed Bug : White screen on saving as PDF

= 1.3.1 =

* Added : Option to set Maximum Image Width in PDF, Doc, HTML and Print Documents
* Added : Document content filtering for unnecessary html scripts ( JavaScirp, CSS, etc... )

= 1.3.2 =

* Added : Increasing Plugin Security
* Fixed Bug : Breaks post if last item is a video

= 1.3.3 =

* Fixed Bug : Duplicated featured images
* Fixed Bug : PDF export problem when PHP 'allow_url_fopen' is off

= 1.4.0 =

* Fixed Bug : Page Not Found error on Doc, Txt, HTML and XML export
* Fixed Bug : PDF export problem with Alpha channel PNG images
* Fixed Bug : PDF export error - Missing or incorrect image file
* Fixed Bug : Print document CSS issues
* Better Fixed Bug : Duplicated featured images
* Better Fixed Bug : Again - PDF export problem when PHP 'allow_url_fopen' is off
* Added : Finds and adds images with original sizes (limited by max-size) in exported documents if you use thumbnail (150x150) in post content.

= 1.4.1 =

* Added : Option to Hide/Display Save and Print Buttons per post/page

= 1.5.0 =

* Fixed Bug : Tons of bug
* Fixed Bug : WordPress 4.4.x compatibility


