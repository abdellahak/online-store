document.addEventListener("DOMContentLoaded", function () {
    // These variables will be injected by the Blade template
    const revenueByMonthLabels = window.dashboardData.revenueByMonthLabels;
    const revenueByMonthData = window.dashboardData.revenueByMonthData;
    const revenueByDayLabels = window.dashboardData.revenueByDayLabels;
    const revenueByDayData = window.dashboardData.revenueByDayData;
    const topProductsLabels = window.dashboardData.topProductsLabels;
    const topProductsData = window.dashboardData.topProductsData;
    const revenueByCategoryLabels =
        window.dashboardData.revenueByCategoryLabels;
    const revenueByCategoryData = window.dashboardData.revenueByCategoryData;

    // Revenue by Month Bar Chart
    const ctxMonth = document
        .getElementById("revenueByMonthChart")
        .getContext("2d");
    new Chart(ctxMonth, {
        type: "bar",
        data: {
            labels: revenueByMonthLabels,
            datasets: [
                {
                    label: "Revenue",
                    data: revenueByMonthData,
                    backgroundColor: "rgba(40, 167, 69, 0.7)",
                },
            ],
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
        },
    });

    // Revenue by Day Line Chart
    const ctxDay = document
        .getElementById("revenueByDayChart")
        .getContext("2d");
    new Chart(ctxDay, {
        type: "line",
        data: {
            labels: revenueByDayLabels,
            datasets: [
                {
                    label: "Revenue",
                    data: revenueByDayData,
                    borderColor: "rgba(13, 110, 253, 0.9)",
                    backgroundColor: "rgba(13, 110, 253, 0.2)",
                    fill: true,
                    tension: 0.3,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
        },
    });

    // Top Products by Revenue Bar Chart
    const ctxProducts = document
        .getElementById("topProductsChart")
        .getContext("2d");
    new Chart(ctxProducts, {
        type: "bar",
        data: {
            labels: topProductsLabels,
            datasets: [
                {
                    label: "Revenue",
                    data: topProductsData,
                    backgroundColor: "rgba(23, 162, 184, 0.7)",
                },
            ],
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
        },
    });

    // Revenue by Category Doughnut Chart
    const ctxCategory = document
        .getElementById("revenueByCategoryChart")
        .getContext("2d");
    new Chart(ctxCategory, {
        type: "doughnut",
        data: {
            labels: revenueByCategoryLabels,
            datasets: [
                {
                    label: "Revenue",
                    data: revenueByCategoryData,
                    backgroundColor: [
                        "rgba(255, 193, 7, 0.7)",
                        "rgba(40, 167, 69, 0.7)",
                        "rgba(0, 123, 255, 0.7)",
                        "rgba(220, 53, 69, 0.7)",
                        "rgba(23, 162, 184, 0.7)",
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            plugins: { legend: { position: "bottom" } },
        },
    });

    // Animate numbers with .count-up class
    document.querySelectorAll(".count-up").forEach(function (el) {
        const isCurrency = el.textContent.trim().startsWith("$");
        const target = parseFloat(el.getAttribute("data-target"));
        const decimals = el.textContent.includes(".") ? 2 : 0;
        let current = 0;
        const duration = 1200;
        const stepTime = Math.max(Math.floor(duration / (target || 1)), 20);

        function update() {
            current += target / (duration / stepTime);
            if (current >= target) current = target;
            el.textContent = isCurrency
                ? "$" +
                  Number(current).toLocaleString(undefined, {
                      minimumFractionDigits: decimals,
                      maximumFractionDigits: decimals,
                  })
                : Number(current).toLocaleString(undefined, {
                      maximumFractionDigits: decimals,
                  });
            if (current < target) {
                requestAnimationFrame(update);
            }
        }
        el.textContent = isCurrency ? "$0" : "0";
        update();
    });
});
