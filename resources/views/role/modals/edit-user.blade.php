<div id="modal-edit-user" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Edit Data User</h2>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_user_id">
                <div class="mb-4">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="edit_user_name" class="form-control" placeholder="Nama lengkap user">
                </div>
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" id="edit_user_email" class="form-control" placeholder="user@email.com">
                </div>
                <div class="mb-4">
                    <label class="form-label">Password Baru (Opsional)</label>
                    <input type="password" id="edit_user_password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                <div class="mb-4">
                    <label class="form-label">Pilih Role</label>
                    <select id="edit_user_role" class="form-select">
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batal</button>
                <button type="button" onclick="updateUser()" class="btn btn-primary w-24">Update</button>
            </div>
        </div>
    </div>
</div>