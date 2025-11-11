// Galeri Actions - Clean JavaScript File
console.log('Galeri Actions Loaded');

// Global Functions for Button Actions
window.handleLikeNoLogin = function(fotoId, event) {
    console.log('=== handleLikeNoLogin CALLED ===');
    console.log('fotoId:', fotoId);
    
    if (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
    
    // Check if user is logged in (will be set by blade)
    if (!window.isUserLoggedIn) {
        console.log('User not logged in, redirecting...');
        sessionStorage.setItem('intended_url', window.location.href);
        window.location.href = '/login';
        return false;
    }
    
    console.log('User logged in, calling handleLike...');
    if (typeof window.handleLike === 'function') {
        window.handleLike(fotoId, event);
    }
    return false;
};

window.handleComment = function(fotoId, event) {
    console.log('handleComment called with fotoId:', fotoId);
    
    if (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
    
    // Check login first
    if (!window.isUserLoggedIn) {
        console.log('User not logged in, redirecting...');
        sessionStorage.setItem('intended_url', window.location.href);
        window.location.href = '/login';
        return false;
    }
    
    console.log('Calling showComments...');
    if (typeof window.showComments === 'function') {
        window.showComments(fotoId, event);
    } else {
        console.error('showComments function not found!');
    }
    return false;
};

window.handleShareOptions = function(fotoId, judul, fileUrl, event) {
    console.log('handleShareOptions called - NEW VERSION with 6 platforms');
    
    if (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
    
    // Use APP_URL from Laravel (passed via blade) or fallback to current origin
    const appUrl = window.APP_URL || window.location.origin;
    const shareUrl = appUrl + '/galeri?foto=' + fotoId;
    const shareText = 'Lihat foto "' + judul + '" di Galeri SMKN 4 Bogor';
    const whatsappText = encodeURIComponent(shareText + '\n\n' + shareUrl);
    
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '<div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 0.5rem;"><i class="bi bi-share-fill" style="color: #1E40AF;"></i><span>Bagikan Foto</span></div>',
            html: `
                <div style="text-align: center; padding: 0.5rem;">
                    <p style="color: #333; margin-bottom: 1rem; font-size: 1rem; font-weight: 600;">${judul}</p>
                    
                    <!-- Link Box with Copy Button -->
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 2px solid #e5e7eb;">
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;">
                            <div style="flex: 1; text-align: left;">
                                <p style="font-size: 0.75rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">LINK FOTO</p>
                                <p style="font-size: 0.8rem; color: #666; margin: 0; word-break: break-all; line-height: 1.4;">${shareUrl}</p>
                            </div>
                            <button onclick="navigator.clipboard.writeText('${shareUrl}'); const btn = this; btn.innerHTML='<i class=\\'bi bi-check2\\'></i>'; setTimeout(() => btn.innerHTML='<i class=\\'bi bi-clipboard\\'></i>', 1000);" style="background: #1E40AF; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; min-width: 45px; transition: all 0.2s;" onmouseover="this.style.background='#1e3a8a'" onmouseout="this.style.background='#1E40AF'">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                    </div>
                    
                    <p style="color: #999; margin-bottom: 1rem; font-size: 0.85rem;">Pilih platform untuk membagikan:</p>
                    
                    <!-- Share Grid - 6 Platforms -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1rem;">
                        <!-- WhatsApp -->
                        <div onclick="trackShare(${fotoId}, 'WhatsApp'); window.open('https://web.whatsapp.com/send?text=${whatsappText}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#25D366';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                            <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #25D366; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-whatsapp" style="font-size: 1.5rem; color: white;"></i>
                            </div>
                            <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">WhatsApp</p>
                        </div>
                        
                        <!-- Facebook -->
                        <div onclick="trackShare(${fotoId}, 'Facebook'); window.open('https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#1877F2';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                            <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #1877F2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-facebook" style="font-size: 1.5rem; color: white;"></i>
                            </div>
                            <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Facebook</p>
                        </div>
                        
                        <!-- Twitter -->
                        <div onclick="trackShare(${fotoId}, 'Twitter'); window.open('https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareText)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#1DA1F2';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                            <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #1DA1F2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-twitter" style="font-size: 1.5rem; color: white;"></i>
                            </div>
                            <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Twitter</p>
                        </div>
                        
                        <!-- Telegram -->
                        <div onclick="trackShare(${fotoId}, 'Telegram'); window.open('https://t.me/share/url?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareText)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#0088cc';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                            <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #0088cc; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-telegram" style="font-size: 1.5rem; color: white;"></i>
                            </div>
                            <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Telegram</p>
                        </div>
                        
                        <!-- Instagram -->
                        <div onclick="trackShare(${fotoId}, 'Instagram'); window.shareToInstagramWeb('${shareUrl}', '${judul}'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#E4405F';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                            <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-instagram" style="font-size: 1.5rem; color: white;"></i>
                            </div>
                            <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Instagram</p>
                        </div>
                        
                        <!-- Email -->
                        <div onclick="trackShare(${fotoId}, 'Email'); window.location.href='mailto:?subject=${encodeURIComponent(shareText)}&body=${encodeURIComponent(shareUrl)}'; Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#EA4335';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                            <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #EA4335; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-envelope-fill" style="font-size: 1.5rem; color: white;"></i>
                            </div>
                            <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Email</p>
                        </div>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonText: 'Tutup',
            cancelButtonColor: '#6c757d',
            width: '550px',
            padding: '1.5rem'
        });
    }
    return false;
};

// handleBookmark wrapper with login check
window.handleBookmarkWrapper = function(fotoId, event) {
    console.log('handleBookmarkWrapper called with fotoId:', fotoId);
    
    if (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
    
    // Check login first
    if (!window.isUserLoggedIn) {
        console.log('User not logged in, redirecting...');
        sessionStorage.setItem('intended_url', window.location.href);
        window.location.href = '/login';
        return false;
    }
    
    console.log('Calling handleBookmark...');
    if (typeof window.handleBookmark === 'function') {
        window.handleBookmark(fotoId, event);
    } else {
        console.error('handleBookmark function not found!');
    }
    return false;
};

window.handlePhotoOptions = function(fotoId, event) {
    console.log('handlePhotoOptions called with fotoId:', fotoId);
    
    if (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
    
    if (!window.isUserLoggedIn) {
        sessionStorage.setItem('intended_url', window.location.href);
        window.location.href = '/login';
        return false;
    }
    
    // Show options menu: only 'Laporkan Foto'
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '<i class="bi bi-three-dots-vertical"></i> Opsi Foto',
            html: '<button class="btn btn-outline-danger w-100" onclick="Swal.close();"><i class="bi bi-flag-fill me-2"></i>Laporkan Foto</button>',
            showConfirmButton: false,
            showCancelButton: false,
            width: '320px'
        });
    }
    return false;
};

window.shareToWhatsApp = function(url, text) {
    const shareUrl = 'https://wa.me/?text=' + encodeURIComponent(text + ' ' + url);
    window.open(shareUrl, '_blank');
    if (typeof Swal !== 'undefined') {
        Swal.close();
    }
};

window.shareToInstagram = function(fileUrl) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'info',
            title: 'Bagikan ke Instagram',
            html: '<p>Untuk membagikan ke Instagram:</p><ol style="text-align: left;"><li>Download foto terlebih dahulu</li><li>Buka aplikasi Instagram</li><li>Upload foto dari galeri</li></ol>',
            showCancelButton: true,
            confirmButtonText: 'Download Foto',
            cancelButtonText: 'Tutup'
        });
    }
};

// Event Delegation
document.addEventListener('DOMContentLoaded', function() {
    console.log('Galeri Actions - DOMContentLoaded');
    
    // Event delegation for all action buttons
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.action-btn, .gallery-top-menu');
        if (!btn) return;
        
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        const action = btn.dataset.action;
        const fotoId = parseInt(btn.dataset.fotoId);
        
        console.log('Button clicked:', action, 'fotoId:', fotoId);
        
        switch(action) {
            case 'like':
                console.log('Delegating to handleLike');
                if (typeof window.handleLike === 'function') {
                    window.handleLike(fotoId, e);
                } else if (typeof window.handleLikeNoLogin === 'function') {
                    window.handleLikeNoLogin(fotoId, e);
                } else {
                    console.error('No like handler found!');
                }
                break;
            case 'comment':
                console.log('Delegating to handleComment');
                if (typeof window.handleComment === 'function') {
                    window.handleComment(fotoId, e);
                } else {
                    console.error('No comment handler found!');
                }
                break;
            case 'share':
                console.log('Delegating to handleShare');
                if (typeof window.handleShare === 'function') {
                    window.handleShare(fotoId, btn.dataset.judul, e);
                } else if (typeof window.handleShareOptions === 'function') {
                    window.handleShareOptions(fotoId, btn.dataset.judul, btn.dataset.fileUrl, e);
                } else {
                    console.error('No share handler found!');
                }
                break;
            case 'bookmark':
                console.log('Delegating to handleBookmark');
                if (typeof window.handleBookmarkWrapper === 'function') {
                    window.handleBookmarkWrapper(fotoId, e);
                } else if (typeof window.handleBookmark === 'function') {
                    window.handleBookmark(fotoId, e);
                } else {
                    console.error('No bookmark handler found!');
                }
                break;
            case 'options':
                console.log('Delegating to handlePhotoOptions');
                if (typeof window.handlePhotoOptions === 'function') {
                    window.handlePhotoOptions(fotoId, e);
                } else {
                    console.error('No options handler found!');
                }
                break;
        }
        
        return false; // CRITICAL: Prevent default
    });
    
    console.log('Event delegation setup complete');
});
