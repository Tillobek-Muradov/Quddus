<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chortoq Sanatoriyasi | Boshqaruv paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Chortoq Sanatoriyasi Boshqaruv Paneli</h1>
            <p class="lead">Xush kelibsiz! Sanatoriya boshqaruvi uchun quyidagi imkoniyatlardan foydalaning.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Bronlar</h5>
                        <p class="card-text">Mijozlarning bronlarini ko'rish va boshqarish</p>
                        <a href="/bookings" class="btn btn-primary">Ko'rish</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Xonalar</h5>
                        <p class="card-text">Xonalarni boshqarish va ularning holatini kuzatish</p>
                        <a href="/rooms" class="btn btn-primary">Ko'rish</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Davolash turlari</h5>
                        <p class="card-text">Davolash turlari va ularning narxlarini boshqarish</p>
                        <a href="/treatments" class="btn btn-primary">Ko'rish</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <div class="alert alert-info">
                <p>API manzil: <code>{{ url('/api/bookings') }}</code></p>
                <p>Frontend manzil: <code>http://localhost:3000</code> (yoki sizning frontend manzilingiz)</p>
            </div>
        </div>
    </div>
</body>
</html>