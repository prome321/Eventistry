<?php
require 'header.php'; // Include header
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventistry</title>
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   
</head>

<main>
<section class="section">
    <div class="container">
       
          
                <div class="image-container">
                    <img src="Images/event.webp" width="475px" height="540px" alt="Wedding Couple" class="img-fluid">
                </div>
          
           
                <div class="content">
                    <div class="icon">💍</div>
                    <h1>Effortless Events,<br/>Seamless Experience</h1>
                   <p> Whether it's corporate conferences, weddings, or social gatherings,<br/> we provide a hassle-free experience with real-time updates and secure bookings.</p>
                    <button class="btn btn-primary">
                        <span class="icon">📅</span>
                       <a href="event_registration.php" style="color:white;text-decoration: none;"> Make Reservations</a>
                    </button>
                </div>
            
        </div>
 
</section>




    <section class="section">
        <div class="container mt-4">
            <div class="content">
                <span>About Eventistry</span>
                <br/>
                <h1>What We do, We do With Passion</h1>
                <p>We bring your events to life with passion and precision.<br/>With Eventistry, your events are not just managed—they’re crafted with care.</p>
                <button>Learn More</button>
               
            </div>
            <div class="section-images">
                <div>
                <img src="Images/better_togather.jpg" alt="Better Together" class="image-1">
                </div>
                <div>
                    <img src="Images/roses.jpg" alt="Flowers" class="image-2">
                <img src="Images/wine.jpg" alt="Wine Glasses" class="image-3">
                </div>
             
            </div>
        </div>
       
    </section>

    <!-- Event Dashboard Section -->
<section class="event-dashboard-section">
    <div class="dashboard-banner" style="position: relative; height: 400px; overflow: hidden;"> <!-- Reduced height -->
        <img src="Images/back_sec1.jpg" alt="Event Dashboard Banner" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
        <div class="container">
            <div class="content" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                <h1>Explore Our Event Dashboard</h1>
                <p>Manage and discover events effortlessly with our powerful dashboard. Search, filter, and sort events to find exactly what you're looking for.<br/> Whether you're planning or attending, we make event management simple and seamless.</p>
                <a href="event_dashboard.php" style="text-decoration: none;">
                    <button style="
                        background-color: #ff6f61;
                        color: white;
                        border: none;
                        padding: 15px 30px;
                        border-radius: 30px;
                        font-size: 1rem;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                        margin: 0 auto; 
                    ">
                        Learn More
                    </button>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section-dashboard">
    <div class="container">
        <div class="dashboard-body">
            <div class="dashboard-product">
                <img src="Images/Design_element.png">
                <h2>Includes Various<br/>Product Categories</h2>
                <p>Explore a wide range of high-quality products, carefully curated to meet your needs.<br/>From the latest tech gadgets to stylish accessories, we have something for everyone.
                <button class="mt-4">Learn More</button>
            </div>
            <div>
                
           
        <div class="product-category mb-4 mt-4">
            <div class="row">
                <div class="col-6" >
                    <div class="card" style="width:250px">
                        <img class="card-img-top" src="Images/weddingwalls.jpg" alt="Card image" style="width:250px;align-items: center;border: 2px solid white;">
                        <div class="card-body">
                            <h4 class="card-title">Wedding Walls</h4>
      
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="width:250px">
                        <img class="card-img-top" src="Images/metal_circles-2.jpg" alt="Card image" style="width:250px;align-items: center;border: 2px solid white;">
                        <div class="card-body">
                            <h4 class="card-title">Metal Flowers</h4>
      
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <div class="card" style="width:250px">
                        <img class="card-img-top" src="Images/chair.jpg" alt="Card image" style="width:250px;align-items: center;border: 2px solid white;">
                        <div class="card-body">
                            <h4 class="card-title">Chairs</h4>
      
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="width:250px">
                        <img class="card-img-top" src="Images/catering.jpg" alt="Card image" style="width:250px;align-items: center;border: 2px solid white;">
                        <div class="card-body">
                            <h4 class="card-title">Catering</h4>
      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</section>


    <div class="container mt-4">
        <div class="next-plan">
            <div class="next-plan-image">
                <div class="row">
                 <div class="col-6 box-outer">
                    <div class="next-plan-box">
                        <div>
                            <img src="Images/sec6_guitar.png">
                        </div>
                        <div class="next-plan-content">
                        <h6>Entertaintment</h6>
                        </div>
                     </div>                    
                </div>
                 <div class="col-6 box-outer">
                    <div class="next-plan-box">
                        <div>
                            <img src="Images/dinning.png">
                        </div>
                        <div class="next-plan-content">
                        <h6>Dinning</h6>
                        </div>
                     </div>                    
                </div>
                
            </div>
                 <div class="row">
                 <div class="col-6 box-outer">
                    <div class="next-plan-box">
                        <div>
                            <img src="Images/decor.png">
                        </div>
                        <div class="next-plan-content">
                        <h6>Decor</h6>
                        </div>
                     </div>                    
                </div>
                  <div class="col-6 box-outer">
                    <div class="next-plan-box">
                        <div>
                            <img src="Images/swaggifting.png">
                        </div>
                        <div class="next-plan-content">
                        <h6>Swag & Gifting</h6>
                        </div>
                     </div>                    
                </div>
                
            </div>
                
            </div>
            <div class="next-plan-right">
                    <div class="dashboard-product">
                <img src="Images/sec6_design_element.png">
                <h2>Let’s Plan Your Next<br/> Event Together</h2>
                <p>Make your next event seamless and unforgettable.<br/>From venue selection to guest management, we’re here to bring your vision to life.</p>
                <button>Learn More</button>
            </div>

                
            </div>
            
            
        </div>
        
        
    </div>


    <?php
require 'footer.php'; 
?>






</main>

