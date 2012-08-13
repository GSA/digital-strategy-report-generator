Digital Government Strategy Report Generator
===========================================

Generates reports to describe agencies' progress in realizing the goals of the President's Digital Government Strategy

Goals
----------

The President's Digital Strategy requires each agency to report progress on the document's goals at /digitalstrategy of their primary domain. This open-source project seeks to simplify that process and provide agencies with a turn-key solution to generate such reports.

Non-Government Developers
-------------------------
The [agency list and report schema](https://github.com/GSA/digital-strategy) this project is based on, as well as it's underlying code could be used to build tools that aggregate agencies' progress, or for example, centralize the various APIs and datasets released as a result of the process.

Requirements
------------

* PHP (e.g., LAMP, XAMPP, MAMP, etc.)

Usage and installation
----------------------

1. Clone or extract the project into your web server's `htdocs` or `public_html` folder
2. Copy `config/config.sample.php` to `config/config.php`
2. Navigate to the project's folder in your favorite HTML5 web browser (e.g., `http://localhost/dgs/`)

Usage as a service
------------------

1. Complete step 1 above
2. POST data directly to the `index.php` file using any language or script of your choice
3. Recieve a zip file containing the generated content

How it Works
------------

The first time you load index.php, the generator will make a call to [two JSON files hosted in GSA's GitHub repository](https://github.com/GSA/digital-strategy). These files contain the schema which defines the report, as well as a list of federal agencies and their common abreviations. These files will be cached locally to disk and will remain there for up to an hour.

It will then spit out a simple form representing the fields as described in the schema file. Upon submitting the form, you will recieve a zip file download containing valid HTML, XML, and JSON representations of your responses. The JSON and XML versions are designed to be placed, as is, at agency.gov/digitalstrategy.xml and agency.gov/digitalstrategy.json. The HTML version is designed to be pasted into a CMS or used as is.  Adding a value to the DGS_REPORT_DIR constant in the load.php file will cause the script to add unzipped versions of the reports to that directory.

Previously generated reports can be updated via the import function at the top of the form.  If the DGS_REPORT_DIR constant is specified the form will automatically load values from digitalstrategy.json if it exists.

Contributing
------------

Federal employees and members of the public are encouraged to contribue to the project by forking and submitting a pull request. All code must be licensed to the public under GPLv2 or later.

Changelog
---------

### 1.0 ###
* Initial Release

### 1.1 ###
* Better PHP 5.4 compatability (removed calltime pass by reference)
* Added option to write generated file to web server for easier programatic access (props [Bill Severe](https://github.com/bsevere))
* Uses PHP's default temporary directory, rather than the `tmp/` folder within the project to generate files, simplifying installation and improving portability (props [Bill Severe](https://github.com/bsevere))
* Moved configuration to separate file to simplifying customization
* Better sorting of agencies and action items in datafiles and in the generator (props [Bill Severe](https://github.com/bsevere))
* Abilitity to bypass GitHub service and local cache to force generation of fresh datafiles
* Clarified requirements, installation instructions, and usage as a service
* Corrected typos in readme (props [Bill Severe](https://github.com/bsevere))

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
