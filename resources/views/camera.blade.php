@extends('layouts.app')

@section('title', 'Capture - Photobooth')

@section('content')
<div class="flex flex-col lg:flex-row gap-8 w-full max-w-6xl mx-auto items-start py-8">
    
    <!-- Camera Section -->
    <div class="w-full lg:w-2/3 glass-card p-6 flex flex-col relative overflow-hidden">
        <!-- Mockup Header -->
        <div class="flex items-center gap-2 mb-4 border-b border-white/50 pb-4">
            <div class="w-3 h-3 rounded-full bg-red-400 shadow-inner shadow-red-200"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-400 shadow-inner shadow-yellow-200"></div>
            <div class="w-3 h-3 rounded-full bg-green-400 shadow-inner shadow-green-200"></div>
            <div class="ml-4 font-mono text-xs text-text-secondary">/dev/video0 - Live Capture</div>
        </div>

        <div id="camera-container" class="relative bg-white/50 backdrop-blur-sm rounded-2xl overflow-hidden aspect-[4/3] flex items-center justify-center border border-white shadow-inner">
            <video id="video" autoplay playsinline class="hidden"></video>
            <canvas id="preview-canvas" class="absolute inset-0 w-full h-full object-contain"></canvas>
            <canvas id="canvas" class="hidden"></canvas>
            
            <!-- Countdown Overlay -->
            <div id="countdown-overlay" class="absolute inset-0 bg-white/70 hidden items-center justify-center z-20 backdrop-blur-sm">
                <span id="countdown-text" class="text-[120px] font-display font-bold text-accent-pink">3</span>
            </div>
            
            <!-- Flash Overlay -->
            <div id="flash-overlay" class="absolute inset-0 bg-white hidden z-30 opacity-0 transition-opacity duration-100"></div>

            <!-- Start Camera Prompt -->
            <div id="start-prompt" class="absolute z-10 flex flex-col items-center p-8 bg-white/90 rounded-2xl border border-white shadow-xl backdrop-blur-md max-w-sm text-center">
                <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-accent-pink to-accent-rose flex items-center justify-center mb-4 shadow-md text-white">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                </div>
                <h3 class="font-display font-bold text-lg mb-2 text-text-main">Enable Camera</h3>
                <select id="camera-select" class="w-full mb-4 px-4 py-2.5 rounded-xl bg-gray-50 text-text-main text-sm font-medium border border-gray-200 focus:outline-none focus:ring-2 focus:ring-accent-pink focus:border-transparent transition-all">
                    <option value="">Loading cameras...</option>
                </select>
                <button id="start-btn" class="btn-gradient w-full py-3 rounded-full font-semibold text-sm shadow-md mb-3">Allow Access</button>
                <p class="text-xs text-text-secondary">Permission required to stream.</p>
            </div>
        </div>
        
        <!-- Camera Controls -->
        <div class="mt-8 flex items-center justify-between px-4">
            <!-- Filters -->
            <div class="flex gap-3 bg-white/50 p-2 rounded-full border border-white shadow-sm">
                <button class="filter-btn active w-12 h-12 rounded-full border-2 border-accent-pink overflow-hidden shadow-sm hover:scale-105 transition-transform" data-filter="none">
                    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover" alt="Normal">
                </button>
                <button class="filter-btn w-12 h-12 rounded-full border-2 border-transparent hover:border-gray-300 overflow-hidden shadow-sm grayscale hover:scale-105 transition-transform" data-filter="grayscale(100%)">
                    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover" alt="B&W">
                </button>
                <button class="filter-btn w-12 h-12 rounded-full border-2 border-transparent hover:border-gray-300 overflow-hidden shadow-sm sepia hover:scale-105 transition-transform" data-filter="sepia(80%)">
                    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover" alt="Vintage">
                </button>
            </div>
            
            <!-- Capture Button -->
            <button id="capture-btn" class="w-20 h-20 rounded-full bg-white border-[3px] border-accent-pink flex items-center justify-center hover:bg-gray-50 transition-colors shadow-lg disabled:opacity-50 disabled:cursor-not-allowed group hover:scale-105 active:scale-95" disabled>
                <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-accent-pink to-accent-rose group-hover:from-accent-rose group-hover:to-pink-500 transition-colors shadow-inner"></div>
            </button>
            
            <!-- Retake -->
            <button id="retake-btn" class="w-12 h-12 rounded-full bg-white border border-gray-200 flex items-center justify-center text-text-secondary hover:text-accent-pink hover:bg-pink-50 transition-colors shadow-sm disabled:opacity-50 disabled:cursor-not-allowed" title="Retake Last Photo" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
            </button>
        </div>
    </div>
    
    <!-- Sidebar / Selection -->
    <div class="w-full lg:w-1/3 flex flex-col gap-6">
        
        <!-- Status & Progress -->
        <div class="glass-card p-6 border-t-[4px] border-t-accent-pink">
            <h3 class="font-display font-semibold text-lg mb-4 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-green-400 shadow-[0_0_8px_rgba(74,222,128,0.6)]"></span> 
                Session Status
            </h3>
            <div class="flex items-center justify-between mb-3 text-sm">
                <span class="text-text-secondary font-medium">Frames captured</span>
                <span class="font-bold text-text-main bg-white px-3 py-1 rounded-full shadow-sm"><span id="photo-count">0</span> / <span id="max-photos">4</span></span>
            </div>
            <div class="w-full bg-gray-200/60 rounded-full h-2.5 mb-6 shadow-inner">
                <div id="progress-bar" class="bg-gradient-to-r from-accent-pink to-accent-rose h-2.5 rounded-full transition-all duration-300 shadow-sm" style="width: 0%"></div>
            </div>
            
            <!-- Mini grid of taken photos -->
            <div id="mini-gallery" class="grid grid-cols-4 gap-3 min-h-[80px]">
                <div class="aspect-[3/4] bg-gray-100/80 border border-white rounded-lg shadow-sm"></div>
                <div class="aspect-[3/4] bg-gray-100/80 border border-white rounded-lg shadow-sm"></div>
                <div class="aspect-[3/4] bg-gray-100/80 border border-white rounded-lg shadow-sm"></div>
                <div class="aspect-[3/4] bg-gray-100/80 border border-white rounded-lg shadow-sm"></div>
            </div>
        </div>

        <!-- Frame Selection -->
        <div class="glass-card p-6 flex-grow">
            <h3 class="font-display font-semibold text-lg mb-5 text-text-main">Template Selection</h3>
            <div class="grid grid-cols-2 gap-4 mb-8">
                <!-- Template Option 1 -->
                <button class="template-btn active relative aspect-[2/3] bg-white rounded-xl border-[3px] border-accent-pink overflow-hidden group shadow-md hover:shadow-lg transition-all" data-frames="4" data-template="4-cut-classic">
                    <div class="absolute inset-2 flex flex-col gap-1.5 z-10">
                        <div class="bg-gray-100 flex-1 rounded-md border border-gray-200"></div>
                        <div class="bg-gray-100 flex-1 rounded-md border border-gray-200"></div>
                        <div class="bg-gray-100 flex-1 rounded-md border border-gray-200"></div>
                        <div class="bg-gray-100 flex-1 rounded-md border border-gray-200"></div>
                    </div>
                    <div class="absolute inset-x-0 bottom-0 h-10 bg-white z-20 flex items-center justify-center">
                        <span class="text-[9px] text-text-main font-display font-bold uppercase tracking-widest">Photobooth</span>
                    </div>
                </button>
                <!-- Template Option 2 -->
                <button class="template-btn relative aspect-[2/3] bg-[#1d1d1f] rounded-xl border-[3px] border-transparent hover:border-gray-300 overflow-hidden group shadow-sm hover:shadow-md transition-all" data-frames="4" data-template="4-cut-dark">
                    <div class="absolute inset-2 flex flex-col gap-1.5 z-10">
                        <div class="bg-[#2d2d2f] flex-1 rounded-md border border-[#3d3d3f]"></div>
                        <div class="bg-[#2d2d2f] flex-1 rounded-md border border-[#3d3d3f]"></div>
                        <div class="bg-[#2d2d2f] flex-1 rounded-md border border-[#3d3d3f]"></div>
                        <div class="bg-[#2d2d2f] flex-1 rounded-md border border-[#3d3d3f]"></div>
                    </div>
                    <div class="absolute inset-x-0 bottom-0 h-10 bg-[#1d1d1f] z-20 flex items-center justify-center">
                        <span class="text-[9px] text-white font-display font-bold uppercase tracking-widest">Photobooth</span>
                    </div>
                </button>
            </div>
            
            <form id="upload-form" action="{{ route('camera.upload') }}" method="POST">
                @csrf
                <input type="hidden" name="template" id="selected-template" value="4-cut-classic">
                <input type="hidden" name="photos" id="photos-data" value="[]">
                <input type="hidden" name="final_strip" id="final-strip-data" value="">
                
                <button type="submit" id="finish-btn" class="btn-gradient w-full py-3.5 rounded-full shadow-lg font-semibold text-white disabled:opacity-50 disabled:cursor-not-allowed flex justify-center items-center gap-2 hover:scale-[1.02] active:scale-[0.98] transition-all" disabled>
                    <span>Render Artifact</span>
                </button>
            </form>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const video = document.getElementById('video');
        const previewCanvas = document.getElementById('preview-canvas');
        const previewCtx = previewCanvas.getContext('2d', { willReadFrequently: true });
        const canvas = document.getElementById('canvas');
        const startBtn = document.getElementById('start-btn');
        const startPrompt = document.getElementById('start-prompt');
        const captureBtn = document.getElementById('capture-btn');
        const retakeBtn = document.getElementById('retake-btn');
        const finishBtn = document.getElementById('finish-btn');
        const countdownOverlay = document.getElementById('countdown-overlay');
        const countdownText = document.getElementById('countdown-text');
        const flashOverlay = document.getElementById('flash-overlay');
        const photoCountEl = document.getElementById('photo-count');
        const maxPhotosEl = document.getElementById('max-photos');
        const miniGallery = document.getElementById('mini-gallery');
        const filterBtns = document.querySelectorAll('.filter-btn');
        const templateBtns = document.querySelectorAll('.template-btn');
        const photosDataInput = document.getElementById('photos-data');
        const uploadForm = document.getElementById('upload-form');
        const selectedTemplateInput = document.getElementById('selected-template');
        const cameraSelect = document.getElementById('camera-select');
        
        let stream = null;
        let photos = [];
        let maxPhotos = 4;
        let currentFilter = 'none';
        let animFrameId = null;

        // Enumerate available cameras and populate the dropdown
        async function loadCameraList() {
            try {
                // Request temporary permission to get device labels
                const tempStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                tempStream.getTracks().forEach(t => t.stop());
                
                const devices = await navigator.mediaDevices.enumerateDevices();
                const videoDevices = devices.filter(d => d.kind === 'videoinput');
                
                cameraSelect.innerHTML = '';
                if (videoDevices.length === 0) {
                    cameraSelect.innerHTML = '<option value="">No camera found</option>';
                    return;
                }
                
                videoDevices.forEach((device, i) => {
                    const option = document.createElement('option');
                    option.value = device.deviceId;
                    option.textContent = device.label || `Camera ${i + 1}`;
                    // Auto-select DroidCam if found
                    if (device.label.toLowerCase().includes('droidcam')) {
                        option.selected = true;
                    }
                    cameraSelect.appendChild(option);
                });
            } catch (err) {
                console.warn('Could not enumerate cameras:', err);
                cameraSelect.innerHTML = '<option value="">Default camera</option>';
            }
        }
        
        loadCameraList();

        // Render video frames to preview canvas (bypasses DroidCam green screen)
        function renderPreviewFrame() {
            if (video.readyState >= video.HAVE_CURRENT_DATA && video.videoWidth > 0) {
                // Match canvas internal resolution to video
                if (previewCanvas.width !== video.videoWidth || previewCanvas.height !== video.videoHeight) {
                    previewCanvas.width = video.videoWidth;
                    previewCanvas.height = video.videoHeight;
                }
                
                previewCtx.save();
                // Mirror horizontally
                previewCtx.translate(previewCanvas.width, 0);
                previewCtx.scale(-1, 1);
                // Apply CSS filter
                previewCtx.filter = currentFilter;
                previewCtx.drawImage(video, 0, 0, previewCanvas.width, previewCanvas.height);
                previewCtx.restore();
            }
            animFrameId = requestAnimationFrame(renderPreviewFrame);
        }

        uploadForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            finishBtn.setAttribute('disabled', 'true');
            finishBtn.innerHTML = 'Rendering...';
            
            try {
                const finalStripBase64 = await generateStrip(photos, selectedTemplateInput.value, maxPhotos);
                document.getElementById('final-strip-data').value = finalStripBase64;
                this.submit();
            } catch (err) {
                console.error("Error rendering strip:", err);
                alert("Failed to render artifact. Please try again.");
                finishBtn.removeAttribute('disabled');
                finishBtn.innerHTML = 'Render Artifact';
            }
        });

        function generateStrip(photoUrls, template, max) {
            return new Promise((resolve) => {
                const stripCanvas = document.createElement('canvas');
                const ctx = stripCanvas.getContext('2d');
                
                const padding = 40;
                const gap = 20;
                const bottomSpace = 160;
                const photoWidth = 600;
                const photoHeight = 450;
                
                stripCanvas.width = photoWidth + (padding * 2);
                stripCanvas.height = padding + (photoHeight * max) + (gap * (max - 1)) + bottomSpace;
                
                const isDark = template === '4-cut-dark';
                ctx.fillStyle = isDark ? '#1d1d1f' : '#ffffff';
                ctx.fillRect(0, 0, stripCanvas.width, stripCanvas.height);
                
                let loadedCount = 0;
                const imgs = [];
                
                if (photoUrls.length === 0) return resolve(null);
                
                photoUrls.forEach((url, i) => {
                    const img = new Image();
                    img.onload = () => {
                        imgs[i] = img;
                        loadedCount++;
                        if (loadedCount === max) {
                            imgs.forEach((im, index) => {
                                const y = padding + (index * (photoHeight + gap));
                                ctx.drawImage(im, padding, y, photoWidth, photoHeight);
                                
                                // Draw an inner border/shadow for premium look
                                ctx.strokeStyle = isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)';
                                ctx.lineWidth = 2;
                                ctx.strokeRect(padding, y, photoWidth, photoHeight);
                            });
                            
                            ctx.fillStyle = isDark ? '#ffffff' : '#1d1d1f';
                            ctx.font = 'bold 44px "Plus Jakarta Sans", sans-serif';
                            ctx.textAlign = 'center';
                            // Track spacing slightly by drawing characters if we wanted to get fancy, but normal fillText is fine
                            ctx.fillText('PHOTOBOOTH', stripCanvas.width / 2, stripCanvas.height - 60);
                            
                            resolve(stripCanvas.toDataURL('image/jpeg', 0.95));
                        }
                    };
                    img.src = url;
                });
            });
        }
        
        // Start Camera
        startBtn.addEventListener('click', async () => {
            try {
                // Stop any previous stream
                if (stream) {
                    stream.getTracks().forEach(t => t.stop());
                    stream = null;
                }
                if (animFrameId) {
                    cancelAnimationFrame(animFrameId);
                    animFrameId = null;
                }

                const selectedDeviceId = cameraSelect.value;
                
                // Build constraints - use specific device if selected
                const constraints = {
                    video: selectedDeviceId 
                        ? { deviceId: { exact: selectedDeviceId } }
                        : true,
                    audio: false
                };
                
                stream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = stream;
                
                // Wait for video metadata to load
                await new Promise((resolve, reject) => {
                    const timeout = setTimeout(() => reject(new Error('Video load timeout')), 8000);
                    video.onloadedmetadata = () => {
                        clearTimeout(timeout);
                        video.play().then(resolve).catch(reject);
                    };
                });
                
                console.log(`Camera started: ${video.videoWidth}x${video.videoHeight}`);
                
                // Start canvas-based preview rendering (bypasses green screen issue)
                renderPreviewFrame();
                
                startPrompt.classList.add('hidden');
                captureBtn.removeAttribute('disabled');
            } catch (err) {
                console.error("Error accessing camera: ", err);
                alert("Could not access camera. Please check:\n1. DroidCam is connected and running\n2. Camera permission is allowed\n3. Try selecting a different camera from the dropdown");
            }
        });
        
        // Apply Filter
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('border-accent-pink', 'active'));
                filterBtns.forEach(b => b.classList.add('border-transparent'));
                btn.classList.remove('border-transparent');
                btn.classList.add('border-accent-pink', 'active');
                
                currentFilter = btn.dataset.filter;
                // Filter is applied in renderPreviewFrame, no need to set on video
            });
        });
        
        // Select Template
        templateBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (photos.length > 0) {
                    if(!confirm("Changing template will reset your current session. Continue?")) return;
                    resetSession();
                }
                
                templateBtns.forEach(b => {
                    b.classList.remove('border-accent-pink');
                    b.classList.add('border-transparent');
                });
                btn.classList.remove('border-transparent');
                btn.classList.add('border-accent-pink');
                
                maxPhotos = parseInt(btn.dataset.frames);
                maxPhotosEl.textContent = maxPhotos;
                selectedTemplateInput.value = btn.dataset.template;
                
                // Update mini gallery placeholders
                miniGallery.innerHTML = '';
                for(let i=0; i<maxPhotos; i++) {
                    miniGallery.innerHTML += '<div class="aspect-[3/4] bg-gray-100/80 border border-white rounded-lg shadow-sm"></div>';
                }
                
                updateProgress();
            });
        });
        
        // Capture logic
        captureBtn.addEventListener('click', () => {
            if (photos.length >= maxPhotos) return;
            
            captureBtn.setAttribute('disabled', 'true');
            let count = 3;
            countdownOverlay.classList.remove('hidden');
            countdownOverlay.classList.add('flex');
            countdownText.textContent = count;
            
            const timer = setInterval(() => {
                count--;
                if (count > 0) {
                    countdownText.textContent = count;
                } else {
                    clearInterval(timer);
                    countdownOverlay.classList.add('hidden');
                    countdownOverlay.classList.remove('flex');
                    takePhoto();
                }
            }, 1000);
        });
        
        function takePhoto() {
            // Flash effect
            flashOverlay.classList.remove('hidden');
            flashOverlay.classList.remove('opacity-0');
            flashOverlay.classList.add('opacity-100');
            
            setTimeout(() => {
                flashOverlay.classList.remove('opacity-100');
                flashOverlay.classList.add('opacity-0');
                setTimeout(() => flashOverlay.classList.add('hidden'), 100);
            }, 50);
            
            // Capture from the preview canvas (already mirrored and filtered)
            canvas.width = previewCanvas.width;
            canvas.height = previewCanvas.height;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(previewCanvas, 0, 0);
            
            const photoDataUrl = canvas.toDataURL('image/jpeg', 0.9);
            photos.push(photoDataUrl);
            
            updateProgress();
            
            if (photos.length < maxPhotos) {
                captureBtn.removeAttribute('disabled');
            } else {
                finishBtn.removeAttribute('disabled');
            }
            retakeBtn.removeAttribute('disabled');
        }
        
        // Retake last
        retakeBtn.addEventListener('click', () => {
            if (photos.length === 0) return;
            photos.pop();
            updateProgress();
            captureBtn.removeAttribute('disabled');
            finishBtn.setAttribute('disabled', 'true');
            if (photos.length === 0) {
                retakeBtn.setAttribute('disabled', 'true');
            }
        });
        
        function updateProgress() {
            photoCountEl.textContent = photos.length;
            const percent = (photos.length / maxPhotos) * 100;
            document.getElementById('progress-bar').style.width = percent + '%';
            
            // Update thumbnails
            const thumbnails = miniGallery.children;
            for(let i=0; i<maxPhotos; i++) {
                if (i < photos.length) {
                    thumbnails[i].innerHTML = `<img src="${photos[i]}" class="w-full h-full object-cover rounded-lg border-2 border-accent-pink shadow-md filter brightness-110">`;
                } else {
                    thumbnails[i].innerHTML = '';
                    thumbnails[i].className = 'aspect-[3/4] bg-gray-100/80 border border-white rounded-lg shadow-sm';
                }
            }
            
            photosDataInput.value = JSON.stringify(photos);
        }
        
        function resetSession() {
            photos = [];
            updateProgress();
            captureBtn.removeAttribute('disabled');
            finishBtn.setAttribute('disabled', 'true');
            retakeBtn.setAttribute('disabled', 'true');
        }
    });
</script>
@endsection
