-- Database: `newagroptimal` website saya ini AgroOptimal
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 03:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newagroptimal`
--

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','publish') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `judul`, `slug`, `kategori`, `foto`, `ringkasan`, `konten`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hijab', 'hijab', 'Pupuk', 'berita/tCBHE0X0lPBHE9UZrf3SOZL5ZoGfvJygetACca0G.webp', 'Illuminate\\Database\\Eloquent\\MassAssignmentExceptionvendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Model.php:624Add [judul] to fillable pro...', '<h1 class=\"text-3xl font-semibold text-neutral-950 dark:text-white\" style=\"font-size: 30px; font-weight: 600; line-height: 1.2; --tw-font-weight: 600; color: oklch(0.145 0 0); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; background-color: oklch(0.985 0 0);\">Illuminate\\Database\\Eloquent\\MassAssignmentException</h1><div class=\"truncate font-mono text-xs text-neutral-500 dark:text-neutral-400 -mt-3 text-xs\" dir=\"ltr\" style=\"margin-top: -12px; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, &quot;Liberation Mono&quot;, &quot;Courier New&quot;, monospace; font-size: 12px; line-height: 1.33333; color: oklch(0.556 0 0); background-color: oklch(0.985 0 0);\"><span data-tippy-content=\"vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Model.php:624\">vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Model.php<span class=\"text-neutral-500\" style=\"color: oklch(0.556 0 0);\">:624</span></span></div><p class=\"text-xl font-light text-neutral-800 dark:text-neutral-300\" style=\"font-size: 20px; line-height: 1.4; --tw-font-weight: 300; font-weight: 300; color: oklch(0.269 0 0); font-family: ui-sans-serif, system-ui, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; background-color: oklch(0.985 0 0);\">Add [judul] to fillable property to allow mass assignment on [App\\Models\\Berita].</p>', 'publish', '2026-01-15 03:03:06', '2026-01-15 03:03:06'),
(2, 'hijibur', 'hijibur', 'Teknologi', 'berita/T8bn66NPPgshBBV9oRFylklvUxBk0wsIxtFPnzqj.webp', '✅ SOLUSI RESMI LARAVEL 12 (SATSET &amp; BENAR)\r\n1️⃣ Buat middleware admin (kalau belum)\r\nKalau sudah bikin, lewati langkah ini.\r\nphp artisan make:mid...', '<div class=\"flex flex-col text-sm pb-25\"><article class=\"text-token-text-primary w-full focus:outline-none [--shadow-height:45px] has-data-writing-block:pointer-events-none has-data-writing-block:-mt-(--shadow-height) has-data-writing-block:pt-(--shadow-height) [&amp;:has([data-writing-block])&gt;*]:pointer-events-auto scroll-mt-[calc(var(--header-height)+min(200px,max(70px,20svh)))]\" tabindex=\"-1\" dir=\"auto\" data-turn-id=\"request-WEB:0af26c59-9a25-4fbc-bdce-ad919fbe4726-13\" data-testid=\"conversation-turn-24\" data-scroll-anchor=\"true\" data-turn=\"assistant\"><div class=\"text-base my-auto mx-auto pb-10 [--thread-content-margin:--spacing(4)] @w-sm/main:[--thread-content-margin:--spacing(6)] @w-lg/main:[--thread-content-margin:--spacing(16)] px-(--thread-content-margin)\"><div class=\"[--thread-content-max-width:40rem] @w-lg/main:[--thread-content-max-width:48rem] mx-auto max-w-(--thread-content-max-width) flex-1 group/turn-messages focus-visible:outline-hidden relative flex w-full min-w-0 flex-col agent-turn\" tabindex=\"-1\"><div class=\"flex max-w-full flex-col grow\"><div data-message-author-role=\"assistant\" data-message-id=\"dbb0b659-f49a-4f0a-a67a-5631e39abccb\" dir=\"auto\" class=\"min-h-8 text-message relative flex w-full flex-col items-end gap-2 text-start break-words whitespace-normal [.text-message+&amp;]:mt-1\" data-message-model-slug=\"gpt-5-2\"><div class=\"flex w-full flex-col gap-1 empty:hidden first:pt-[1px]\"><div class=\"markdown prose dark:prose-invert w-full break-words dark markdown-new-styling\"><h2 data-start=\"483\" data-end=\"528\">✅ SOLUSI RESMI LARAVEL 12 (SATSET &amp; BENAR)</h2>\r\n<h3 data-start=\"530\" data-end=\"573\">1️⃣ Buat middleware admin (kalau belum)</h3>\r\n<p data-start=\"574\" data-end=\"616\">Kalau sudah bikin, <strong data-start=\"593\" data-end=\"615\">lewati langkah ini</strong>.</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"618\" data-end=\"673\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre! language-bash\">php artisan make:middleware AdminMiddleware\r\n</code></div></div></pre>\r\n<p data-start=\"675\" data-end=\"680\">File:</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"681\" data-end=\"728\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre!\">app<span class=\"hljs-regexp\">/Http/</span><span class=\"hljs-type\">Middleware</span><span class=\"hljs-operator\">/</span><span class=\"hljs-type\">AdminMiddleware</span>.php\r\n</code></div></div></pre>\r\n<p data-start=\"730\" data-end=\"767\">Isi dulu <strong data-start=\"739\" data-end=\"766\">simple (loloskan semua)</strong>:</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"768\" data-end=\"990\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre! language-php\"><span class=\"hljs-meta\">&lt;?php</span>\r\n\r\n<span class=\"hljs-keyword\">namespace</span> <span class=\"hljs-title class_\">App</span>\\<span class=\"hljs-title class_\">Http</span>\\<span class=\"hljs-title class_\">Middleware</span>;\r\n\r\n<span class=\"hljs-keyword\">use</span> <span class=\"hljs-title\">Closure</span>;\r\n<span class=\"hljs-keyword\">use</span> <span class=\"hljs-title\">Illuminate</span>\\<span class=\"hljs-title\">Http</span>\\<span class=\"hljs-title\">Request</span>;\r\n\r\n<span class=\"hljs-class\"><span class=\"hljs-keyword\">class</span></span> <span class=\"hljs-title\">AdminMiddleware</span>\r\n{\r\n    <span class=\"hljs-keyword\">public</span> <span class=\"hljs-function\"><span class=\"hljs-keyword\">function</span></span> <span class=\"hljs-title\">handle</span>(<span class=\"hljs-params\">Request <span class=\"hljs-variable\">$request</span></span>, <span class=\"hljs-built_in\">Closure</span> <span class=\"hljs-variable\">$next</span>)\r\n    {\r\n        <span class=\"hljs-keyword\">return</span> <span class=\"hljs-variable\">$next</span>(<span class=\"hljs-variable\">$request</span>);\r\n    }\r\n}\r\n</code></div></div></pre>\r\n<hr data-start=\"992\" data-end=\"995\">\r\n<h3 data-start=\"997\" data-end=\"1048\">2️⃣ DAFTARKAN MIDDLEWARE DI <code data-start=\"1029\" data-end=\"1048\">bootstrap/app.php</code></h3>\r\n<p data-start=\"1049\" data-end=\"1070\">📌 <strong data-start=\"1052\" data-end=\"1070\">INI POIN UTAMA</strong></p>\r\n<p data-start=\"1072\" data-end=\"1077\">Buka:</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"1078\" data-end=\"1103\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre!\">bootstrap/app.php\r\n</code></div></div></pre>\r\n<p data-start=\"1105\" data-end=\"1117\">Cari bagian:</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"1118\" data-end=\"1191\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre! language-php\">-&gt;<span class=\"hljs-title function_ invoke__\">withMiddleware</span>(function (Middleware <span class=\"hljs-variable\">$middleware</span>) {\r\n    <span class=\"hljs-comment\">//</span>\r\n})\r\n</code></div></div></pre>\r\n<p data-start=\"1193\" data-end=\"1238\">Lalu <strong data-start=\"1198\" data-end=\"1225\">tambahkan alias <code data-start=\"1216\" data-end=\"1223\">admin</code></strong> seperti ini:</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"1240\" data-end=\"1456\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre! language-php\"><span class=\"hljs-keyword\">use</span> <span class=\"hljs-title\">Illuminate</span>\\<span class=\"hljs-title\">Foundation</span>\\<span class=\"hljs-title\">Configuration</span>\\<span class=\"hljs-title\">Middleware</span>;\r\n\r\n-&gt;<span class=\"hljs-title function_ invoke__\">withMiddleware</span>(function (Middleware <span class=\"hljs-variable\">$middleware</span>) {\r\n    <span class=\"hljs-variable\">$middleware</span>-&gt;<span class=\"hljs-title function_ invoke__\">alias</span>([\r\n        <span class=\"hljs-string\">\'admin\'</span> =&gt; <span class=\"hljs-title class_\">\\App\\Http\\Middleware\\AdminMiddleware</span>::<span class=\"hljs-variable language_\">class</span>,\r\n    ]);\r\n})\r\n</code></div></div></pre>\r\n<p data-start=\"1458\" data-end=\"1500\">⚠️ <strong data-start=\"1461\" data-end=\"1486\">WAJIB pakai <code data-start=\"1475\" data-end=\"1484\">alias()</code></strong>, bukan group.</p>\r\n<hr data-start=\"1502\" data-end=\"1505\">\r\n<h3 data-start=\"1507\" data-end=\"1534\">3️⃣ CLEAR CACHE (WAJIB)</h3>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"1536\" data-end=\"1574\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre! language-bash\">php artisan optimize:clear\r\n</code></div></div></pre>\r\n<hr data-start=\"1576\" data-end=\"1579\">\r\n<h3 data-start=\"1581\" data-end=\"1604\">4️⃣ COBA AKSES LAGI</h3>\r\n<p data-start=\"1605\" data-end=\"1610\">Buka:</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"1611\" data-end=\"1652\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre!\">http:<span class=\"hljs-comment\">//localhost/dashboard/berita</span>\r\n</code></div></div></pre>\r\n<p data-start=\"1654\" data-end=\"1725\">✅ <strong data-start=\"1656\" data-end=\"1672\">ERROR HILANG</strong><br data-start=\"1672\" data-end=\"1675\">\r\n✅ Middleware dikenali<br data-start=\"1696\" data-end=\"1699\">\r\n✅ Dashboard admin kebuka</p>\r\n<hr data-start=\"1727\" data-end=\"1730\">\r\n<h2 data-start=\"1732\" data-end=\"1773\">🔎 KENAPA TADI AKU SEBUT <code data-start=\"1760\" data-end=\"1772\">Kernel.php</code>?</h2>\r\n<p data-start=\"1774\" data-end=\"1781\">Karena:</p>\r\n<ul data-start=\"1782\" data-end=\"1867\">\r\n<li data-start=\"1782\" data-end=\"1817\">\r\n<p data-start=\"1784\" data-end=\"1817\">Laravel ≤ 10 → pakai <code data-start=\"1805\" data-end=\"1817\">Kernel.php</code></p>\r\n</li>\r\n<li data-start=\"1818\" data-end=\"1867\">\r\n<p data-start=\"1820\" data-end=\"1867\"><strong data-start=\"1820\" data-end=\"1867\">Laravel 11 &amp; 12 → pakai <code data-start=\"1846\" data-end=\"1865\">bootstrap/app.php</code></strong></p>\r\n</li>\r\n</ul>\r\n<p data-start=\"1869\" data-end=\"1912\">Kamu <strong data-start=\"1874\" data-end=\"1889\">tidak salah</strong>, justru paham versi 👍</p>\r\n<hr data-start=\"1914\" data-end=\"1917\">\r\n<h2 data-start=\"1919\" data-end=\"1965\">🧩 OPSI ALTERNATIF (KALAU MAU LEBIH SIMPLE)</h2>\r\n<p data-start=\"1967\" data-end=\"2026\">Kalau <strong data-start=\"1973\" data-end=\"2009\">sementara belum butuh middleware</strong>, kamu juga bisa:</p>\r\n<pre class=\"overflow-visible! px-0!\" data-start=\"2028\" data-end=\"2151\"><div class=\"contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary\"><div class=\"sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9\"><div class=\"absolute end-0 bottom-0 flex h-9 items-center pe-2\"><div class=\"bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs\"></div></div></div><div class=\"overflow-y-auto p-4\" dir=\"ltr\"><code class=\"whitespace-pre! language-php\"><span class=\"hljs-title class_\">Route</span>::<span class=\"hljs-title function_ invoke__\">prefix</span>(<span class=\"hljs-string\">\'dashboard\'</span>)-&gt;<span class=\"hljs-title function_ invoke__\">group</span>(function () {\r\n    <span class=\"hljs-title class_\">Route</span>::<span class=\"hljs-title function_ invoke__\">resource</span>(<span class=\"hljs-string\">\'berita\'</span>, <span class=\"hljs-title class_\">BeritaAdminController</span>::<span class=\"hljs-variable language_\">class</span>);\r\n});\r\n</code></div></div></pre>\r\n<p data-start=\"2153\" data-end=\"2232\">👉 <strong data-start=\"2156\" data-end=\"2187\">tanpa <code data-start=\"2164\" data-end=\"2185\">middleware(\'admin\')</code></strong><br>\r\n(ini valid &amp; sering dipakai pas development)</p>\r\n<hr data-start=\"2234\" data-end=\"2237\">\r\n<h2 data-start=\"2239\" data-end=\"2259\">✅ RANGKUMAN FINAL</h2>\r\n<div class=\"TyagGW_tableContainer\"><div tabindex=\"-1\" class=\"group TyagGW_tableWrapper flex flex-col-reverse w-fit\"><table data-start=\"2261\" data-end=\"2452\" class=\"w-fit min-w-(--thread-content-width)\"><thead data-start=\"2261\" data-end=\"2278\"><tr data-start=\"2261\" data-end=\"2278\"><th data-start=\"2261\" data-end=\"2268\" data-col-size=\"sm\">Item</th><th data-start=\"2268\" data-end=\"2278\" data-col-size=\"sm\">Status</th></tr></thead><tbody data-start=\"2291\" data-end=\"2452\"><tr data-start=\"2291\" data-end=\"2328\"><td data-start=\"2291\" data-end=\"2317\" data-col-size=\"sm\">Laravel 12 tanpa Kernel</td><td data-col-size=\"sm\" data-start=\"2317\" data-end=\"2328\">✅ benar</td></tr><tr data-start=\"2329\" data-end=\"2365\"><td data-start=\"2329\" data-end=\"2354\" data-col-size=\"sm\">Middleware admin error</td><td data-col-size=\"sm\" data-start=\"2354\" data-end=\"2365\">❌ wajar</td></tr><tr data-start=\"2366\" data-end=\"2421\"><td data-start=\"2366\" data-end=\"2409\" data-col-size=\"sm\">Daftar middleware di <code data-start=\"2389\" data-end=\"2408\">bootstrap/app.php</code></td><td data-col-size=\"sm\" data-start=\"2409\" data-end=\"2421\">✅ solusi</td></tr><tr data-start=\"2422\" data-end=\"2452\"><td data-start=\"2422\" data-end=\"2447\" data-col-size=\"sm\">Dashboard bisa diakses</td><td data-start=\"2447\" data-end=\"2452\" data-col-size=\"sm\">✅</td></tr></tbody></table></div></div>\r\n<hr data-start=\"2454\" data-end=\"2457\">\r\n<p data-start=\"2459\" data-end=\"2474\">Kalau mau next:</p>\r\n<ul data-start=\"2475\" data-end=\"2622\">\r\n<li data-start=\"2475\" data-end=\"2509\">\r\n<p data-start=\"2477\" data-end=\"2509\">🔐 sambungkan ke <strong data-start=\"2494\" data-end=\"2509\">login admin</strong></p>\r\n</li>\r\n<li data-start=\"2510\" data-end=\"2555\">\r\n<p data-start=\"2512\" data-end=\"2555\">🔁 toggle publish <strong data-start=\"2530\" data-end=\"2555\">tanpa reload (Alpine)</strong></p>\r\n</li>\r\n<li data-start=\"2556\" data-end=\"2580\">\r\n<p data-start=\"2558\" data-end=\"2580\">⚡ live search debounce</p>\r\n</li>\r\n<li data-start=\"2581\" data-end=\"2622\">\r\n<p data-start=\"2583\" data-end=\"2622\">🎨 polish UI dashboard biar makin “wow”</p>\r\n</li>\r\n</ul>\r\n<p data-start=\"2624\" data-end=\"2656\" data-is-last-node=\"\" data-is-only-node=\"\">tinggal bilang, kita gas lagi 💪</p></div></div></div></div><div class=\"z-0 flex min-h-[46px] justify-start\"></div><div class=\"mt-3 w-full empty:hidden\"><div class=\"text-center\"></div></div></div></div></article></div><div aria-hidden=\"true\" data-edge=\"true\" class=\"pointer-events-none h-px w-px absolute bottom-0\"></div>', 'publish', '2026-01-15 03:05:15', '2026-01-15 03:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('agroptimal-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:8:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.40.2\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.8\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:5:\"0.3.8\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.4\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.3.4\";s:6:\"\0*\0dev\";b:1;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.26.0\";s:6:\"\0*\0dev\";b:1;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.48.1\";s:6:\"\0*\0dev\";b:1;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.8\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"3.8.4\";s:6:\"\0*\0dev\";b:1;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"11.5.33\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"11.5.33\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"4.1.17\";s:6:\"\0*\0dev\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1768751275;}', 1768837675);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cek_tanahs`
--

CREATE TABLE `cek_tanahs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cek_tanahs`
--

INSERT INTO `cek_tanahs` (`id`, `title`, `slug`, `content`, `image`, `step_number`, `created_at`, `updated_at`) VALUES
(2, 'Periksa Tekstur Tanah', 'periksa-tekstur-tanah', 'Ambil segenggam tanah basah. Jika tanah bisa dibentuk menjadi bola dan tidak mudah hancur, berarti teksturnya baik (lempung). Jika kasar dan berpasir, kemampuan menahan airnya rendah.', NULL, 2, '2026-01-18 03:12:04', '2026-01-18 03:12:04'),
(3, 'Cek Kehidupan Mikroorganisme', 'cek-kehidupan-mikroorganisme', 'Gali tanah sekitar 10-20 cm. Adanya cacing tanah, serangga kecil, atau akar tanaman yang sehat menandakan tanah tersebut subur dan beraerasi baik.', NULL, 3, '2026-01-18 03:12:04', '2026-01-18 03:12:04'),
(4, 'Uji Drainase Sederhana', 'uji-drainase-sederhana', 'Buat lubang kecil dan isi dengan air. Jika air meresap habis dalam waktu moderat (15-30 menit), drainase baik. Jika menggenang terlalu lama atau hilang sangat cepat, mungkin perlu perbaikan.', NULL, 4, '2026-01-18 03:12:04', '2026-01-18 03:12:04'),
(5, 'Amati Warna Tanah', 'amati-warna-tanah', 'Tanah yang subur biasanya berwarna lebih gelap (hitam atau coklat tua) karena kaya akan bahan organik. Tanah yang pucat atau kekuningan mungkin kurang subur.', NULL, 1, '2026-01-18 03:47:54', '2026-01-18 03:47:54'),
(6, '3rdsa', '3rdsa', 'adfca', NULL, 6, '2026-01-18 03:48:44', '2026-01-18 03:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `desas`
--

CREATE TABLE `desas` (
  `id` bigint UNSIGNED NOT NULL,
  `kecamatan_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_data`
--

CREATE TABLE `home_data` (
  `id` bigint UNSIGNED NOT NULL,
  `total_pupuk` int NOT NULL,
  `jenis_pupuk` int NOT NULL,
  `petani_terdampak` int NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_data`
--

INSERT INTO `home_data` (`id`, `total_pupuk`, `jenis_pupuk`, `petani_terdampak`, `rating`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 9999, 18, 110, '4.7', 1, '2026-01-01 19:17:27', '2026-01-14 20:38:46'),
(2, 11500, 13, 109, '4.9', 1, '2026-01-15 01:22:22', '2026-01-15 01:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `home_faqs`
--

CREATE TABLE `home_faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_verified` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_faqs`
--

INSERT INTO `home_faqs` (`id`, `question`, `answer`, `is_active`, `is_verified`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Apakah nanti akan ada fitur pengajuan tender untuk memperluas monitoring?', 'Ya. Agroptimal sedang mengembangkan fitur pengajuan tender yang memungkinkan pemilik lahan besar atau korporasi membuka pengadaan sistem monitoring secara transparan.', 1, 1, 2, NULL, '2026-01-16 17:39:50'),
(3, 'Bagaimana sensor tetap akurat meski di bawah kondisi cuaca ekstrem?', 'Sensor Agroptimal menggunakan perangkat berstandar industri dengan perlindungan cuaca ekstrem, sehingga tetap stabil dan akurat meskipun terkena hujan deras atau panas tinggi.', 1, 1, 3, NULL, NULL),
(4, 'Apakah data Agroptimal dapat diintegrasikan dengan sistem penyiraman otomatis?', 'Bisa. Data dari sensor dapat diintegrasikan dengan sistem penyiraman otomatis sehingga air hanya digunakan saat kondisi tanah membutuhkan.', 1, 1, 4, NULL, NULL),
(5, 'Bagaimana Agroptimal membantu meningkatkan hasil panen dalam jangka panjang?', 'Dengan pemantauan berkelanjutan dan data historis, Agroptimal membantu petani memahami pola lahan sehingga kualitas dan konsistensi hasil panen dapat meningkat.', 1, 1, 5, NULL, NULL),
(7, 'Apa yang dirasakan petani dalam waktu dekat setelah menggunakan Agroptimal?', 'Dalam 14 hari pertama, petani akan merasakan ketenangan pikiran karena kondisi lahan dapat dipantau secara real-time, sehingga keputusan dapat diambil lebih cepat dan tepat.', 1, 1, 1, NULL, NULL),
(8, 'Apakah nanti akan ada fitur pengajuan tender untuk memperluas monitoring?', 'Ya. Agroptimal sedang mengembangkan fitur pengajuan tender yang memungkinkan pemilik lahan besar atau korporasi membuka pengadaan sistem monitoring secara transparan.', 1, 1, 2, NULL, NULL),
(9, 'Bagaimana sensor tetap akurat meski di bawah kondisi cuaca ekstrem?', 'Sensor Agroptimal menggunakan perangkat berstandar industri dengan perlindungan cuaca ekstrem, sehingga tetap stabil dan akurat meskipun terkena hujan deras atau panas tinggi.', 1, 1, 3, NULL, NULL),
(10, 'Apakah data Agroptimal dapat diintegrasikan dengan sistem penyiraman otomatis?', 'Bisa. Data dari sensor dapat diintegrasikan dengan sistem penyiraman otomatis sehingga air hanya digunakan saat kondisi tanah membutuhkan.', 1, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_pengaduans`
--

CREATE TABLE `home_pengaduans` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('baru','dibaca') COLLATE utf8mb4_unicode_ci DEFAULT 'baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_pengaduans`
--

INSERT INTO `home_pengaduans` (`id`, `kategori`, `nama`, `no_whatsapp`, `pesan`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pertanyaan', 'Revand', '0895347139758', 'hj', 'pengaduan/jizCTOpB7mUdRPXtUndKDfHR36tEKVSlQMcgJ7pI.png', 'baru', '2026-01-01 23:46:20', '2026-01-01 23:46:20'),
(2, 'Kendala Website', 'Revand', '0895347139758', 'sd', 'pengaduan/WfQYMCAKQCr9KLpQC517G7i9asag5WHcButFvP5s.png', 'baru', '2026-01-02 00:06:51', '2026-01-02 00:06:51'),
(3, 'Saran & Masukan', 'Revand', '0895347139758', 'cihuy', 'pengaduan/BQqPEuIioD5VOtSklqL97rTHymNfvPkNm7EkwzOp.png', 'baru', '2026-01-02 00:18:34', '2026-01-02 00:18:34'),
(4, 'Saran & Masukan', 'Revand', '0895347139758', 'skskskks', 'pengaduan/i5hrEKiu3K9XAL2M8D8ZaSFJZyuabTN94cGxwxq5.png', 'baru', '2026-01-02 00:39:33', '2026-01-02 00:39:33'),
(5, 'Saran & Masukan', 'Revand', '0895347139758', 'hkhkhkhk', 'pengaduan/BeVSSMvYsjiKWA2E7jLQrum7nXQQuEZODUQRwBjY.png', 'baru', '2026-01-02 00:53:56', '2026-01-02 00:53:56'),
(6, 'Kendala Website', 'Revand', '0895347139758', 'aedwasa', 'pengaduan/xyebtYEoXOCHPeHMNmVTQyf6txNDJ5WDrBVzop4X.png', 'baru', '2026-01-02 01:02:16', '2026-01-02 01:02:16'),
(7, 'Hal Lainnya', 'wiaidoosd', '86875', 'eawss', 'pengaduan/n8iWRGQhrumfokeJoDsxjGmiIqmnsuF2g07ttoia.jpg', 'baru', '2026-01-02 01:04:04', '2026-01-02 01:04:04'),
(8, 'Kendala Website', 'wiaidoosd', '86875', '323W22E', 'pengaduan/V8sYnY8yDbUjwrQjObgdOaOA9tx37QPhp6R5LVgN.webp', 'baru', '2026-01-04 21:01:59', '2026-01-04 21:01:59'),
(9, 'Hal Lainnya', 'mul', '08663', 'dgjkmnj', 'pengaduan/Ze49uw0gOnlbXR4tqGjCV6S7lrArMziaVCymbifv.png', 'baru', '2026-01-04 21:05:43', '2026-01-04 21:05:43'),
(10, 'Kendala Website', 'mul', '08663', 'khy', 'pengaduan/6D4Tj6mRTaMXOumBrr9f7qiQqrGyeWzafgOFkdVv.png', 'baru', '2026-01-04 21:07:38', '2026-01-04 21:07:38'),
(11, 'Pertanyaan', 'mul', '08663', 'qewr', 'pengaduan/ZvbAM6DKCSlsJx5zrRM4ZsJAv2mG9ERXElLbC439.png', 'baru', '2026-01-05 18:52:04', '2026-01-05 18:52:04'),
(12, 'Pertanyaan', 'mul', '08663', 'sdws', 'pengaduan/SYiTaIZJ7HMyPlsQA8F8rh465pM3VqB905M57EVu.png', 'baru', '2026-01-05 19:07:24', '2026-01-05 19:07:24'),
(13, 'Hal Lainnya', 'mul', '0895347139758', 'asjdiwjms', 'pengaduan/vbtis0GCFPB4cJ1uloWN1PW0QDobAz8HeUYiB9A7.png', 'baru', '2026-01-05 19:13:25', '2026-01-05 19:13:25'),
(14, 'Kendala Website', 'mul', '0895347139758', 'sweswe', 'pengaduan/25lmXBZyrtqyx1c8NoWtOlMpJec9BgMyhS0HU2GU.png', 'dibaca', '2026-01-05 19:21:13', '2026-01-14 20:37:53'),
(16, 'Saran & Masukan', 'Budi', '132919375', 'fdcqqdaqfeasfe', 'pengaduan/kwh1DA2ZrDEokj2RwYHYju4uz2dCI2NjRItZGtNB.jpg', 'baru', '2026-01-17 06:32:38', '2026-01-17 06:32:38'),
(17, 'Pertanyaan', 'Budi', '8997654322', 'sefcsd', 'pengaduan/Vt5SvNsQyeVtioRutlie4ACAusiEnrUHsIdPlA5M.jpg', 'baru', '2026-01-17 06:46:37', '2026-01-17 06:46:37'),
(18, 'Pertanyaan', 'Revand pp', '09876521', 'qefcbnkop', 'pengaduan/8wvmC5pBkdQynHNh3rFCsDlNHvKt982VmMm0tks5.jpg', 'baru', '2026-01-17 07:01:59', '2026-01-17 07:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Balongbendo', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(4, 'Buduran', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(5, 'Candi', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(6, 'Gedangan', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(7, 'Jabon', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(8, 'Krembung', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(9, 'Krian', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(10, 'Porong', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(11, 'Prambon', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(12, 'Sedati', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(13, 'Sidoarjo', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(14, 'Sukodono', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(15, 'Taman', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(16, 'Tanggulangin', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(17, 'Tarik', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(18, 'Tulangan', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(19, 'Waru', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48'),
(20, 'Wonoayu', 1, '2026-01-17 06:22:48', '2026-01-17 06:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `komoditas`
--

CREATE TABLE `komoditas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_days` int NOT NULL,
  `yield_per_ha` decimal(8,2) NOT NULL,
  `price_per_kg` decimal(12,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `risks` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komoditas`
--

INSERT INTO `komoditas` (`id`, `nama`, `slug`, `duration_days`, `yield_per_ha`, `price_per_kg`, `description`, `risks`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Padi', 'padi', 110, '6.00', '6000.00', 'Tanaman pangan utama. Membutuhkan irigasi cukup.', '[\"Wereng\",\"Tikus\",\"Burung\",\"Potensi Rebah\",\"Kekeringan\"]', 1, '2026-01-17 23:23:08', '2026-01-17 23:23:08'),
(2, 'Jagung', 'jagung', 95, '7.00', '4500.00', 'Tanaman palawija populer. Rawan serangan ulat grayak.', '[\"Ulat Grayak\",\"Bulai\",\"Penggerek Batang\"]', 1, '2026-01-17 23:23:08', '2026-01-17 23:23:08'),
(3, 'Kedelai', 'kedelai', 85, '2.50', '9000.00', 'Tanaman legum kaya protein.', '[\"Ulat Polong\",\"Kutu Kebul\",\"Busuk Akar\"]', 1, '2026-01-17 23:23:08', '2026-01-17 23:23:08'),
(4, 'Singkong', 'singkong', 240, '25.00', '1500.00', 'Tanaman umbi jangka panjang. Relatif tahan kering.', '[\"Tungau Merah\",\"Busuk Umbi\"]', 1, '2026-01-17 23:23:08', '2026-01-17 23:23:08'),
(5, 'Ubi Jalar', 'ubi-jalar', 120, '15.00', '3000.00', 'Tanaman umbi cepat panen.', '[\"Lanas\",\"Penggerek Umbi\",\"Busuk Umbi\"]', 1, '2026-01-17 23:23:08', '2026-01-17 23:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_02_014417_create_agroptimal_stats_table', 2),
(5, '2026_01_02_015029_create_home_data_table', 3),
(6, '2026_01_02_034026_create_home_faqs_table', 4),
(7, '2026_01_02_052337_create_home_pengaduans_table', 5),
(8, '2025_01_05_000000_create_pengaduans_table', 6),
(9, '2026_01_15_081446_create_beritas_table', 6),
(10, '2026_01_17_011828_create_kecamatans_table', 7),
(11, '2026_01_17_011905_create_desas_table', 7),
(12, '2026_01_17_021427_create_pupuks_table', 8),
(13, '2026_01_17_025507_create_publikasis_table', 9),
(14, '2026_01_17_141603_create_simulasis_table', 10),
(15, '2026_01_17_164852_add_jumlah_sak_to_pupuks_table', 11),
(16, '2026_01_17_152957_create_komoditas_table', 12),
(17, '2026_01_18_072439_create_tips_bibits_table', 13),
(18, '2026_01_18_072443_create_tips_lahans_table', 14),
(19, '2026_01_18_072447_create_tips_pemupukans_table', 15),
(20, '2026_01_18_100153_create_cek_tanahs_table', 16),
(21, '2026_01_18_154333_create_tips_irigasis_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pupuks`
--

CREATE TABLE `pupuks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('Subsidi','Non Subsidi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kg_per_sak` int NOT NULL,
  `jumlah_sak` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pupuks`
--

INSERT INTO `pupuks` (`id`, `nama`, `kategori`, `kg_per_sak`, `jumlah_sak`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Urea', 'Subsidi', 50, 80, 1, '2026-01-17 07:43:43', '2026-01-17 09:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('f9BwLMm6r7b4KZKsOmXfjnk6n7218yahWlF51axQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVZBMTJ6aFdkSzBNNTFzMTE5VXM5OHRnOENmUndJem9XTzkxaTBoRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9uZXdhZ3JvcHRpbWFsLnRlc3QvYmVyaXRhP2thdGVnb3JpPVRla25vbG9naSI7czo1OiJyb3V0ZSI7czoxMjoiYmVyaXRhLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1768791788),
('t5eI17qwXx2pih4mnJUqOWcxM1MFn772HnTB1PAr', NULL, '127.0.0.1', 'curl/8.12.1', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVHhyZ3lLTkx6aTcxY3J4RW9tV1JBY045STF5Y2FMQzhjNlU3TjF5UyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768791256),
('YFge5S6M5dV9ixXFc5Gu8DrBdrhxKcdsoMVR9AuM', NULL, '127.0.0.1', 'curl/8.12.1', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTkU4NllWQVYyTVVJMW1WZ0FWclFTQ3haVkFtWWh2WkpNclJJRGtTYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768791264);

-- --------------------------------------------------------

--
-- Table structure for table `simulasis`
--

CREATE TABLE `simulasis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_tanaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_lahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimasi_panen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tips_bibits`
--

CREATE TABLE `tips_bibits` (
  `id` bigint UNSIGNED NOT NULL,
  `step_number` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_padi` longtext COLLATE utf8mb4_unicode_ci,
  `content_jagung` longtext COLLATE utf8mb4_unicode_ci,
  `content_kedelai` longtext COLLATE utf8mb4_unicode_ci,
  `content_singkong` longtext COLLATE utf8mb4_unicode_ci,
  `content_ubi` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tips_bibits`
--

INSERT INTO `tips_bibits` (`id`, `step_number`, `title`, `description`, `content_padi`, `content_jagung`, `content_kedelai`, `content_singkong`, `content_ubi`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pilih Bibit Unggul & Sesuai Lahan', 'Bibit menentukan hasil panen sejak awal. Gunakan varietas yang teruji.', '<p>Gunakan benih padi bersertifikat seperti Inpari atau Ciherang. Cocok untuk lahan kecil dan hasil stabil.</p><ul class=\"list-disc pl-5 mt-2\"><li>Daya tumbuh seragam</li><li>Tahan penyakit blas</li><li>Umur panen ±110 hari</li></ul>', '<p>Pilih jagung hibrida tahan kering untuk tanam terus-menerus.</p><ul class=\"list-disc pl-5 mt-2\"><li>Tongkol seragam</li><li>Tahan bulai</li><li>Cocok lahan tadah hujan</li></ul>', '<p>Gunakan varietas kedelai berumur genjah agar panen lebih cepat.</p><ul class=\"list-disc pl-5 mt-2\"><li>Umur panen ±80 hari</li><li>Biji besar & seragam</li></ul>', '<p>Gunakan stek batang sehat, bukan dari tanaman tua.</p><ul class=\"list-disc pl-5 mt-2\"><li>Batang keras & segar</li><li>Tidak berjamur</li></ul>', '<p>Pilih stek ubi jalar dari tanaman produktif.</p><ul class=\"list-disc pl-5 mt-2\"><li>Daun hijau segar</li><li>Tidak terserang hama</li></ul>', NULL, '2026-01-18 00:27:59', '2026-01-18 00:27:59'),
(2, 2, 'Perlakuan Benih Sebelum Tanam', 'Lakukan perendaman atau treatment khusus untuk mematahkan dormansi dan mencegah penyakit.', '<p>Rendam benih dalam air garam (3%) untuk memisahkan benih hampa. Bilas lalu rendam 24 jam.</p>', '<p>Campurkan benih dengan fungisida (misal: metalaksil) untuk mencegah penyakit bulai sejak dini.</p>', '<p>Inokulasi dengan Rhizobium jika ditanam di lahan baru untuk membantu penambatan nitrogen.</p>', '<p>Rendam stek dalam larutan ZPT (Zat Pengatur Tumbuh) sebentar sebelum tanam.</p>', '<p>Letakkan stek di tempat teduh selama 1-2 hari sebelum tanam agar layu sedikit dan akar cepat keluar.</p>', NULL, '2026-01-18 00:27:59', '2026-01-18 00:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `tips_irigasis`
--

CREATE TABLE `tips_irigasis` (
  `id` bigint UNSIGNED NOT NULL,
  `step_number` int NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_padi` longtext COLLATE utf8mb4_unicode_ci,
  `content_jagung` longtext COLLATE utf8mb4_unicode_ci,
  `content_kedelai` longtext COLLATE utf8mb4_unicode_ci,
  `content_singkong` longtext COLLATE utf8mb4_unicode_ci,
  `content_ubi` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tips_irigasis`
--

INSERT INTO `tips_irigasis` (`id`, `step_number`, `title`, `description`, `video_url`, `content_padi`, `content_jagung`, `content_kedelai`, `content_singkong`, `content_ubi`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pengairan Fase Awal (Penyemaian)', 'Pada tahap awal, benih membutuhkan kelembaban yang cukup untuk berkecambah, namun tidak boleh tergenang air terlalu dalam agar tidak busuk. Keseimbangan air sangat krusial di minggu-minggu pertama.', 'https://www.youtube.com/watch?v=Zn3hMvWj-n4', 'Tanah harus dalam kondisi macak-macak (basah tapi tidak menggenang). Jangan digenangi air tinggi hingga bibit tumbuh kuat.', 'Siram tanah hingga lembab sebelum tanam. Jagung sangat sensitif terhadap genangan air saat baru tumbuh.', 'Pastikan tanah lembab. Kedelai membutuhkan air untuk imbibisi benih, tetapi drainase harus baik.', 'Tanah harus gembur dan lembab. Tidak perlu penyiraman berlebihan di awal.', 'Kelembaban sedang diperlukan untuk memancing pertumbuhan tunas/akar dari stek.', NULL, '2026-01-18 09:22:01', '2026-01-18 09:22:01'),
(2, 2, 'Fase Vegetatif (Pertumbuhan Daun & Batang)', 'Tanaman sedang tumbuh pesat. Kebutuhan air meningkat untuk mendukung pembentukan daun, batang, dan akar. Kekurangan air di fase ini akan membuat tanaman kerdil.', 'https://www.youtube.com/watch?v=S2S_A5tC_kI', 'Lakukan pengairan berselang (Intermittent). Genangi 3-5 cm, biarkan mengering hingga tanah retak rambut, lalu genangi lagi. Ini merangsang akar tumbuh dalam.', 'Penyiraman rutin setiap 3-5 hari sekali tergantung cuaca. Pastikan air meresap ke zona perakaran.', 'Fase ini kritis. Kekurangan air akan menghambat percabangan. Jaga kelembaban tanah sekitar 50-70%.', 'Irigasi diperlukan jika kemarau panjang. Singkong cukup toleran kekeringan tapi butuh air untuk pertumbuhan optimal.', 'Cukup siram 1-2 minggu sekali. Terlalu banyak air justru akan memperbanyak daun tapi umbi kecil.', NULL, '2026-01-18 09:22:02', '2026-01-18 09:22:02'),
(3, 3, 'Fase Generatif (Pembungaan & Pembuahan)', 'Ini adalah fase paling kritis! Tanaman membutuhkan air yang cukup untuk proses penyerbukan dan pengisian biji/umbi. Stres air saat ini bisa menyebabkan gagal panen.', 'https://www.youtube.com/watch?v=O1k1E-y2Y40', 'Saat padi bunting (primordia) hingga berbunga, pertahankan genangan air 2-3 cm. JANGAN biarkan tanah kering saat ini.', 'Kebutuhan air PUNCAL saat pembungaan. Kekurangan air menyebabkan biji ompong. Siram intensif.', 'Sama seperti jagung, perlu air cukup saat berbunga dan pengisian polong agar biji bernas.', 'Kurangi frekuensi penyiraman. Fokus nutrisi ke umbi.', 'Tanah jangan terlalu basah agar umbi tidak busuk dan kulitnya mulus.', NULL, '2026-01-18 09:22:02', '2026-01-18 09:22:02'),
(4, 4, 'Menjelang Panen (Pematangan)', 'Kurangi pemberian air secara bertahap. Hal ini membantu mempercepat pematangan biji dan memudahkan proses panen (tanah lebih keras).', 'https://www.youtube.com/watch?v=7bJKtqVj6yA', 'Keringkan lahan total 10-14 hari sebelum panen. Ini mematangkan gabah serempak dan memudahkan mesin panen masuk.', 'Hentikan penyiraman 1-2 minggu sebelum panen saat kelobot mulai mengering.', 'Stop penyiraman saat daun mulai menguning dan rontok. Biarkan polong mengering di pohon.', 'Biarkan tanah kering memudahkan pencabutan umbi.', 'Tanah kering wajib sebelum panen untuk kualitas simpan umbi yang baik.', NULL, '2026-01-18 09:22:02', '2026-01-18 09:22:02'),
(5, 5, 'Sistem Drainase & Pembuangan Air', 'Bukan cuma soal memasukkan air, tapi juga membuangnya. Drainase yang buruk menyebabkan akar busuk dan penyakit.', 'https://www.youtube.com/watch?v=T_lCgw0k2nI', 'Pastikan saluran pembuangan lancar agar bisa mengeringkan sawah dengan cepat saat dibutuhkan.', 'Buat bedengan tinggi. Jagung benci \"kaki basah\" (terendam).', 'Sama dengan jagung, pastikan tidak ada air menggenang setelah hujan lebat.', 'Drainase mutlak diperlukan untuk mencegah busuk umbi.', 'Hindari lahan yang rawan banjir.', NULL, '2026-01-18 09:22:02', '2026-01-18 09:22:02');

-- --------------------------------------------------------

--
-- Table structure for table `tips_lahans`
--

CREATE TABLE `tips_lahans` (
  `id` bigint UNSIGNED NOT NULL,
  `step_number` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_padi` longtext COLLATE utf8mb4_unicode_ci,
  `content_jagung` longtext COLLATE utf8mb4_unicode_ci,
  `content_kedelai` longtext COLLATE utf8mb4_unicode_ci,
  `content_singkong` longtext COLLATE utf8mb4_unicode_ci,
  `content_ubi` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tips_lahans`
--

INSERT INTO `tips_lahans` (`id`, `step_number`, `title`, `description`, `content_padi`, `content_jagung`, `content_kedelai`, `content_singkong`, `content_ubi`, `image`, `created_at`, `updated_at`) VALUES
(2, 2, 'Pengaturan pH Tanah', 'Tanah asam menghambat penyerapan nutrisi. Lakukan pengapuran jika perlu.', '<p>Cek pH tanah. Jika < 5.5, taburkan kapur dolomit 1 ton/ha saat pengolahan tanah terakhir.</p>', '<p>Jagung butuh pH 5.5-7.0. Berikan dolomit 2 minggu sebelum tanam jika tanah terlalu asam.</p>', '<p>Sangat sensitif terhadap tanah asam. Pastikan pH sekitar 6.0 untuk hasil maksimal.</p>', '<p>Toleran terhadap pH rendah, tapi hasil terbaik di pH 5.5-6.5. Berikan kapur secukupnya.</p>', '<p>Cocok di pH 5.5-6.5. Hindari tanah yang terlalu padat dan basah.</p>', NULL, '2026-01-18 00:28:00', '2026-01-18 00:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tips_pemupukans`
--

CREATE TABLE `tips_pemupukans` (
  `id` bigint UNSIGNED NOT NULL,
  `step_number` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_padi` longtext COLLATE utf8mb4_unicode_ci,
  `content_jagung` longtext COLLATE utf8mb4_unicode_ci,
  `content_kedelai` longtext COLLATE utf8mb4_unicode_ci,
  `content_singkong` longtext COLLATE utf8mb4_unicode_ci,
  `content_ubi` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tips_pemupukans`
--

INSERT INTO `tips_pemupukans` (`id`, `step_number`, `title`, `description`, `content_padi`, `content_jagung`, `content_kedelai`, `content_singkong`, `content_ubi`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pemupukan Dasar', 'Berikan nutrisi awal saat tanam untuk start pertumbuhan yang baik.', '<p>Gunakan Pupuk Kandang 2 ton/ha dan Urea+SP36 saat tanam. Sebar merata.</p>', '<p>Berikan NPK dan Urea di lubang tanam atau ditugal samping benih (jarak 5cm).</p>', '<p>Berikan pupuk dasar NPK rendah N (karena kedelai mengikat N sendiri). Fokus P dan K.</p>', '<p>Pupuk kandang sangat penting. Berikan saat pembuatan guludan.</p>', '<p>Gunakan pupuk kandang matang dan KCL tinggi untuk pembentukan umbi.</p>', NULL, '2026-01-18 00:28:01', '2026-01-18 00:28:01'),
(2, 2, 'Pemupukan Susulan', 'Tambahkan nutrisi pada fase vegetatif dan generatif.', '<p>Susulan 1 (14 HST): Urea. Susulan 2 (30 HST): Urea+Phonska. Jaga air tetap macak-macak.</p>', '<p>Umur 21 HST dan 45 HST. Berikan Urea lagi untuk memacu pertumbuhan batang dan daun.</p>', '<p>Saat berbunga (30 HST), bisa ditambah pupuk daun gandasil B untuk pengisian polong.</p>', '<p>Umur 3 bulan, berikan KCL atau NPK untuk memacu pembesaran umbi.</p>', '<p>Umur 45 hari, berikan ZA dan KCL. Jangan terlalu banyak Urea agar tidak hanya daun yang lebat.</p>', NULL, '2026-01-18 00:28:01', '2026-01-18 00:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'RevandAdmin33', 'admin@agroptimal.com', '2026-01-18 19:53:42', '$2y$12$7IOT5SIK1zBZivW7qUlaPO0tsYQxaGANDKxdl1ZiI6bu/MxPHot72', NULL, '2026-01-18 19:53:42', '2026-01-18 19:53:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beritas_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cek_tanahs`
--
ALTER TABLE `cek_tanahs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cek_tanahs_slug_unique` (`slug`);

--
-- Indexes for table `desas`
--
ALTER TABLE `desas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desas_kecamatan_id_nama_unique` (`kecamatan_id`,`nama`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_data`
--
ALTER TABLE `home_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_faqs`
--
ALTER TABLE `home_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_pengaduans`
--
ALTER TABLE `home_pengaduans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kecamatans_nama_unique` (`nama`);

--
-- Indexes for table `komoditas`
--
ALTER TABLE `komoditas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `komoditas_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pupuks`
--
ALTER TABLE `pupuks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pupuks_nama_unique` (`nama`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `simulasis`
--
ALTER TABLE `simulasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tips_bibits`
--
ALTER TABLE `tips_bibits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tips_irigasis`
--
ALTER TABLE `tips_irigasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tips_lahans`
--
ALTER TABLE `tips_lahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tips_pemupukans`
--
ALTER TABLE `tips_pemupukans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cek_tanahs`
--
ALTER TABLE `cek_tanahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `desas`
--
ALTER TABLE `desas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_data`
--
ALTER TABLE `home_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_faqs`
--
ALTER TABLE `home_faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `home_pengaduans`
--
ALTER TABLE `home_pengaduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `komoditas`
--
ALTER TABLE `komoditas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pupuks`
--
ALTER TABLE `pupuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `simulasis`
--
ALTER TABLE `simulasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tips_bibits`
--
ALTER TABLE `tips_bibits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tips_irigasis`
--
ALTER TABLE `tips_irigasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tips_lahans`
--
ALTER TABLE `tips_lahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tips_pemupukans`
--
ALTER TABLE `tips_pemupukans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `desas`
--
ALTER TABLE `desas`
  ADD CONSTRAINT `desas_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
