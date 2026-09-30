<div id="modal-add-user" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Tambah User Baru</h2>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="new_user_name" class="form-control" placeholder="Nama lengkap user">
                </div>
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" id="new_user_email" class="form-control" placeholder="user@email.com">
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" id="new_user_password" class="form-control" placeholder="Minimal 6 karakter">
                </div>
                <div class="mb-4">
                    <label class="form-label">Pilih Role</label>
                    <select id="new_user_role" class="form-select">
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batal</button>
                <button type="button" onclick="addUser()" class="btn btn-primary w-24">Simpan</button>
            </div>
        </div>
    </div>
</div>