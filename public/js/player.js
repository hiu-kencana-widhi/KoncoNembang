// State Global
const state = {
    queue: [],
    currentIndex: -1,
    repeatMode: 'none', // 'none', 'all', 'one'
    shuffle: false,
    originalQueue: [],
    categories: window.tracksData || [],
    playlists: window.userPlaylists || []
};

const closeSidebar = () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    if (sidebar) sidebar.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
};

const icons = {
    play: `<svg fill="currentColor" viewBox="0 0 24 24" width="28" height="28"><path d="M8 5v14l11-7z"/></svg>`,
    pause: `<svg fill="currentColor" viewBox="0 0 24 24" width="28" height="28"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>`,
    repeatAll: `<svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M7 7h10v3l4-4-4-4v3H5v6h2V7zm10 10H7v-3l-4 4 4 4v-3h12v-6h-2v4z"/></svg>`,
    repeatOne: `<svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M7 7h10v3l4-4-4-4v3H5v6h2V7zm10 10H7v-3l-4 4 4 4v-3h12v-6h-2v4z"/><text x="12" y="16" font-size="8" text-anchor="middle" font-weight="bold" fill="currentColor">1</text></svg>`
};

// DOM Elements
const elements = {
    albumList: document.getElementById('album-list'),
    trackList: document.getElementById('track-list'),
    currentViewTitle: document.getElementById('current-view-title'),
    audio: document.getElementById('audio'),
    playBtn: document.getElementById('play'),
    prevBtn: document.getElementById('prev'),
    nextBtn: document.getElementById('next'),
    shuffleBtn: document.getElementById('shuffle-btn'),
    repeatBtn: document.getElementById('repeat-btn'),
    progress: document.getElementById('progress'),
    timeDisplay: document.getElementById('time-display'),
    nowPlaying: document.getElementById('now-playing'),
    categoryList: document.getElementById('category-list'),
    userPlaylists: document.getElementById('user-playlists'),
    newPlaylistBtn: document.getElementById('new-playlist-btn'),
    shuffleIndoBtn: document.getElementById('shuffle-indo')
};

// CSRF Token for Fetch
const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Helper: Format Time
const formatTime = (seconds) => {
    if (isNaN(seconds)) return "0:00";
    const min = Math.floor(seconds / 60);
    const sec = Math.floor(seconds % 60);
    return `${min}:${sec.toString().padStart(2, '0')}`;
};

// Helper: Get all tracks from a category
const getTracksFromCategory = (categoryId) => {
    if (categoryId === 'all') {
        let allTracks = [];
        state.categories.forEach(cat => {
            allTracks = allTracks.concat(cat.tracks || []);
        });
        return allTracks;
    }
    const category = state.categories.find(c => c.id == categoryId);
    return category ? (category.tracks || []) : [];
};

// UI Rendering
const renderAlbumList = (categoryId) => {
    elements.albumList.innerHTML = '';
    
    let albumsToRender = [];
    if (categoryId === 'all') {
        state.categories.forEach(cat => {
            if(cat.albums) albumsToRender = albumsToRender.concat(cat.albums);
        });
    } else {
        const category = state.categories.find(c => c.id == categoryId);
        if(category && category.albums) albumsToRender = category.albums;
    }

    if (albumsToRender.length === 0) {
        elements.albumList.innerHTML = '<li><span style="color:var(--text-muted);font-style:italic;">Tidak ada album</span></li>';
        return;
    }

    albumsToRender.forEach(album => {
        const li = document.createElement('li');
        li.textContent = album.title;
        li.dataset.albumId = album.id;
        li.addEventListener('click', () => {
            playAlbum(album.id, albumsToRender);
        });
        elements.albumList.appendChild(li);
    });
};

const renderTrackList = (tracks, title = "Daftar Lagu") => {
    elements.currentViewTitle.textContent = title;
    elements.trackList.innerHTML = '';

    if (tracks.length === 0) {
        elements.trackList.innerHTML = '<li><span style="color:var(--text-muted);font-style:italic;">Belum ada lagu</span></li>';
        return;
    }

    tracks.forEach((track, index) => {
        const li = document.createElement('li');
        
        const leftGroup = document.createElement('div');
        leftGroup.style.display = 'flex';
        leftGroup.style.alignItems = 'center';
        leftGroup.style.gap = '16px';

        const playIndicator = document.createElement('div');
        playIndicator.className = 'play-indicator';
        playIndicator.innerHTML = icons.play; // Start with play icon
        // Resize icon slightly
        playIndicator.querySelector('svg').style.width = '16px';
        playIndicator.querySelector('svg').style.height = '16px';

        const infoDiv = document.createElement('div');
        infoDiv.className = 'track-info';
        
        const titleSpan = document.createElement('span');
        titleSpan.className = 'track-title';
        titleSpan.textContent = track.title;
        
        const artistSpan = document.createElement('span');
        artistSpan.className = 'track-artist';
        artistSpan.textContent = track.artist || 'Unknown Artist';
        
        infoDiv.appendChild(titleSpan);
        infoDiv.appendChild(artistSpan);

        leftGroup.appendChild(playIndicator);
        leftGroup.appendChild(infoDiv);

        const actionsDiv = document.createElement('div');
        actionsDiv.style.display = 'flex';
        actionsDiv.style.gap = '10px';
        actionsDiv.style.alignItems = 'center';

        const addBtn = document.createElement('button');
        addBtn.textContent = '+';
        addBtn.className = 'add-btn';
        addBtn.title = "Tambah ke Playlist";
        addBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            showAddToPlaylistMenu(track, addBtn);
        });

        actionsDiv.appendChild(addBtn);

        li.appendChild(leftGroup);
        li.appendChild(actionsDiv);

        li.addEventListener('click', () => {
            // Put current view tracks into queue and play this one
            state.queue = [...tracks];
            state.originalQueue = [...tracks];
            if (state.shuffle) {
                // If shuffle is on, we need to shuffle but keep this track first
                shuffleQueueAndPlayFirst(index);
            } else {
                loadTrack(index);
                play();
            }
        });

        // Highlight playing track
        if (state.queue[state.currentIndex] && state.queue[state.currentIndex].id === track.id) {
            li.classList.add('playing');
        }

        elements.trackList.appendChild(li);
    });
};

const renderPlaylists = () => {
    // Keep the Buat Baru button
    const btn = document.getElementById('new-playlist-btn');
    elements.userPlaylists.innerHTML = '';
    
    state.playlists.forEach(pl => {
        const li = document.createElement('li');
        li.dataset.playlistId = pl.id;
        li.textContent = pl.name;
        li.addEventListener('click', () => {
            playPlaylist(pl);
        });
        elements.userPlaylists.appendChild(li);
    });
    
    elements.userPlaylists.appendChild(btn);
};

// Playlist Operations
const showAddToPlaylistMenu = (track, btnEl) => {
    // Remove existing menus
    const existing = document.querySelector('.playlist-dropdown');
    if (existing) existing.remove();

    if (state.playlists.length === 0) {
        alert("Anda belum memiliki playlist. Buat playlist terlebih dahulu.");
        return;
    }

    const menu = document.createElement('div');
    menu.className = 'playlist-dropdown';

    state.playlists.forEach(pl => {
        const item = document.createElement('div');
        item.className = 'playlist-dropdown-item';
        item.textContent = pl.name;
        item.addEventListener('click', () => {
            addToPlaylist(pl.id, track.id);
            menu.remove();
        });
        menu.appendChild(item);
    });

    // Close when clicked outside
    setTimeout(() => {
        const closeMenu = (e) => {
            if (!menu.contains(e.target)) {
                menu.remove();
                document.removeEventListener('click', closeMenu);
            }
        };
        document.addEventListener('click', closeMenu);
    }, 0);

    btnEl.parentNode.appendChild(menu);
};

const addToPlaylist = async (playlistId, trackId) => {
    try {
        const res = await fetch(`/playlist/${playlistId}/add-track`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({ track_id: trackId })
        });
        if (res.ok) {
            alert('Lagu berhasil ditambahkan ke playlist!');
        } else {
            alert('Gagal menambahkan lagu.');
        }
    } catch (e) {
        console.error(e);
    }
};

const createNewPlaylist = async () => {
    const name = prompt('Nama Playlist Baru:');
    if (!name || name.trim() === '') return;

    try {
        const res = await fetch('/playlist', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({ name: name.trim() })
        });
        
        const data = await res.json();
        if (data.success) {
            state.playlists.push(data.playlist);
            renderPlaylists();
        }
    } catch (e) {
        console.error(e);
    }
};

elements.newPlaylistBtn.addEventListener('click', createNewPlaylist);

// Playback Core
const playAlbum = (albumId, albumsArray) => {
    // Find album tracks
    let album = null;
    for (const a of albumsArray) {
        if (a.id == albumId) {
            album = a;
            break;
        }
    }

    if (album && album.tracks && album.tracks.length > 0) {
        renderTrackList(album.tracks, `Album: ${album.title}`);
        closeSidebar();
    } else {
        alert("Album ini kosong.");
    }
};

const playPlaylist = async (playlist) => {
    try {
        const res = await fetch(`/playlist/${playlist.id}/tracks`);
        const data = await res.json();
        
        // Update active sidebar item styling
        document.querySelectorAll('#category-list li, #user-playlists li').forEach(el => el.classList.remove('active'));
        const activeLi = document.querySelector(`#user-playlists li[data-playlist-id="${playlist.id}"]`);
        if (activeLi) activeLi.classList.add('active');

        if (data.tracks && data.tracks.length > 0) {
            renderTrackList(data.tracks, `Playlist: ${playlist.name}`);
        } else {
            renderTrackList([], `Playlist: ${playlist.name}`);
        }
        closeSidebar();
    } catch (e) {
        console.error(e);
    }
};

const playCategoryShuffle = (categoryId) => {
    const tracks = getTracksFromCategory(categoryId);
    if (tracks.length > 0) {
        state.queue = [...tracks];
        state.originalQueue = [...tracks];
        renderTrackList(state.queue, "Acak Kategori");
        
        if (!state.shuffle) toggleShuffle(); // Turn on shuffle
        else shuffleQueueAndPlayFirst(Math.floor(Math.random() * state.queue.length));
    } else {
        alert("Kategori ini tidak memiliki lagu.");
    }
};

const shuffleQueueAndPlayFirst = (startIndex) => {
    const trackToPlay = state.originalQueue[startIndex];
    let newQueue = [...state.originalQueue];
    // Remove the starting track
    newQueue.splice(startIndex, 1);
    // Fisher-Yates Shuffle
    for (let i = newQueue.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [newQueue[i], newQueue[j]] = [newQueue[j], newQueue[i]];
    }
    // Put track back at start
    newQueue.unshift(trackToPlay);
    state.queue = newQueue;
    loadTrack(0);
    play();
};

const loadTrack = (index) => {
    if (index < 0 || index >= state.queue.length) return;
    
    state.currentIndex = index;
    const track = state.queue[index];
    
    elements.audio.src = `/stream/${track.id}`;
    elements.nowPlaying.textContent = `${track.title} - ${track.artist || 'Unknown'}`;
    
    // Reset Progress
    elements.progress.value = 0;
    elements.timeDisplay.textContent = `0:00 / ${formatTime(track.duration)}`;
    
    updateMediaSession(track);
    
    const listItems = elements.trackList.querySelectorAll('li');
    listItems.forEach(li => li.classList.remove('playing'));
    // Simple logic: we match title. Not 100% robust for duplicates, but fast
    listItems.forEach(li => {
        const titleEl = li.querySelector('.track-title');
        if(titleEl && titleEl.textContent === track.title) {
            li.classList.add('playing');
        }
    });
};

const play = () => {
    if (state.currentIndex === -1 && state.queue.length > 0) loadTrack(0);
    if (state.currentIndex !== -1) {
        elements.audio.play().then(() => {
            elements.playBtn.innerHTML = icons.pause;
        }).catch(e => {
            console.error("Playback failed:", e);
            alert("Lagu gagal diputar. Hal ini mungkin karena file audio telah dihapus dari server, atau Anda masuk sebagai Admin.");
        });
    }
};

const pause = () => {
    elements.audio.pause();
    elements.playBtn.innerHTML = icons.play;
};

const togglePlay = () => {
    if (elements.audio.paused) play();
    else pause();
};

const next = () => {
    if (state.currentIndex < state.queue.length - 1) {
        loadTrack(state.currentIndex + 1);
        play();
    } else if (state.repeatMode === 'all' && state.queue.length > 0) {
        loadTrack(0);
        play();
    } else {
        pause();
    }
};

const prev = () => {
    if (elements.audio.currentTime > 3) {
        elements.audio.currentTime = 0;
    } else if (state.currentIndex > 0) {
        loadTrack(state.currentIndex - 1);
        play();
    } else if (state.repeatMode === 'all' && state.queue.length > 0) {
        loadTrack(state.queue.length - 1);
        play();
    }
};

const toggleShuffle = () => {
    state.shuffle = !state.shuffle;
    elements.shuffleBtn.style.color = state.shuffle ? 'var(--primary)' : 'var(--text-muted)';

    if (state.shuffle) {
        if (state.currentIndex !== -1) {
            shuffleQueueAndPlayFirst(state.originalQueue.findIndex(t => t.id === state.queue[state.currentIndex].id));
        }
    } else {
        const currentTrack = state.queue[state.currentIndex];
        state.queue = [...state.originalQueue];
        if (currentTrack) {
            state.currentIndex = state.queue.findIndex(t => t.id === currentTrack.id);
        }
    }
};

const cycleRepeat = () => {
    if (state.repeatMode === 'none') {
        state.repeatMode = 'all';
        elements.audio.loop = false;
        elements.repeatBtn.innerHTML = icons.repeatAll;
        elements.repeatBtn.style.color = 'var(--primary)';
    } else if (state.repeatMode === 'all') {
        state.repeatMode = 'one';
        elements.audio.loop = true;
        elements.repeatBtn.innerHTML = icons.repeatOne;
        elements.repeatBtn.style.color = 'var(--primary)';
    } else {
        state.repeatMode = 'none';
        elements.audio.loop = false;
        elements.repeatBtn.innerHTML = icons.repeatAll;
        elements.repeatBtn.style.color = 'var(--text-muted)';
    }
};

// Event Listeners
elements.playBtn.addEventListener('click', togglePlay);
elements.nextBtn.addEventListener('click', next);
elements.prevBtn.addEventListener('click', prev);
elements.shuffleBtn.addEventListener('click', toggleShuffle);
elements.repeatBtn.addEventListener('click', cycleRepeat);

elements.audio.addEventListener('ended', next);

// Audio Progress Loop using requestAnimationFrame
const updateProgress = () => {
    if (!elements.audio.paused && elements.audio.duration) {
        const percent = (elements.audio.currentTime / elements.audio.duration) * 100;
        elements.progress.value = percent;
        elements.timeDisplay.textContent = `${formatTime(elements.audio.currentTime)} / ${formatTime(elements.audio.duration)}`;
    }
    requestAnimationFrame(updateProgress);
};
requestAnimationFrame(updateProgress);

// Seek control
elements.progress.addEventListener('input', (e) => {
    if (elements.audio.duration) {
        const time = (e.target.value / 100) * elements.audio.duration;
        elements.audio.currentTime = time;
    }
});

elements.audio.addEventListener('loadedmetadata', () => {
    elements.timeDisplay.textContent = `${formatTime(elements.audio.currentTime)} / ${formatTime(elements.audio.duration)}`;
});

// Category and Playlist Navigation
document.querySelectorAll('#category-list li[data-category]').forEach(li => {
    li.addEventListener('click', () => {
        // Remove active class from all
        document.querySelectorAll('#category-list li').forEach(el => el.classList.remove('active'));
        li.classList.add('active');
        
        const catId = li.dataset.category;
        renderAlbumList(catId);
        renderTrackList(getTracksFromCategory(catId), li.textContent);
        closeSidebar();
    });
});

if (elements.shuffleIndoBtn) {
    elements.shuffleIndoBtn.addEventListener('click', () => {
        playCategoryShuffle('all');
    });
}

// Live Search Feature
const searchInput = document.getElementById('search-input');
if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        const allTracks = getTracksFromCategory('all');
        
        if (query.trim() === '') {
            const activeCategory = document.querySelector('#category-list li.active');
            const catId = activeCategory ? activeCategory.dataset.category : 'all';
            renderTrackList(getTracksFromCategory(catId), activeCategory ? activeCategory.textContent : 'Semua Lagu');
            return;
        }

        const filtered = allTracks.filter(track => 
            track.title.toLowerCase().includes(query) || 
            (track.artist && track.artist.toLowerCase().includes(query))
        );
        
        renderTrackList(filtered, `Hasil Pencarian: "${query}"`);
    });
}

// Init Media Session
const updateMediaSession = (track) => {
    if ('mediaSession' in navigator) {
        navigator.mediaSession.metadata = new MediaMetadata({
            title: track.title,
            artist: track.artist || 'Unknown Artist',
            album: track.album ? track.album.title : 'KoncoNembang'
        });

        navigator.mediaSession.setActionHandler('play', play);
        navigator.mediaSession.setActionHandler('pause', pause);
        navigator.mediaSession.setActionHandler('previoustrack', prev);
        navigator.mediaSession.setActionHandler('nexttrack', next);
    }
};

// Initialization
const init = () => {
    renderPlaylists();
    // Load default view (All tracks)
    renderAlbumList('all');
    renderTrackList(getTracksFromCategory('all'), 'Semua Lagu');
};

init();
