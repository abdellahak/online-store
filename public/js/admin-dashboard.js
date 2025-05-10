document.addEventListener("DOMContentLoaded", function () {
    const revenueByMonthLabels = window.dashboardData.revenueByMonthLabels;
    const revenueByMonthData = window.dashboardData.revenueByMonthData;
    const revenueByDayLabels = window.dashboardData.revenueByDayLabels;
    const revenueByDayData = window.dashboardData.revenueByDayData;
    const topProductsLabels = window.dashboardData.topProductsLabels;
    const topProductsData = window.dashboardData.topProductsData;
    const revenueByCategoryLabels =
        window.dashboardData.revenueByCategoryLabels;
    const revenueByCategoryData = window.dashboardData.revenueByCategoryData;

    // Revenue by Month
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

    // Revenue by Day
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

    // Top Products by Revenue
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

    // Revenue by Category
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

    // PDF Download
    const downloadBtn = document.getElementById("downloadPdfBtn");
    if (downloadBtn) {
        downloadBtn.addEventListener("click", function () {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF("p", "mm", "a4");
            const margin = 10;

            const dashboardContent = document.querySelector(
                "#dashboard-export-content"
            );

            const hiddenDiv = document.createElement("div");
            hiddenDiv.style.position = "fixed";
            hiddenDiv.style.left = "-9999px";
            hiddenDiv.style.top = "0";
            hiddenDiv.style.width = dashboardContent.offsetWidth + "px";
            hiddenDiv.style.background = "#fff";
            document.body.appendChild(hiddenDiv);

            const exportClone = dashboardContent.cloneNode(true);

            const periodForm = exportClone.querySelector(
                "#dashboard-period-form"
            );
            if (periodForm) {
                periodForm.style.display = "none";
            }

            // Add CSS to avoid page breaks inside tables and cards
            const style = document.createElement("style");
            style.innerHTML = `
              table, .card, .table-responsive {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
              }
            `;
            exportClone.appendChild(style);

            const tablesContainer = exportClone.querySelector(
                ".tableDataContainer"
            );
            tablesContainer.style.flexDirection = "column";
            tablesContainer.style.gap = "50px";
            const tables = exportClone.querySelectorAll(".tableData");
            tables.forEach(function (table) {
                table.style.width = "100%";
            });

            // Copy Chart.js canvases as images into the clone
            const originalCanvases =
                dashboardContent.querySelectorAll("canvas");
            const clonedCanvases = exportClone.querySelectorAll("canvas");
            originalCanvases.forEach((origCanvas, idx) => {
                const img = document.createElement("img");
                img.src = origCanvas.toDataURL();
                img.style.width =
                    origCanvas.style.width || origCanvas.width + "px";
                img.style.height =
                    origCanvas.style.height || origCanvas.height + "px";
                clonedCanvases[idx].replaceWith(img);
            });

            hiddenDiv.appendChild(exportClone);

            html2canvas(exportClone, { scale: 2 }).then((canvas) => {
                const imgData = canvas.toDataURL("image/png");
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth() - margin * 2;
                const pdfHeight =
                    pdf.internal.pageSize.getHeight() - margin * 2;
                const imgWidth = pdfWidth;
                const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

                let heightLeft = imgHeight;
                let position = margin;

                pdf.addImage(
                    imgData,
                    "PNG",
                    margin,
                    position,
                    imgWidth,
                    imgHeight
                );
                heightLeft -= pdfHeight;

                while (heightLeft > 0) {
                    pdf.addPage();
                    position = margin;
                    pdf.addImage(
                        imgData,
                        "PNG",
                        margin,
                        position - (imgHeight - heightLeft),
                        imgWidth,
                        imgHeight
                    );
                    heightLeft -= pdfHeight;
                }

                pdf.save("dashboard-statistics.pdf");
                document.body.removeChild(hiddenDiv);
            });
        });
    }
});
