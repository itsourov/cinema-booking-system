<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        @import url("https://fonts.googleapis.com/css?family=Lato&display=swap");

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #242333;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: "Lato", sans-serif;
            margin: 0;
        }

        .movie-container {
            margin: 20px 0;
        }

        .movie-container select {
            background-color: #fff;
            border: 0;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 10px;
            padding: 5px 15px 5px 15px;
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
        }

        .container {
            perspective: 1000px;
            margin-bottom: 30px;
        }

        .seat {
            background-color: #444451;
            height: 26px;
            width: 32px;
            margin: 3px;
            font-size: 50px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .seat.selected {
            background-color: green;
        }

        .seat.sold {
            background-color: #fff;
        }

        .seat:nth-of-type(2) {
            margin-right: 18px;
        }

        .seat:nth-last-of-type(2) {
            margin-left: 18px;
        }

        .seat:not(.sold):hover {
            cursor: pointer;
            transform: scale(1.2);
        }

        .showcase .seat:not(.sold):hover {
            cursor: default;
            transform: scale(1);
        }

        .showcase {
            background: rgba(0, 0, 0, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
            color: #777;
            list-style-type: none;
            display: flex;
            justify-content: space-between;
        }

        .showcase li {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
        }

        .showcase li small {
            margin-left: 2px;
        }

        .row {
            display: flex;
        }

        .screen {
            background-color: #fff;
            height: 120px;
            width: 100%;
            margin: 15px 0;
            transform: rotateX(-48deg);
            box-shadow: 0 3px 10px rgba(255, 255, 255, 0.7);
        }

        p.text {
            margin: 5px 0;
        }

        p.text span {
            color: rgb(158, 248, 158);
        }
    </style>
    <title>Movie Seat Booking</title>
</head>

<body>
    <div class="movie-container">
        <label> Select a movie:</label>
        <select id="movie">
            <option value="220">Godzilla vs Kong (RS.220)</option>
            <option value="320">Radhe (RS.320)</option>
            <option value="250">RRR (RS.250)</option>
            <option value="260">F9 (RS.260)</option>
        </select>
    </div>

    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>Available</small>
        </li>
        <li>
            <div class="seat selected"></div>
            <small>Selected</small>
        </li>
        <li>
            <div class="seat sold"></div>
            <small>Sold</small>
        </li>
    </ul>
    <div class="container">
        <div class="screen"></div>

        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>

        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat"></div>
        </div>
    </div>

    <p class="text">
        You have selected <span id="count">0</span> seat for a price of RS.<span id="total">0</span>
    </p>
    <script>
        const container = document.querySelector(".container");
        const seats = document.querySelectorAll(".row .seat:not(.sold)");
        const count = document.getElementById("count");
        const total = document.getElementById("total");
        const movieSelect = document.getElementById("movie");

        populateUI();

        let ticketPrice = +movieSelect.value;

        // Save selected movie index and price
        function setMovieData(movieIndex, moviePrice) {
            localStorage.setItem("selectedMovieIndex", movieIndex);
            localStorage.setItem("selectedMoviePrice", moviePrice);
        }

        // Update total and count
        function updateSelectedCount() {
            const selectedSeats = document.querySelectorAll(".row .seat.selected");

            const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

            localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));

            const selectedSeatsCount = selectedSeats.length;

            count.innerText = selectedSeatsCount;
            total.innerText = selectedSeatsCount * ticketPrice;

            setMovieData(movieSelect.selectedIndex, movieSelect.value);
        }


        // Get data from localstorage and populate UI
        function populateUI() {
            const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

            if (selectedSeats !== null && selectedSeats.length > 0) {
                seats.forEach((seat, index) => {
                    if (selectedSeats.indexOf(index) > -1) {
                        console.log(seat.classList.add("selected"));
                    }
                });
            }

            const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

            if (selectedMovieIndex !== null) {
                movieSelect.selectedIndex = selectedMovieIndex;
                console.log(selectedMovieIndex)
            }
        }
        console.log(populateUI())
        // Movie select event
        movieSelect.addEventListener("change", (e) => {
            ticketPrice = +e.target.value;
            setMovieData(e.target.selectedIndex, e.target.value);
            updateSelectedCount();
        });

        // Seat click event
        container.addEventListener("click", (e) => {
            if (
                e.target.classList.contains("seat") &&
                !e.target.classList.contains("sold")
            ) {
                e.target.classList.toggle("selected");

                updateSelectedCount();
            }
        });

        // Initial count and total set
        updateSelectedCount();
    </script>
</body>

</html>
