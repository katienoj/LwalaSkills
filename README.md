# Lwala Skills Assessment Test

<a name="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/katienoj/LwalaSkills">
    <img src="Main/Layout/images/Logo.png" alt="Logo" width="80" height="80">
  </a>


<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## COMMUNITY HEALTH PORTAL
  <div align="center">
  <a href="https://github.com/katienoj/LwalaSkills">
    <img src="Main/Layout/images/screen.JPG" alt="Logo" width="800" height="400">
  </a>

[![Product Name Screen Shot][product-screenshot]](https://example.com)

# Case Study
## Part 1: Form Logic and Dashboard
The product manager reaches out to you on a requirement that will introduce approval of commodities for
Community Health Workers(CHW). The CHW will make the request and the Community Health Assistant
will approve the request and issue the commodities. The CHA. a formal employee of the County
Government, provides the link between the community and the local health facility and they are in charge of
monitoring the use of simple drugs, commodities and supplies. The CHW is the community health volunteer
or worker that distributes the commodities as per guidance provided by the Ministry of HealthFor the case
studies the commodities being considered are Malaria Drugs, Family Planning Items and Zinc Tablets.
You are required to create a simple form that allows the CHW to make a request for specific quantities of
commodities from their CHA. The form should allow for:
1. Auto selection of the CHWs supervising CHA. This means that there is a hierarchy whereby multiple
CHWs report to a CHA, and there are many CHWs and CHA combinations. Thus depending on the
CHW, the relevant CHA for approval is selected
2. Selection of the commodities to be configurable and allow for additional commodities to be added
without further changes to the form
3. Entry of the quantity being requested with relevant validation rules, i.e. it has to be whole numbers
and less than 100 at a time with a maximum of 200 requests per commodity per month per CHW
4. Submission of the request. There should only be one submission per CHW per commodity per day
5. A log of all requests made through the form
6. Simple dashboard representation of the requests that are coming through
The case study should not only include a form, but code that allows the form to be utilized to seek approval
by the user to the relevant approver, and validation rules. Should you choose to use third party integrations, a
narrative on the choice made should be in the README.md file
Commit your design and code on github or bitbucket in public mode and share for review. You should also
have a README.md file that explains how to use the code and the form.



### Built With

The following technologies have been used

* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![JQuery][JQuery.com]][JQuery-url]
* PHP
* JavaScript


<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

The following ar required to run this application
* Server version: 8.0.32-0ubuntu0.20.04.2 - (Ubuntu)
* Apache/2.4.41 or Nginx
* MySQL Database (or MariaDB)
* Linux OS (Ubuntu Server)
* PHP version: 7.4.3


### Installation

Follow the below Instructions to get the system up and running
1. Clone the repo
   ```sh
   git clone https://github.com/katienoj/LwalaSkills.git
   ```
3. Deploy using Apache or Nginx Web servers
   ```sh
   Deploy in Web Server
   ```
4. Create Database 'Lwala'
5. Import DB Scripts (lwala.sql) using either cmd prompt or Phpmyadmin
6. Create DB users
7. Go to /Main/Config/db_conn.php to change DataBase Configuration
8. Access the Home Page
    Example:LIVE SYSTEM HERE>>>>>>>>>>
                 ```sh
   git clone https://test.sorilakesidehospital.co.ke
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

