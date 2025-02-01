<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="CSS/event_dashboard.css">
</head>
<body>
  <main>
    <div class="event-header">
      <img src="Images/sub-banner-img.jpg" alt="Event Banner">
      <h1>Event Dashboard</h1>
    </div>

    <div class="container mt-4 mb-4">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Search Bar -->
        <div class="input-group w-50 me-3">
          <input type="text" id="searchInput" class="form-control" placeholder="Search events..." oninput="handleFilters()">
        </div>

        <!-- Date Filter -->
        <input type="date" id="dateFilter" class="form-control w-auto me-3" onchange="handleFilters()">

        <!-- Time Filter -->
        <input type="time" id="timeFilter" class="form-control w-auto me-3" onchange="handleFilters()">

        <!-- Sorting Dropdown -->
        <select id="sortEvents" class="form-select w-auto" onchange="handleFilters()">
          <option value="default">Default sorting</option>
          <option value="date_asc">Date: Upcoming First</option>
          <option value="date_desc">Date: Oldest First</option>
          <option value="name_asc">Event Name: A-Z</option>
          <option value="name_desc">Event Name: Z-A</option>
        </select>
      </div>

      <div id="event-list" class="row mt-3 mb-3">
        <!-- Event cards will be dynamically added here -->
      </div>
    </div>

    <nav aria-label="Page navigation example" class="mt-4">
      <ul class="pagination justify-content-center">
        <!-- Pagination buttons will be dynamically added here -->
      </ul>
    </nav>
  </main>

  <script>
    let currentPage = 1;  // Start with page 1
    let totalPages = 1;  // Initialize total pages to 1 (will be updated after the first fetch)
    let currentSort = 'default';  // Default sorting
    let currentSearch = '';  // Default search query
    let currentDate = '';  // Default date filter
    let currentTime = '';  // Default time filter

    // Fetch events with filters
    function fetchEvents(page = 1, sort = 'default', search = '', date = '', time = '') {
      const url = `http://localhost/EventManagement/Attendee/read.php?page=${page}&sort=${sort}&search=${search}&date=${date}&time=${time}`;

      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.status === 200) {
            totalPages = data.total_pages;  // Update total pages
            displayEvents(data.data);  // Display the events
            setupPagination();  // Set up pagination controls
          } else {
            document.getElementById('event-list').innerHTML = `<p>${data.message}</p>`;
          }
        })
        .catch(error => {
          console.error('Error fetching events:', error);
          document.getElementById('event-list').innerHTML = `<p>Failed to load events. Please try again later.</p>`;
        });
    }

    // Display events
    function displayEvents(events) {
      const eventList = document.getElementById('event-list');
      eventList.innerHTML = '';  // Clear existing events

      events.forEach(event => {
        const eventCard = document.createElement('div');
        eventCard.classList.add('col-md-3');
        eventCard.innerHTML = `
          <div class="product-card">
            <div class="product-image">
              <img src="${event.event_image}" alt="${event.event_name}" width="400" height="200">
            </div>
            <h5 class="mt-3">${event.event_name}</h5>
            <a href="event_description.php?id=${event.id}" class="btn btn-primary mt-2" style="background-color: #87d3c5;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 16px;
    cursor: pointer;">See More</a>
          </div>
        `;
        eventList.appendChild(eventCard);
      });
    }

    // Set up pagination
    function setupPagination() {
      const paginationContainer = document.querySelector('.pagination');
      paginationContainer.innerHTML = '';  // Clear existing pagination buttons

      // "Previous" button
      const prevPage = document.createElement('li');
      prevPage.classList.add('page-item');
      if (currentPage === 1) {
        prevPage.classList.add('disabled');
      }
      prevPage.innerHTML = `<a class="page-link" href="#" onclick="goToPage(${currentPage - 1})">Previous</a>`;
      paginationContainer.appendChild(prevPage);

      // Page numbers
      for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (i === currentPage) {
          pageItem.classList.add('active');
        }
        pageItem.innerHTML = `<a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>`;
        paginationContainer.appendChild(pageItem);
      }

      // "Next" button
      const nextPage = document.createElement('li');
      nextPage.classList.add('page-item');
      if (currentPage === totalPages) {
        nextPage.classList.add('disabled');
      }
      nextPage.innerHTML = `<a class="page-link" href="#" onclick="goToPage(${currentPage + 1})">Next</a>`;
      paginationContainer.appendChild(nextPage);
    }

    // Go to a specific page
    function goToPage(page) {
      if (page < 1 || page > totalPages) return;
      currentPage = page;
      handleFilters();
    }

    // Handle filters (search, date, time, sort)
    function handleFilters() {
      currentSearch = document.getElementById('searchInput').value.trim();
      currentDate = document.getElementById('dateFilter').value;
      currentTime = document.getElementById('timeFilter').value;
      currentSort = document.getElementById('sortEvents').value;

      fetchEvents(currentPage, currentSort, currentSearch, currentDate, currentTime);
    }

    // Initial fetch (default page 1, default sort, no filters)
    document.addEventListener('DOMContentLoaded', () => {
      fetchEvents(currentPage);
    });
  </script>
</body>
</html>
  <?php require 'footer.php'; // Include footer ?>