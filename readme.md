Digital Government Strategy Report Generator
===========================================

Generates reports to describe agencies' progress in realizing the goals of the President's Digital Government Strategy

Goals
----------

The President's Digital Strategy requires each agency to report progress on the document's goals at /digitalstrategy of their primary domain. This open-source project seeks to simplify that process and provide agenceis with a turn-key solution to generate such reports.

Non-Government Developers
-------------------------
The [agency list and report schema](https://github.com/GSA/digital-strategy) this project are based off of, as well as it's underlying code could be used to build tools that aggregate agencies' progress, or for example, centralize the various APIs and datasets released as a result of the process.

Requirements
------------

* PHP (e.g., LAMP, XAMPP, MAMP, etc.)
* The /tmp/ must be writable by PHP (`chmod 0777 /tmp/` works well)

Usage
-----

Load index.php in your favorite HTML5 web browser

How it Works
------------

The first time you load index.php, the generator will make a call to [two JSON files hosted in GSA's GitHub repository](https://github.com/GSA/digital-strategy). These files contain the schema which defines the report, as well as a list of federal agencies and their common abreviations. These files will be cached locally to disk and will remain there for up to an hour.

It will then spit out a simple form representing the fields as described in the schema file. Upon submitting the form, you will recieve a valid HTML, XML, and JSON repreentation of your responses. The JSON and XML versions are designed to be placed, as is, at agency.gov/digitalstrategy.xml and agency.gov/digitalstrategy.json. The HTML version is designed to be pasted into a CMS or used as is.

Previously generated reports can be update via the import function at the top of the form.

Contributing
------------

Federal employees and members of the public are encouraged to contribue to the project by forking and submitting a pull request. All code must be licensed to the public under GPLv2 or later.

License
-------

This project constitutes a work of the United States Government and is 
not subject to domestic copyright protection under 17 USC § 105. 

The project utilizes code licensed under the terms of the GNU General 
Public License and therefore is licensed under GPL v2 or later.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
