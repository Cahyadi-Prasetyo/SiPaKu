# Custom Confirm Dialog - Modern UI

## 🎯 Masalah dengan `confirm()` Bawaan Browser

### ❌ Kekurangan Browser Confirm:
1. **Tampilan Tidak Konsisten**
   - Berbeda di setiap browser
   - Tidak bisa di-customize
   - Terlihat kuno dan tidak modern

2. **Tidak Sesuai Design System**
   - Warna dan font tidak match
   - Tidak ada branding
   - Tidak responsive

3. **User Experience Buruk**
   - Blocking (freeze UI)
   - Tidak ada animasi
   - Tidak ada icon visual

4. **Teks Tidak Fleksibel**
   - Button text fixed (OK/Cancel)
   - Tidak bisa custom message
   - Tidak ada tipe (warning/danger/info)

---

## ✨ Custom Confirm Dialog - Solusi Modern

### Fitur:
- 🎨 **Modern Design** - Gradient, rounded corners, shadows
- 🎬 **Smooth Animation** - Fade in/out, scale effect
- 🎯 **Customizable** - Title, message, button text, type
- 🌈 **Type Support** - Warning (kuning), Danger (merah)
- 📱 **Responsive** - Works on all devices
- ⌨️ **Keyboard Support** - Auto-focus on confirm button
- 🎭 **Backdrop Blur** - Modern glassmorphism effect
- ♿ **Accessible** - Clear visual hierarchy

---

## 📖 Cara Penggunaan

### Basic Usage:
```javascript
const confirmed = await window.confirmDialog({
    title: 'Konfirmasi',
    message: 'Apakah Anda yakin?',
    confirmText: 'Ya',
    cancelText: 'Batal'
});

if (confirmed) {
    // User clicked "Ya"
} else {
    // User clicked "Batal"
}
```

### Warning Type (Kuning):
```javascript
const confirmed = await window.confirmDialog({
    title: 'SKS Kurang dari Minimal',
    message: 'Total SKS Anda hanya 9 SKS (minimal 12 SKS). Apakah Anda yakin?',
    confirmText: 'Ya, Lanjutkan',
    cancelText: 'Batal',
    type: 'warning'
});
```

### Danger Type (Merah):
```javascript
const confirmed = await window.confirmDialog({
    title: 'Hapus Mata Kuliah',
    message: 'Apakah Anda yakin ingin menghapus mata kuliah ini?',
    confirmText: 'Hapus',
    cancelText: 'Batal',
    type: 'danger',
    confirmClass: 'confirm-btn-danger'
});
```

---

## 🎨 Design Specifications

### Colors:

**Warning Type:**
- Icon Background: Gradient #fef3c7 → #fde68a
- Icon Color: #d97706 (Orange)
- Button: Blue gradient

**Danger Type:**
- Icon Background: Gradient #fee2e2 → #fecaca
- Icon Color: #dc2626 (Red)
- Button: Red gradient

### Typography:
- Title: 18px, font-weight 600
- Message: 14px, line-height 1.5
- Buttons: 14px, font-weight 500

### Spacing:
- Modal Padding: 24px
- Icon Size: 48px
- Button Gap: 12px
- Border Radius: 16px (modal), 8px (buttons)

### Animation:
- Fade In: 0.2s ease-out
- Scale In: 0.3s ease-out
- Fade Out: 0.2s ease-in

---

## 🔧 Implementation Details

### HTML Structure:
```html
<div class="confirm-overlay">
    <div class="confirm-modal">
        <div class="confirm-header">
            <div class="confirm-icon warning">ℹ️</div>
            <h3 class="confirm-title">Konfirmasi</h3>
        </div>
        <p class="confirm-message">Apakah Anda yakin?</p>
        <div class="confirm-buttons">
            <button class="confirm-btn confirm-btn-cancel">Batal</button>
            <button class="confirm-btn confirm-btn-confirm">Ya</button>
        </div>
    </div>
</div>
```

### JavaScript API:
```javascript
window.confirmDialog({
    title: string,           // Dialog title
    message: string,         // Dialog message
    confirmText: string,     // Confirm button text
    cancelText: string,      // Cancel button text
    type: 'warning'|'danger', // Dialog type
    confirmClass: string     // Custom class for confirm button
})
```

**Returns:** `Promise<boolean>`
- `true` if user clicked confirm
- `false` if user clicked cancel or clicked overlay

---

## 📝 Use Cases di KRS

### 1. Hapus Mata Kuliah (Danger)
```javascript
async function removeFromKRS(jadwalId) {
    const confirmed = await window.confirmDialog({
        title: 'Hapus Mata Kuliah',
        message: 'Apakah Anda yakin ingin menghapus mata kuliah ini dari KRS?',
        confirmText: 'Hapus',
        cancelText: 'Batal',
        type: 'danger',
        confirmClass: 'confirm-btn-danger'
    });
    
    if (!confirmed) return;
    
    // Proceed with deletion
}
```

### 2. Hapus Semua (Danger)
```javascript
async function clearAllKRS() {
    const confirmed = await window.confirmDialog({
        title: 'Hapus Semua Mata Kuliah',
        message: 'Apakah Anda yakin ingin menghapus SEMUA mata kuliah dari KRS? Tindakan ini tidak dapat dibatalkan.',
        confirmText: 'Hapus Semua',
        cancelText: 'Batal',
        type: 'danger',
        confirmClass: 'confirm-btn-danger'
    });
    
    if (!confirmed) return;
    
    // Proceed with clear all
}
```

### 3. Submit KRS dengan SKS Kurang (Warning)
```javascript
async function submitKRS() {
    const totalSKS = 9;
    
    if (totalSKS < 12) {
        const confirmed = await window.confirmDialog({
            title: 'SKS Kurang dari Minimal',
            message: `Total SKS Anda hanya ${totalSKS} SKS (minimal 12 SKS). Apakah Anda yakin ingin mengajukan KRS?`,
            confirmText: 'Ya, Ajukan',
            cancelText: 'Batal',
            type: 'warning'
        });
        
        if (!confirmed) return;
    }
    
    // Final confirmation
    const finalConfirm = await window.confirmDialog({
        title: 'Ajukan KRS',
        message: 'Apakah Anda yakin ingin mengajukan KRS untuk disetujui? Setelah diajukan, KRS tidak dapat diubah.',
        confirmText: 'Ya, Ajukan',
        cancelText: 'Batal',
        type: 'warning'
    });
    
    if (!finalConfirm) return;
    
    // Proceed with submission
}
```

---

## 🎭 Visual Examples

### Warning Dialog:
```
┌─────────────────────────────────────┐
│  ℹ️  SKS Kurang dari Minimal        │
├─────────────────────────────────────┤
│  Total SKS Anda hanya 9 SKS         │
│  (minimal 12 SKS). Apakah Anda      │
│  yakin ingin mengajukan KRS?        │
│                                     │
│           [Batal] [Ya, Ajukan]     │
└─────────────────────────────────────┘
```

### Danger Dialog:
```
┌─────────────────────────────────────┐
│  ⚠️  Hapus Mata Kuliah              │
├─────────────────────────────────────┤
│  Apakah Anda yakin ingin menghapus  │
│  mata kuliah ini dari KRS?          │
│                                     │
│           [Batal] [Hapus]          │
└─────────────────────────────────────┘
```

---

## 📊 Perbandingan Before/After

### Before (Browser Confirm):
```javascript
if (!confirm('Apakah Anda yakin?')) {
    return;
}
```
- ❌ Tampilan kuno
- ❌ Tidak bisa custom
- ❌ Tidak ada animasi
- ❌ Blocking UI

### After (Custom Dialog):
```javascript
const confirmed = await window.confirmDialog({
    title: 'Konfirmasi',
    message: 'Apakah Anda yakin?',
    confirmText: 'Ya',
    cancelText: 'Batal',
    type: 'warning'
});

if (!confirmed) return;
```
- ✅ Tampilan modern
- ✅ Fully customizable
- ✅ Smooth animation
- ✅ Non-blocking (async)

---

## 🧪 Testing

### Test Case 1: Warning Dialog
1. Klik "Ajukan KRS" dengan SKS < 12
2. Dialog muncul dengan icon kuning
3. Klik "Batal" → Dialog hilang, tidak ada action
4. Klik "Ya, Ajukan" → Dialog hilang, proceed

### Test Case 2: Danger Dialog
1. Klik button hapus mata kuliah
2. Dialog muncul dengan icon merah
3. Klik "Batal" → Dialog hilang, tidak ada action
4. Klik "Hapus" → Dialog hilang, proceed

### Test Case 3: Click Outside
1. Buka dialog
2. Klik di luar modal (overlay)
3. Dialog hilang (sama seperti cancel)

### Test Case 4: Keyboard
1. Buka dialog
2. Confirm button auto-focus
3. Press Enter → Confirm
4. Press Escape → Cancel (optional, bisa ditambahkan)

---

## 🚀 Future Enhancements

### Prioritas Tinggi:
- [ ] Keyboard support (Escape to cancel)
- [ ] Custom icon support
- [ ] Success type (hijau)
- [ ] Info type (biru)

### Prioritas Sedang:
- [ ] Input field support (prompt replacement)
- [ ] Multiple buttons support
- [ ] Custom button colors
- [ ] Sound effects

### Prioritas Rendah:
- [ ] Draggable modal
- [ ] Resizable modal
- [ ] Multiple modals stack
- [ ] Transition effects options

---

## ✅ Benefits

### User Experience:
- ✅ Lebih modern dan menarik
- ✅ Konsisten dengan design system
- ✅ Smooth animation
- ✅ Clear visual hierarchy

### Developer Experience:
- ✅ Easy to use (async/await)
- ✅ Fully customizable
- ✅ Type-safe options
- ✅ Promise-based

### Maintenance:
- ✅ Centralized styling
- ✅ Easy to update
- ✅ Reusable component
- ✅ Well documented

---

## 📝 Summary

Custom confirm dialog menggantikan `confirm()` bawaan browser dengan:
- 🎨 Design modern yang sesuai dengan aplikasi
- 🎬 Animasi smooth untuk better UX
- 🎯 Customizable untuk berbagai use case
- 📱 Responsive dan accessible

**Status: Production Ready** 🚀
