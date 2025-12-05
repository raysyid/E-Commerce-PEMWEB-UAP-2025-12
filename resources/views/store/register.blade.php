<form action="{{ route('store.store') }}" method="POST">
    @csrf

    <h2>Registrasi Toko</h2>

    <label>Nama Toko</label>
    <input type="text" name="name" required><br>

    <label>Tentang Toko</label>
    <textarea name="about"></textarea><br>

    <label>Nomor Telepon</label>
    <input type="text" name="phone" required><br>

    <label>Kota</label>
    <input type="text" name="city" required><br>

    <label>Alamat Lengkap</label>
    <textarea name="address" required></textarea><br>

    <label>Kode Pos</label>
    <input type="text" name="postal_code"><br>

    <button type="submit">Daftarkan Toko</button>
</form>