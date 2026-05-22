<?php include('partials/menu.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weii Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="" type="image/x-icon">
    <style>
        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-size: 18px;
}
/* .navbar {
    border-bottom: 2px solid black;
} */
.navbar-nav a {
   font-weight: 700;
}
.nav-link:hover{
    background-color: #EEEEEE;
    color: black;
}

/* main section */
/* cover image */

#coverCarousel .section-padding{
    padding: 100px 0;
}
#coverCarousel .carousel-item{
    height: 100vh;
    min-height: 300px;
}
#coverCarousel .carousel-caption{
    bottom: 220px;
    z-index: 2;
}
#coverCarousel .carousel-caption h5{
    font-size: 45px;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-top: 25px;
}
#coverCarousel .carousel-caption p{
    width: 60%;
    margin: auto;
    font-size: 18px;
    line-height: 1.9;
}
#coverCarousel .carousel-inner::before{
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}
#coverCarousel .navbar-nav a{
    font-size: 15px;
    text-transform: uppercase;
    font-weight: 500;
}
#coverCarousel .w-100{
    height: 100vh
}
@media only screen and (min-width:768px) and (max-width: 991px){
    .carousel-caption{
        bottom: 370px;

    }
    .carousel-caption p{
        width: 100%;
    }
}
@media only screen and (max-width:767px){
    .navbar-nav{
        text-align: center;
    }
    .carousel-caption{
        bottom: 100px;
    }
    .carousel-caption h5{
       font-size: 17px;
    }
    .carousel-caption a{
        padding: 10px 15px;
    }
    .carousel-caption p{
        width: 100%;
        line-height: 1.6;
        font-size: 12px;
    }
}

/* promos and announcement section */
.announcement h1{
    font-size: 2.5rem;
    font-weight: 700;
    color: black;
    text-align: center;
}

/* mini carousel with links to menu*/
#miniCarousel {
    max-width: 75%;
    margin: auto;
    width: 100%;
    height: auto;
    border: 2px solid #000; /* Adjust border color and width as needed */
    border-radius: 10px; /* Optional: Add border-radius for rounded corners */
    overflow: hidden; /* Ensure the border is not affected by the carousel's shadow */
}

.main h1{
    font-size: 3rem;
    font-weight: 700;
    color: black;
    text-align: left;
}
.main h2{
    font-weight: 700;
    text-align: left;
}
.main p{
    text-align: left;
}

/* review section */
.review h1{
    font-weight: 700;
    color: black;
    text-align: center;
}
.review h3{
    font-weight: 700;
    text-align: center;
}


/*our story page */
.timeline {
    border-left: 1px solid hsl(0, 0%, 90%);
    position: relative;
    list-style: none;
  }
  
  .timeline .timeline-item {
    position: relative;
  }
  
  .timeline .timeline-item:after {
    position: absolute;
    display: block;
    top: 0;
  }
  
  .timeline .timeline-item:after {
    background-color: hsl(0, 0%, 90%);
    left: -38px;
    border-radius: 50%;
    height: 11px;
    width: 11px;
    content: "";
  }

  .timeline img {
    max-width: 30%;
    margin: auto;
    width: 100%;
    height: 100%;
    border: 2px solid #000; /* Adjust border color and width as needed */
    border-radius: 10px; /* Optional: Add border-radius for rounded corners */
    overflow: hidden; /* Ensure the border is not affected by the carousel's shadow */
  }

  .storydesc{
    max-width: 75%;
    margin: auto;
    width: 100%;
    height: 100%;
    border: 2px solid #000; /* Adjust border color and width as needed */
    border-radius: 10px; /* Optional: Add border-radius for rounded corners */
  }

  .ourstory h1{
    font-size: 2.5rem;
    font-weight: 700;
    color: black;
    text-align: center;
}

    </style>
</head>
<body>


<!-- our story -->
<section class="ourstory" id="ourstory">
    <div class="container py-5">
        <div class="row py-5 mt-5">
            <h1>Our Story</h1><hr/>
          

            <div class="col-lg-12 my-5">
                <p class="text-center" style="font-weight: 700;">weii? well? weee? waiii? why?🤔😆</p>
                    
                <p class="text-center">
                    Weii cafe, when broken down, is we and ii, symbolizing two people, meeting and partying.<br>
                    喂wei (ʋɛi̯) . It means hello in Chinese and is the common first word we use to talk to friends and family on the phone.<br>
                    
                    We hope that weii cafe will be the first place you think of on the phone for jio 'yamcha' when you want to meet up.<br><br>
                    
                    weii~ Nice to meet you☺️</p>
            </div>
    
        </div>
    </div>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Milestones</h1>
<!-- Section: Timeline -->
<section class="py-5">
    <ul class="timeline">
      <li class="timeline-item mb-5">
        <h5 class="fw-bold">We are officially launched on 25th July 2022 !! </h5>
        <p class="text-muted mb-2 fw-bold">25 July 2022</p>
        <p class="text-muted">
            Our story began on Monday, July 25th, with the official launch of Weii Café. 
            Since then, we've been dedicated to crafting memorable experiences centered around delicious food and beverages. 
            With a commitment to innovation and community, we continue to evolve, grateful for the support of our patrons. 
        </p>
        <div class="timeline">
        <img src="img/weiicafe_story.jpg" class="img-fluid" alt="Responsive image">
       </div><hr/>
      </li>
  
      <li class="timeline-item mb-5">
        <h5 class="fw-bold">New menu design</h5>
        <p class="text-muted mb-2 fw-bold">6 August 2022</p>
        <p class="text-muted">
            We are pleased to introduce our 𝗡𝗘𝗪 𝗠𝗘𝗡𝗨 design.
            ꜰɪʀꜱᴛ ᴏꜰ ᴀʟʟ， ᴡᴇ ᴡᴏᴜʟᴅ ʟɪᴋᴇ ᴛᴏ ᴛʜᴀɴᴋ ᴏᴜʀ ʙᴇʟᴏᴠᴇᴅ ᴄᴜꜱᴛᴏᴍᴇʀꜱ ᴄᴏᴍɪɴɢ ᴛᴏ ᴡᴇɪɪ ᴄᴀꜰᴇ．🥰🥰
            --
            we have received a lot of valuable comments and feedback during our first week of operation. After consideration, we have decided to add new items and change the portion sizes to meet the needs of our customers. We also tried to improve the cooking techniques and speed of our existing menu.
            We look forward to giving you a better experience and providing you with better service.
        </p>
        <div class="timeline">
            <img src="img/weiicafe_story3.jpg" class="img-fluid" alt="Responsive image">
           </div><hr/>

      </li>
  
      <li class="timeline-item mb-5">
        <h5 class="fw-bold">We finally have an exclusive parking space!</h5>
        <p class="text-muted mb-2 fw-bold">10 August 2022</p>
        <p class="text-muted">
            We finally have an exclusive parking space!
            .....
            We clearly understand that our cafe is located in a location where it is more difficult to find a parking space. We often receive feedback from customers that they can't find parking, and we are actually in the process of preparing for it at the moment. Just today we officially got the right to use the private parking space located in front of the store!
            
            This is a private parking space exclusively for weii cafe customers! We look forward to seeing you all!
            
            If you think it's still hard to find a parking space? No problem! If you spend more than RM50, we are now offering FREE 🆓 delivery service if you are within 2km from weii cafe!
        </p>
        <div class="timeline">
            <img src="img/weiicafe_story4.jpg" class="img-fluid" alt="Responsive image">
           </div><hr/>
      </li>
  
      <li class="timeline-item mb-5">
        <h5 class="fw-bold">We are on GrabFood Now!!</h5>
        <p class="text-muted mb-2 fw-bold">7 July 2023</p>
        <p class="text-muted ">
            Weii Café is now live on GrabFood! This exciting milestone brings our delectable delicious food and beverages directly to our customers' fingertips, 
            offering convenient delivery options for those craving a taste of our culinary creations. 
            We're thrilled to partner with GrabFood to make our menu accessible to even more food enthusiasts, ensuring that everyone can savor the 
            flavors of Weii Café with ease.
            <div class="timeline">
                <img src="img/grab_food.jpg" class="img-fluid" alt="Responsive image">
               </div>
        </p>
      </li>
    </ul>
  </section>
  <!-- Section: Timeline -->
        </div>
    </div>
</div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>