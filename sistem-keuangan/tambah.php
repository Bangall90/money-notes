<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <style>
        .form-box {
            background: linear-gradient(120deg, #e8f5e9 0%, #f6fff7 100%);
            padding: 36px 32px 28px 32px;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(46, 125, 50, 0.13);
            max-width: 420px;
            margin: 48px auto 0 auto;
            border: 1.5px solid #a5d6a7;
            position: relative;
        }

        .form-box h2 {
            margin-top: 0;
            color: #2e7d32;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .form-box form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .form-box label {
            color: #234d20;
            font-size: 1em;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-box input[type="text"],
        .form-box input[type="date"],
        .form-box input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #a5d6a7;
            border-radius: 6px;
            font-size: 1em;
            background: #f6fff7;
            transition: border 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-box input:focus {
            border-color: #43a047;
            box-shadow: 0 0 0 2px #a5d6a7;
        }

        .form-box button[type="submit"] {
            background: linear-gradient(90deg, #43a047 60%, #66bb6a 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 0;
            font-size: 1.08em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
            margin-top: 8px;
            box-shadow: 0 2px 8px rgba(46, 125, 50, 0.10);
            letter-spacing: 0.5px;
        }

        .form-box button[type="submit"]:hover {
            background: linear-gradient(90deg, #2e7d32 60%, #43a047 100%);
            box-shadow: 0 4px 16px rgba(46, 125, 50, 0.13);
        }

        #feedback {
            margin: 18px 0 0 0;
            padding: 12px 18px;
            border-radius: 7px;
            font-weight: bold;
            text-align: center;
            font-size: 1em;
            box-shadow: 0 2px 8px rgba(46, 125, 50, 0.08);
        }

        @media (max-width: 600px) {
            .form-box {
                max-width: 100%;
                margin: 18px 2vw 0 2vw;
                padding: 10px 2vw 10px 2vw;
            }

            .form-box h2 {
                font-size: 1.15em;
            }

            .form-box label {
                font-size: 0.97em;
            }

            .form-box input[type="text"],
            .form-box input[type="date"],
            .form-box input[type="number"] {
                padding: 8px 8px;
                font-size: 0.97em;
            }

            .form-box button[type="submit"] {
                padding: 10px 0;
                font-size: 1em;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const jumlahInput = form.querySelector('input[name="jumlah"]');
            const ketInput = form.querySelector('input[name="keterangan"]');
            const tanggalInput = form.querySelector('input[name="tanggal"]');
            let feedback = null;

            // Add feedback element
            if (!document.getElementById('feedback')) {
                feedback = document.createElement('div');
                feedback.id = 'feedback';
                feedback.style.display = 'none';
                form.parentNode.insertBefore(feedback, form.nextSibling);
            }

            form.addEventListener('submit', function(e) {
                // Simple validation
                if (!tanggalInput.value) {
                    showFeedback('Tanggal harus diisi!', true);
                    tanggalInput.focus();
                    e.preventDefault();
                    return;
                }
                if (!ketInput.value.trim()) {
                    showFeedback('Keterangan harus diisi!', true);
                    ketInput.focus();
                    e.preventDefault();
                    return;
                }
                if (!jumlahInput.value || isNaN(jumlahInput.value)) {
                    showFeedback('Jumlah harus berupa angka!', true);
                    jumlahInput.focus();
                    e.preventDefault();
                    return;
                }
                // Animasi tombol
                const btn = form.querySelector('button[type="submit"]');
                btn.disabled = true;
                btn.textContent = 'Menyimpan...';
                btn.style.opacity = '0.7';
            });

            function showFeedback(msg, isError) {
                feedback.textContent = msg;
                feedback.style.display = 'block';
                feedback.style.background = isError ? '#ffcdd2' : '#c8e6c9';
                feedback.style.color = isError ? '#b71c1c' : '#234d20';
                setTimeout(() => {
                    feedback.style.display = 'none';
                }, 2200);
            }
        });
    </script>
</head>

<body>
    <div class="form-box">
        <h2>Tambah Transaksi</h2>
        <form method="POST" action="proses.php">
            <label>Tanggal
                <input type="date" name="tanggal" required>
            </label>
            <label>Keterangan
                <input type="text" name="keterangan" required>
            </label>
            <label>Jumlah (Rp)
                <input type="number" name="jumlah" required>
            </label>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>

</html>