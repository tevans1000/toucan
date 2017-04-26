ToucanTech coding challenge - submission by Thomas Evans
======================================================================

Brief
----------------------------------------------------------------------
The ToucanTech database stores information about its members. Each
member can be associated with 1 or more school.
You should build a demo that allows someone to add a new member with
the fields “Name”, “Email Address” and "School" (selected from a
list). The demo should display all members for a selected school.

Setting up
----------------------------------------------------------------------
The weberver used for development was a WAMP stack:
  * Windows 7
  * Apache 2.4.23
  * MySQL 5.7.14
  * PHP 7.0.10
It will probably work on a LAMP stack too.

###  Initialising the database  ######################################
Run the `toucan_tevans.sql` script in `mysql` (or PHPMyAdmin). This
creates a database with the name `toucan_tevans` and all its tables,
populates the `schools` table and creates a user named `toucan`
authorised by password.

###  Web root  #######################################################
The web root should be `www`. The only file in this directory is
`index.php`. All other files should not be publicly visible.

Notes on usage / assumptions
----------------------------------------------------------------------
BootStrap has been used to enhance the page's appearance and to make
it responsive. JavaScript must be enabled for this to work correctly.

Each member has a unique email address. If registration is attempted
with an existing email address, then the submitted name is compared to
the name in the database. If a different name has been submitted then
registration fails. If the names are the same or if no name was
submitted then any new school memberships are added and old school
memberships are unaffected.

It is assumed that the number of schools is small enough to reasonably
fit on 1 page or in a `<select>` element.

It is assumed that the number of members is small enough that the list
of members does not require pagination.