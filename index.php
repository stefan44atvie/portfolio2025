<?php 
// ini_set(option: 'display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    include "components/inc/functions.php";
    
    // $mydate = "2025-09-02 20:35:00";

    // $mydateNew = DatumAusgabe($mydate);
    // $myTimeNew = TimeAusgabe($mydate);

?>

<!DOCTYPE html>
<html lang="de">
<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Files Links -->
  <link rel="stylesheet" href="components/css/portfolio_general.css">
  <link rel="stylesheet" href="components/css/portfolio_fonts.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<!-- /* Google tag (gtag.js) */
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5DCMVFF9F1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-5DCMVFF9F1');
    </script>
 /* Google tag (gtag.js) */ -->

  <!-- Title -->
  <title>My Agency 2025</title>
</head>
<body class="genbody">
    <?php include('components/inc/mainmenu.php'); ?>
   <div id="portfolio_startscreen">
        <div id="pf_starttext1">
            <h2 class="pf_text1 display-4">Stefan Rüdenauer</h2>
        </div>
        <div id="pf_starttext2">
            <br>
            <h1 class="pf_text1 display-2 fw-bold text-uppercase">FullStack Web development</h1>
        </div>
        <div id="cta_button" class=" fixed-bottom">
            <a class="btn btn-primary btn-lg btn-rounded" href="#portfolio_projects" role="button" data-mdb-ripple-init>Check my
        projects<i class="fas fa-angle-down ms-2"></i></a>
        </div>
   </div>
   <div id="portfolio_offers">
        <div class="portfolio_title">
            <h4 class="title_text">
                My offers
            </h4>
        </div>
        <div class="portfolio_text">
            <p class="pf_text">
                As a dedicated FullStack Web Developer, I am committed to meeting your requirements and delivering an exceptional and responsive website tailored to your business needs.
            </p>
        </div>     
        <div class="offers_content">
            <div id="box_fullstack">
                <h3 class="box_title">Fullstack Webdevelopment</h3>
                <p class="pf_text">
                The forthcoming website will meet all the necessary requirements and can be displayed on all mobile devices.
                </p>
            </div>
            <div id="box_socialmedia">
                <h3 class="box_title">Social Media Management</h3>
                <p class="pf_text">
                Digitale Seele assumes control of the playback of Texts and Media through various Social Media Platforms.
                </p>
            </div>
            <div id="box_photo">
                <h3 class="box_title">Photographer</h3>
                <p class="pf_text">
                    If required, I can personally capture all the necessary images for your website using my own equipment. You can view my photographic work on <a href="https://www.sfr-fotografie.at" target="_blank">this website</a>. All the images on this website were taken by me.                
                </p>
            </div>
        </div>
             
   </div>
   <div id="portfolio_myskills">
        <div class="portfolio_title">
            <h4 class="title_text">
                My skills
            </h4>
        </div>
        <div class="skills_content">
            <div class="skillbox box_shadow"> 
                <div class="skill_image">
                    <img src="components/media/skills/logo-2582748_1280_html.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">HTML</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/css.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">CSS</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/mysql.svg" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">MySQL</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/icons8-php-50.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">PHP</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/icons8-javascript-50.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">JavaScript</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/icons8-typescript-50.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">Typescript</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/icons8-angularjs-48.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">Angular</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/icons8-api-30.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">API</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/icons8-symfony-48.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">Symfony</a>
                </div>
            </div>
            <div class="skillbox box_shadow">
                <div class="skill_image">
                    <img src="components/media/skills/icons8-bootstrap-48.png" width="50" alt="no picture">
                </div>
                <div class="skill_text">
                    <a class="myskills_text">Bootstrap</a>
                </div>
            </div>
        </div>
   </div>
   <div id="portfolio_projects">
        <div class="portfolio_title">
            <h4 class="title_text">
                My projects
            </h4>
        </div>
        <div id="projects_area">
            <div class="portfolio_project">
                <div class="projectintro_image text-center">
                    <img src="components/media/projectimages/w4_25_1.jpg" class="img-fluid" width="200" alt="Portalbild 1">
                </div>
                <button type="button" class="btn btn-primary mx-auto d-block" data-bs-toggle="modal" data-bs-target="#w4tourproject1">
                        Zu den Projektdetails...
                </button>
            </div>
            <div class="portfolio_project">
                <button type="button" class="btn btn-primary mx-auto d-block" data-bs-toggle="modal" data-bs-target="#projekt2">
                        Zu den Projektdetails...
                </button>
            </div>
            <div class="portfolio_project">
                <button type="button" class="btn btn-primary project1 mx-auto d-block" data-bs-toggle="modal" data-bs-target="#w4tourproject1">
                        Zu den Projektdetails...
                </button>
            </div>
            <div class="portfolio_project">
                <button type="button" class="btn btn-primary project1 mx-auto d-block" data-bs-toggle="modal" data-bs-target="#w4tourproject1">
                        Zu den Projektdetails...
                </button>
            </div>
            <div class="portfolio_project">
                <button type="button" class="btn btn-primary project1 mx-auto d-block" data-bs-toggle="modal" data-bs-target="#w4tourproject1">
                        Zu den Projektdetails...
                </button>
            </div>
            <div class="portfolio_project">
                <button type="button" class="btn btn-primary project1 mx-auto d-block" data-bs-toggle="modal" data-bs-target="#w4tourproject1">
                        Zu den Projektdetails...
                </button>
            </div>
        </div>
            <!-- Modal zu aktuellsten w4tour-Mitgliederbereich-Projekt -->
            <!-- Modal -->
            <div class="modal modal-lg fade" id="w4tourproject1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Upgraded Version of the members' area of the association <a href="https://www.w4tour.at" target="_blank">w4tour</a></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="projectimages">
                                <img src="components/media/projectimages/w4_25_1.jpg" class="w-100" alt="" />
                            </div>
                            <a class="pf_text_projects">
                                The W4Tour member portal had been undergoing a comprehensive redevelopment aimed at significantly enhancing the user experience and incorporating advanced functionalities. This initiative places particular emphasis on optimizing display and usability across mobile platforms, modernizing the portal's infrastructure, and ensuring its scalability and adaptability for future requirements.
                            </a>
                            <br>
                            <br>
                            <h5>Features</h5> 
                            <p class="pf_text_projects">
                                <ul>
                                    <li><span class="bold_text">Registration</span>: Accessible exclusively to verified members.</li>
                                    <li><span class="bold_text">Member Overview</span>: A graphical representation of all registered members.</li>
                                    <li><span class="bold_text">News Section</span>: Updates and information related to the Waldviertel region and the W4Tour association.</li>
                                    <li><span class="bold_text">Media galery</span>: The media gallery provides members with access to shared photos and videos from past events and activities. It serves as a visual archive that captures the community spirit and memorable moments of the W4Tour association.</li>
                                    <li><span class="bold_text">Calendar</span>: A comprehensive overview of upcoming events, regular meetings, birthdays, and other important dates.</li>
                                    <li><span class="bold_text">Download Area</span>: Centralized access to relevant documents and informational materials.</li>
                                    <li><span class="bold_text">Club Apparel</span>: Members can place orders or express interest in official club clothing.</li>
                                    <li>“<span class="bold_text">Be Active</span>” Section:
                                        <ul>
                                            <li>Evaluation of past events.</li>
                                            <li>Upload of images.</li>
                                            <li>Submission of new ideas and suggestions for the portal.</li>
                                            <li>Recommendation of new venues for regular meetups.</li>
                                        </ul>
                                    </li>
                                </ul>
                            </p>
                            
                            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="4000">
                                        <img src="components/media/projectimages/w4_25_1.jpg" class="d-block w-100" alt="Portalbild 1">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000">
                                        <img src="components/media/projectimages/w4_25_2.jpg" class="d-block w-100" alt="Portalbild 2">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000">
                                        <img src="components/media/projectimages/w4_25_3.jpg" class="d-block w-100" alt="Portalbild 3">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal zu aktuellsten w4tour-Mitgliederbereich-Projekt -->
             <!-- Modal zu aktuellsten Projekt 2 -->
            <!-- Modal -->
            <div class="modal modal-lg fade" id="projekt2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            HAHAHAHAAHAHAHAHAHAHA Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam amet sed vero animi velit, voluptatum inventore quam, ipsum illo quaerat repellat aperiam explicabo rerum accusantium, alias ea totam temporibus quasi.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal zu aktuellsten w4tour-Mitgliederbereich-Projekt -->
   </div>
   <div id="portfolio_aboutme">
        <div class="portfolio_title">
            <h4 class="title_text">
                About me/Contact
            </h4>
            <div id="pf_aboutarea">
                <div id="personal_box" class="box_shadow">
                    <h4 class="title_text">
                        Stefan Rüdenauer
                    </h4>
                    <p class="pf_text">
                        Throughout my teenage years, I have nurtured a profound interest in the fields of computer and technology. Consequently, after completing my three-year university studies, I made the decision to pursue an education in Industrial Engineering and Information Technology at the Technical University of Vienna (TGM). In 2023, I further advanced my professional development by graduating as a FullStack Web Developer at CodeFactory.
                        Should you be interested in collaborating on a project with me, I invite you to contact me via the email address <span class="blue_contact">webdesign (at) digitaleseele (dot) at</span>.
                    </p>
                </div>
                <div class="bg-image" id = "personal_image">
                    <img src="https://webdesign.digitaleseele.at/images/stefan.jpg" class="w-100" alt="" />
                </div>
            </div>
        </div>
   </div>
   <div id="portfolio_impressum">
        <div class="portfolio_title">
            <h4 class="title_text">
                Impressum
            </h4>
                <div id="impressum_box" class="box_shadow">
                   <p class="pf_text_impressum">
                        Stefan Rüdenauer
                        <br>
                        WebDesign Digitale Seele
                        <br>
                        Jedleseer Straße 4/2/5
                        <br>
                        1210 Wien
                    </p>
                    <h5 class="impressum_title">Kontakt</h5> 
                    <p class="pf_text_impressum">
                        Telefon: +436644342127
                        <br>
                        E-Mail: office@digitaleseele.at
                    </p>
                    <h5 class="impressum_title">Redaktionell verantwortlich</h5> 
                    <p class="pf_text_impressum">
                        Stefan Rüdenauer
                        <br>
                        Jedleseer Straße 4/2/5
                        <br>    
                        1210 Wien
                    </p>
                    <h5 class="impressum_title">EU-Streitschlichtung</h5>
                    <p class="pf_text_impressum">
                        Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: https://ec.europa.eu/consumers/odr/.
                        Unsere E-Mail-Adresse finden Sie oben im Impressum.
                    </p>
                    <h5 class="impressum_title">Verbraucher­streit­beilegung/Universal­schlichtungs­stelle</h5>
                    <p class="pf_text_impressum">
                        Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
                        <br>
                        Quelle: e-recht24.de
                    </p> 
                </div>
        </div>
   </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="components/inc/menu_active.js"></script>
</body>
</html>