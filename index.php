<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script defer src="index.js"></script>
    <title>Online Vote</title>
</head>
<body>
    <!--------------------
        Header Section
    ---------------------->
    <header class="header">
        <div class="logo_container">
          <img src="image/logo2.png" alt="LOGO" class="logo">
        </div>
        <nav class="navbar">
            <div>
                <ul class="navbar_list">
                    <li>
                        <a class="navbar_link" href="">Home</a>
                    </li>
                    <li>
                        <a class="navbar_link" href="">Contact</a>
                    </li>
                    <li>
                        <a class="navbar_link" href="">About</a>
                    </li>
                    <li>
                        <a class="navbar_link" href="">Help</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="login">
            <ul class="login_list">
                <li>
                    <a class="navbar_link" href="login.php">Sign In</a>
                </li>
                <li>
                    <a class="signup" href="registration.php">Sign Up</a>
                </li>
            </ul>
        </div>
        <div class="mobile_navbar_btn">
            <ion-icon name="menu-outline" class="mobile_navbar_icon"></ion-icon>
            <ion-icon name="close-outline" class="mobile_navbar_icon"></ion-icon>
        </div>
    </header>
    <!--------------------
        Main Section
    ---------------------->
    <main>
        <section class="section section_main" id="section_main">
            <div class="container grid grid_two_column">
                <div class="section_main_data">
                    <h1 class="main_heading">Online Voting</h1>
                    <p>Online voting systems offer a number of advantages over traditional paper ballots, such as increased efficiency, improved accuracy, greater voter engagement, and better security. With online voting systems, the voting process can be completed quickly and securely, eliminating the need for paper ballots and making the process more efficient. Additionally, the accuracy of the vote is improved, as online voting systems are designed to ensure that each vote is counted correctly and securely. Additionally, online voting systems can increase voter engagement, as they make it easier for people to access information about the voting process and cast their votes from any location. Finally, online voting systems are more secure than traditional paper ballots, as they are designed to prevent fraud and tampering.</p>
                    <div class="btn_section">
                        <a href="#" class="btn">Learn More</a>
                        <a href="#" class="btn">Get Start <span><ion-icon name="arrow-forward-outline"></ion-icon></span></a>
                    </div>
                </div>
                <div class="section_img">
                    <img class="main_img" src="image/4428.jpg" alt="">
                </div>
            </div>
        </section>
    </main>
    <!--------------------
        Need Info Section
    ---------------------->
    <section class="section section_need" id="section_need">
        <div class="container grid grid_two_column">
            <div class="section_img">
                <img class="main_img" src="image/6383.jpg" alt="">
            </div>
            <div class="section_data">
                <h2 class="need_heading">Why Need</h2>
                <p class="need_list">
                Online voting systems provide an efficient and secure way to cast votes in an election. By using online voting systems, citizens can cast their votes from any location, eliminating the need to travel to the polling place. Additionally, online voting systems provide a higher level of accuracy and transparency, as they are able to record votes in real-time and can be easily audited. Furthermore, they provide a secure voting process, as votes are encrypted and stored on a secure server. Finally, online voting systems make it easier for citizens with disabilities or mobility issues to participate in the voting process.
</p>
            </div>
        </div>
    </section>
    <!--------------------
        Intruction Info Section
    ---------------------->
    <section class="section section_intru" id="section_intru">
        <div class="container grid grid_two_column">
            <div class="section_data">
                <h2 class="intru_heading">Instruction</h2>
                <ul class="need_list">
                    <li>Register or log in yourself.</li>
                    <li>Wait for verification and once verified you are eligible to vote.</li>
                    <li>Select an event to caste your valuable vote.</li>
                    <li>Click to the vote button beside your desirable option or candidate.</li>
                    <li>Finally your vote to your desirable candidate will be added.</li>
                    <!-- <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis.</li> -->
                </ul>
            </div>
            <div class="section_img">
                <img class="main_img" src="image/6383.jpg" alt=""><!--video-->
            </div>
        </div>
    </section>
        <!--------------------
        Footer Section
    ---------------------->
    <footer class="section footer">
        <div class="footer_section container grid grid_three_column">
            <div class="section_footer_about">
                <h3>About</h3>
                <p>We offer an innovative online voting system that empowers individuals and organizations to express their opinions easily and securely. With our user-friendly interface and robust security measures, we make it simple to make your voice heard and contribute to important decision-making processes. Join us and let your opinion count.</p>
            </div>
            <div class="section_footer_service">
                <h3>Services</h3>
                <ul>
                    <li>
                        <a href="">Govt.</a>
                    </li>
                    <li>
                        <a href="">private</a>
                    </li>
                    <li>
                        <a href="">organizer</a>
                    </li>
                </ul>
            </div>
            <div class="section_footer_help">
                <h3>Help</h3>
                <address>
                    <div>
                        <p>
                            <span><ion-icon name="location-outline"></ion-icon></span>
                            Kolkata, India
                        </p>
                    </div>
                    <div>
                        <p>
                            <span><ion-icon name="call-outline"></ion-icon></span>
                            <a href="">+91 8013070719</a>
                        </p>
                    </div>
                    <div>
                        <p>
                            <span><ion-icon name="mail-unread-outline"></ion-icon></span>
                            <a href="">abinashch200@gmail.com</a>
                        </p>
                    </div>
                </address>
            </div>
        </div>
        <div class="container">
            <div class="footer_social_media">
                <a href="">
                    <ion-icon class="icons" name="logo-whatsapp"></ion-icon>
                </a>
                <a href="">
                    <ion-icon class="icons" name="logo-youtube"></ion-icon>
                </a>
                <a href="">
                    <ion-icon class="icons" name="logo-linkedin"></ion-icon>
                </a>
                <a href="">
                    <ion-icon class="icons" name="logo-facebook"></ion-icon>
                </a>
            </div>
            <div class="footer_credits">
                <p>Copyrright© 2023 All rigths reverved</p>
            </div>
        </div>
    </footer>
</body>
</html>