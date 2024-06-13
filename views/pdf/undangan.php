<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Kegiatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            margin: 50px auto;
            padding: 20px;
            max-width: 800px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .detail {
            margin-bottom: 20px;
        }

        .detail p {
            margin: 10px 0;
        }

        .salam {
            margin-bottom: 20px;
        }

        .salam-penutup {
            margin-top: 20px;
        }

        .download-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .download-btn button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container" id="undangan">
        <h2>Undangan Kegiatan</h2>
        
        <div class="salam">
            <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
            <p>Dengan hormat,</p>
        </div>

        <div class="detail">
            <p><strong>Acara:</strong> <?= $kegiatan->acara ?></p>
            <p><strong>Waktu:</strong> <?= $kegiatan->waktu ?></p>
            <p><strong>Keterangan:</strong> <?= $kegiatan->keterangan ?></p>
            <p><strong>Tempat:</strong> <?= $masjid->nama ?></p>
        </div>

        <div class="salam-penutup">
            <p>Demikian undangan ini kami sampaikan. Atas perhatian dan kehadirannya, kami ucapkan terima kasih.</p>
            <p>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
        </div>
    </div>

    <div class="download-btn">
        <button onclick="downloadPDF()">Download PDF</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            var element = document.getElementById('undangan');
            var opt = {
                margin: 1,
                filename: 'undangan-<?= $kegiatan->acara ?>.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().from(element).set(opt).save();
        }
    </script>
</body>

</html>
