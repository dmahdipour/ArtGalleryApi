<div
    id="pwa-install-modal"
    class="hidden fixed inset-0 z-[9999] items-center justify-center
           bg-black/50 backdrop-blur-sm p-5"
    dir="rtl"
>
    <div
        class="relative w-full max-w-[400px] overflow-hidden
               rounded-[28px] bg-[#faf9f5] shadow-2xl
               transition-all duration-300"
    >

        {{-- Close --}}
        <button
            type="button"
            id="pwa-modal-close"
            class="absolute left-4 top-4 z-10 flex h-9 w-9
                   items-center justify-center rounded-full
                   bg-gray-200/70 text-gray-600
                   hover:bg-gray-300"
            aria-label="بستن"
        >
            ✕
        </button>

        <div class="px-6 pb-6 pt-8 text-center">

            {{-- Logo --}}
            <div
                class="mx-auto mb-5 flex h-20 w-20 items-center
                       justify-center rounded-3xl bg-white
                       shadow-sm"
            >
                <span class="text-4xl font-bold text-[#8d7650]">
                    @php
                        use App\Models\Setting;
                        $site_logo = Setting::where('name', 'logo')->first()->file_path ?? '/images/logo.png';
                    @endphp
                    <img src="/storage/{{ $site_logo }}" class="w-16 h-16" />
                </span>
            </div>

            {{-- Title --}}
            <h2 class="mb-3 text-lg font-bold text-[#17352a]">
                سمفونی رنگ را نصب کنید
            </h2>

            <p class="mb-6 text-sm leading-7 text-gray-500">
                برای دسترسی سریع‌تر به گالری و تجربه بهتر،
                اپلیکیشن سمفونی رنگ را به صفحه اصلی گوشی خود اضافه کنید.
            </p>

            {{-- Benefits --}}
            <div class="mb-6 space-y-3 text-right">

                <div class="flex items-center gap-3 rounded-2xl
                            bg-white p-4 shadow-sm">

                    <div class="flex h-10 w-10 shrink-0 items-center
                                justify-center rounded-full bg-[#f7f5ef]">
                        <span class="text-xl">⚡</span>
                    </div>

                    <div>
                        <div class="text-sm font-bold text-gray-800">
                            دسترسی سریع
                        </div>

                        <div class="mt-1 text-xs text-gray-500">
                            بدون نیاز به باز کردن مرورگر
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 rounded-2xl
                            bg-white p-4 shadow-sm">

                    <div class="flex h-10 w-10 shrink-0 items-center
                                justify-center rounded-full bg-[#f7f5ef]">
                        <span class="text-xl">🎨</span>
                    </div>

                    <div>
                        <div class="text-sm font-bold text-gray-800">
                            تجربه بهتر گالری
                        </div>

                        <div class="mt-1 text-xs text-gray-500">
                            محیطی شبیه اپلیکیشن‌های موبایل
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 rounded-2xl
                            bg-white p-4 shadow-sm">

                    <div class="flex h-10 w-10 shrink-0 items-center
                                justify-center rounded-full bg-[#f7f5ef]">
                        <span class="text-xl">🔔</span>
                    </div>

                    <div>
                        <div class="text-sm font-bold text-gray-800">
                            اطلاع از آثار جدید
                        </div>

                        <div class="mt-1 text-xs text-gray-500">
                            امکان دریافت اعلان‌های جدید
                        </div>
                    </div>
                </div>

            </div>

            {{-- Install button --}}
            <button
                type="button"
                id="pwa-install-button"
                class="w-full rounded-2xl bg-[#17352a] px-5 py-4
                       text-sm font-bold text-white
                       transition hover:bg-[#244b3c]"
            >
                نصب اپلیکیشن
            </button>

            {{-- iOS guide --}}
            <div
                id="pwa-ios-guide"
                class="mt-4 hidden rounded-2xl bg-white p-4 text-right"
            >
                <h3 class="mb-3 text-sm font-bold text-[#17352a]">
                    راهنمای نصب در آیفون
                </h3>

                <div class="space-y-3 text-sm leading-7 text-gray-600">

                    <div>
                        <span class="font-bold text-[#8d7650]">۱.</span>
                        در مرورگر Safari روی دکمه Share بزنید.
                        <span class="font-bold"> (مربع و فلش رو به بالا)</span>
                    </div>

                    <div>
                        <span class="font-bold text-[#8d7650]">۲.</span>
                        گزینه Add to Home Screen را انتخاب کنید.
                    </div>

                    <div>
                        <span class="font-bold text-[#8d7650]">۳.</span>
                        گزینه Add را انتخاب کنید.
                    </div>

                </div>
            </div>

            {{-- Android manual guide --}}
            <div
                id="pwa-android-guide"
                class="mt-4 hidden rounded-2xl bg-white p-4 text-right"
            >
                <h3 class="mb-2 text-sm font-bold text-[#17352a]">
                    راهنمای نصب
                </h3>

                <p class="text-sm leading-7 text-gray-600">
                    از منوی سه‌نقطه مرورگر، گزینه
                    <strong>Install app</strong>
                    یا
                    <strong>Add to Home screen</strong>
                    را انتخاب کنید.
                </p>
            </div>

            {{-- Dismiss --}}
            <button
                type="button"
                id="pwa-modal-dismiss"
                class="mt-3 w-full rounded-2xl bg-[#e9e7e1]
                       px-5 py-3.5 text-sm font-semibold
                       text-gray-600 transition hover:bg-[#dedbd2]"
            >
                فعلاً نه
            </button>

        </div>
    </div>
</div>


@once
<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('pwa-install-modal');

    if (!modal) return;

    const installButton = document.getElementById('pwa-install-button');
    const closeButton = document.getElementById('pwa-modal-close');
    const dismissButton = document.getElementById('pwa-modal-dismiss');

    const iosGuide = document.getElementById('pwa-ios-guide');
    const androidGuide = document.getElementById('pwa-android-guide');

    const STORAGE_KEY = 'samfonyrang_pwa_dismissed_until';

    let deferredPrompt = null;

    const isMobile = window.matchMedia('(max-width: 767px)').matches;

    const isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent) ||
        (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

    const isStandalone =
        window.matchMedia('(display-mode: standalone)').matches ||
        window.navigator.standalone === true;

    const isAndroid = /Android/i.test(navigator.userAgent);

    // فقط موبایل و فقط در صورت نصب نبودن PWA
    if (!isMobile || isStandalone) {
        return;
    }

    // بررسی زمان نمایش مجدد
    function isDismissed() {
        try {
            const dismissedUntil = Number(
                localStorage.getItem(STORAGE_KEY) || 0
            );

            return Date.now() < dismissedUntil;
        } catch (error) {
            return false;
        }
    }

    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function hideModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // نمایش پنجره
    if (!isDismissed()) {
        setTimeout(showModal, 1200);
    }

    // دریافت رویداد نصب مرورگر
    window.addEventListener('beforeinstallprompt', function (event) {

        event.preventDefault();

        deferredPrompt = event;

        installButton.textContent = 'نصب اپلیکیشن';

    });

    // نصب موفق
    window.addEventListener('appinstalled', function () {

        deferredPrompt = null;

        hideModal();

    });

    // کلیک روی دکمه نصب
    installButton.addEventListener('click', async function () {

        iosGuide.classList.add('hidden');
        androidGuide.classList.add('hidden');

        // نصب مستقیم در مرورگرهای پشتیبانی‌شده
        if (deferredPrompt) {

            deferredPrompt.prompt();

            const result = await deferredPrompt.userChoice;

            if (result.outcome === 'accepted') {
                hideModal();
            }

            deferredPrompt = null;

            return;
        }

        // راهنمای iOS
        if (isIOS) {

            iosGuide.classList.remove('hidden');

            installButton.textContent = 'راهنمای نصب نمایش داده شد';

            return;
        }

        // راهنمای نصب دستی اندروید
        if (isAndroid) {

            androidGuide.classList.remove('hidden');

            installButton.textContent = 'راهنمای نصب نمایش داده شد';

            return;
        }

    });

    // بستن موقت پنجره
    function dismissModal() {

        try {
            const sevenDays = 7 * 24 * 60 * 60 * 1000;

            localStorage.setItem(
                STORAGE_KEY,
                String(Date.now() + sevenDays)
            );
        } catch (error) {
            console.warn('LocalStorage unavailable');
        }

        hideModal();
    }

    dismissButton.addEventListener('click', dismissModal);

    closeButton.addEventListener('click', dismissModal);

    // کلیک روی فضای بیرون کارت
    modal.addEventListener('click', function (event) {

        if (event.target === modal) {
            dismissModal();
        }

    });

});
</script>
@endonce