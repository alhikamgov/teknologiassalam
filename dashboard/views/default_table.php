<div class="card shadow-sm border-0">
    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Data <?= ucfirst($curr) ?></h6>
        <?php if(!in_array($curr, ['hero', 'sambutan', 'kontak'])): ?>
            <button class="btn btn-primary btn-sm shadow-sm" onclick="openForm()"><i class="fas fa-plus mr-1"></i> Tambah</button>
        <?php endif; ?>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="min-width: 600px;">
                <thead class="bg-light">
                    <tr>
                        <?php 
                        if (in_array($curr, ['hero', 'sambutan', 'kontak'])) {
                            echo "<th>Field</th><th>Konten</th><th width='100' class='text-center'>Aksi</th>";
                        } else {
                            if (!empty($data_tabel)) {
                                foreach(array_keys($data_tabel[0]) as $key) {
                                    if($key == 'id') continue;
                                    echo "<th>".ucfirst($key)."</th>";
                                }
                            } else {
                                echo "<th>Data</th>";
                            }
                            echo "<th class='text-center' width='120'>Opsi</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(in_array($curr, ['hero', 'sambutan', 'kontak'])): ?>
                        <?php if(!empty($data_tabel)): foreach($data_tabel as $k => $v): ?>
                            <tr>
                                <td class="font-weight-bold pl-4"><?= str_replace('_', ' ', $k) ?></td>
                                <td>
                                    <?php if(strpos($k, 'img') !== false || $k == 'foto' || $k == 'gambar'): ?>
                                        <!-- Ditambahkan jalur prefix "../" agar gambar ter-load sempurna dari posisi folder dashboard -->
                                        <img src="../<?= $v ?>" class="img-preview" onerror="this.src='https://placehold.co/100x100?text=None'">
                                    <?php else: ?>
                                        <div class="small text-truncate" style="max-width: 400px;"><?= htmlspecialchars($v) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center pr-4">
                                    <button class="btn btn-outline-warning btn-sm" onclick='openForm(<?= json_encode([$k => $v]) ?>, "1")'><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    <?php else: ?>
                        <?php if(empty($data_tabel)): ?>
                            <tr><td colspan="10" class="text-center text-muted py-4">Belum ada data di tabel ini.</td></tr>
                        <?php else: foreach($data_tabel as $item): ?>
                            <tr>
                                <?php foreach($item as $k => $v): ?>
                                    <?php if($k == 'id') continue; ?>
                                    <td class="pl-4">
                                        <?php if(in_array($k, ['img', 'foto', 'gambar'])): ?>
                                            <img src="../<?= $v ?>" class="img-preview" onerror="this.src='https://placehold.co/100x100?text=None'">
                                        <?php else: ?>
                                            <div class="small text-truncate" style="max-width: 200px;"><?= htmlspecialchars($v) ?></div>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="text-center pr-4">
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-sm mr-1" onclick='openForm(<?= json_encode($item) ?>, <?= $item['id'] ?>)'><i class="fas fa-edit"></i></button>
                                        <form method="POST" onsubmit="return confirm('Hapus?')">
                                            <input type="hidden" name="action" value="del">
                                            <input type="hidden" name="section" value="<?= $curr ?>">
                                            <input type="hidden" name="index" value="<?= $item['id'] ?>">
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>