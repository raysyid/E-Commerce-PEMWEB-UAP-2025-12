<form action="{{ route('store.store') }}" method="POST">
    @csrf

    <h2>Registrasi Toko</h2>

    <label>Nama Toko</label>
    <input type="text" name="name" required><br>

    <label>Nomor Telepon</label>
    <input type="text" name="phone" required><br>

    <label>Kota</label>
    <input type="text" name="city" required><br>

    <label>Alamat Lengkap</label>
    <textarea name="address" required></textarea><br>

    <label>Postal Code</label>
    <input type="text" name="postal_code"><br>

    <label>Tentang Toko (opsional)</label>
    <textarea name="about"></textarea><br>

    <button type="submit">Daftarkan Toko</button>
</form>