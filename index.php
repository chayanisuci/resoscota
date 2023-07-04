<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "menu/header.php" ?>

<body>
    <div id="app">
        <?php include_once "menu/sidebar.php" ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Selamat Datang Di Resos Cota</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon purple mb-2">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Profile Views</h6>
                                                <h6 class="font-extrabold mb-0">112.000</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Followers</h6>
                                                <h6 class="font-extrabold mb-0">183.000</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Following</h6>
                                                <h6 class="font-extrabold mb-0">80.000</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Saved Post</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Chart Data Cota</h4>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-1 px-1">
                                <div class="d-flex align-items-center">
                                    <div class="wrapper">
                                        <header>
                                            <p class="current-date"></p>
                                            <div class="icons">
                                                <span id="prev" class="material-symbols-rounded">chevron_left</span>
                                                <span id="next" class="material-symbols-rounded">chevron_right</span>
                                            </div>
                                        </header>
                                        <div class="calendar">
                                            <ul class="weeks">
                                                <li>Mi</li>
                                                <li>Se</li>
                                                <li>Se</li>
                                                <li>Ra</li>
                                                <li>Ka</li>
                                                <li>Ju</li>
                                                <li>Sa</li>
                                            </ul>
                                            <ul class="days"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php include_once "menu/footer.php" ?>
        </div>
    </div>


    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <!-- kalender -->
    <script>
    const date = new Date();

    const renderCalendar = () => {
        date.setDate(1);

        const monthDays = document.querySelector(".days");

        const lastDay = new Date(
            date.getFullYear(),
            date.getMonth() + 1,
            0
        ).getDate();

        const prevLastDay = new Date(
            date.getFullYear(),
            date.getMonth(),
            0
        ).getDate();

        const firstDayIndex = date.getDay();

        const lastDayIndex = new Date(
            date.getFullYear(),
            date.getMonth() + 1,
            0
        ).getDay();

        const nextDays = 7 - lastDayIndex - 1;

        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];

        document.querySelector(".date h1").innerHTML = months[date.getMonth()];

        document.querySelector(".date p").innerHTML = new Date().toDateString();

        let days = "";

        for (let x = firstDayIndex; x > 0; x--) {
            days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
        }

        for (let i = 1; i <= lastDay; i++) {
            if (
                i === new Date().getDate() &&
                date.getMonth() === new Date().getMonth()
            ) {
                days += `<div class="today">${i}</div>`;
            } else {
                days += `<div>${i}</div>`;
            }
        }

        for (let j = 1; j <= nextDays; j++) {
            days += `<div class="next-date">${j}</div>`;
            monthDays.innerHTML = days;
        }
    };

    document.querySelector(".prev").addEventListener("click", () => {
        date.setMonth(date.getMonth() - 1);
        renderCalendar();
    });

    document.querySelector(".next").addEventListener("click", () => {
        date.setMonth(date.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
    </script>



    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const chartData = [{
            day: 'Mon',
            chart: {
                peminjaman: 500,
                pengembalian: 200
            }
        },
        {
            day: 'Tue',
            chart: {
                peminjaman: 300,
                pengembalian: 300
            }
        },
        {
            day: 'Wed',
            chart: {
                peminjaman: 400,
                pengembalian: 500
            }
        },
        {
            day: 'Thu',
            chart: {
                peminjaman: 600,
                pengembalian: 100
            }
        },
        {
            day: 'Fri',
            chart: {
                peminjaman: 600,
                pengembalian: 300
            }
        },
        {
            day: 'Sat',
            chart: {
                peminjaman: 700,
                pengembalian: 200
            }
        },
        {
            day: 'Sun',
            chart: {
                peminjaman: 900,
                pengembalian: 100
            }
        }
    ];
    // setup 
    const data = {
        datasets: [{
            label: 'Perempuan',
            data: chartData,
            backgroundColor: 'rgba(255, 26, 104, 0.2)',
            borderColor: 'rgba(255, 26, 104, 1)',
            tension: 0.4,
            parsing: {
                xAxisKey: 'day',
                yAxisKey: 'chart.peminjaman'
            }
        }, {
            label: 'Laki-laki',
            data: chartData,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            tension: 0.4,
            parsing: {
                xAxisKey: 'day',
                yAxisKey: 'chart.pengembalian'
            }
        }]
    };

    // config 
    const config = {
        type: 'line',
        data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // render init block
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
    </script>


</body>

</html>