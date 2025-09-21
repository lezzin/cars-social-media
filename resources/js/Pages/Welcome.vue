<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();
</script>

<template>

    <Head title="CarConnect - A Rede Social dos Apaixonados por Carros" />

    <div class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-white min-h-screen">
        <header class="fixed top-0 w-full bg-black/20 backdrop-blur-lg border-b border-white/10 z-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-center py-4">
                    <ApplicationLogo />

                    <nav class="hidden md:flex space-x-8">
                        <a href="#features" class="hover:text-cyan-400 transition-colors duration-300 relative group">
                            Recursos
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-cyan-400 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                        </a>
                        <a href="#community" class="hover:text-cyan-400 transition-colors duration-300 relative group">
                            Comunidade
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-cyan-400 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                        </a>
                        <a href="#about" class="hover:text-cyan-400 transition-colors duration-300 relative group">
                            Sobre
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-cyan-400 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                        </a>
                    </nav>

                    <div v-if="canLogin" class="flex items-center space-x-4">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full font-semibold hover:shadow-lg hover:shadow-cyan-500/25 transform hover:scale-105 transition-all duration-300">
                        Dashboard
                        </Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="px-4 py-2 text-cyan-400 border border-cyan-400 rounded-full hover:bg-cyan-400 hover:text-slate-900 transition-all duration-300">
                            Login
                            </Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full font-semibold hover:shadow-lg hover:shadow-cyan-500/25 transform hover:scale-105 transition-all duration-300">
                            Cadastre-se
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </header>

        <main class="pt-20">
            <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0">
                    <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl animate-pulse">
                    </div>
                    <div
                        class="absolute top-40 right-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-1000">
                    </div>
                    <div
                        class="absolute bottom-20 left-1/3 w-80 h-80 bg-pink-500/10 rounded-full blur-3xl animate-pulse delay-2000">
                    </div>
                </div>

                <div class="relative max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
                    <div class="text-center lg:text-left space-y-8">
                        <h1 class="text-5xl lg:text-7xl font-black leading-tight">
                            <span
                                class="bg-gradient-to-r from-white via-cyan-200 to-purple-200 bg-clip-text text-transparent">
                                Conecte-se
                            </span>
                            <br>
                            <span class="bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">
                                com sua Paixão
                            </span>
                        </h1>

                        <p class="text-xl text-slate-300 max-w-2xl leading-relaxed">
                            A primeira rede social dedicada aos apaixonados por carros. Compartilhe sua garagem,
                            conecte-se com
                            entusiastas e descubra as máquinas dos seus sonhos.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <Link v-if="canRegister" :href="route('register')"
                                class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full text-lg font-bold hover:shadow-2xl hover:shadow-cyan-500/25 transform hover:scale-105 transition-all duration-300">
                            Comece Agora
                            </Link>
                            <button
                                class="px-8 py-4 border-2 border-cyan-400 text-cyan-400 rounded-full text-lg font-bold hover:bg-cyan-400 hover:text-slate-900 transition-all duration-300">
                                Explorar Comunidade
                            </button>
                        </div>
                    </div>

                    <div class="relative">
                        <div
                            class="relative bg-gradient-to-br from-slate-800/50 to-purple-900/50 backdrop-blur-lg border border-white/10 rounded-3xl p-8 overflow-hidden">
                            <div class="space-y-6">
                                <div
                                    class="bg-gradient-to-r from-slate-700/50 to-slate-600/50 backdrop-blur-lg border border-white/10 rounded-2xl p-6 transform hover:scale-105 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/20">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-xl flex items-center justify-center text-2xl">
                                            🏎️
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-cyan-400">Ferrari F8 Tributo</h3>
                                            <p class="text-slate-300">Por @speedlover</p>
                                            <div class="flex space-x-4 text-sm text-slate-400 mt-2">
                                                <span>❤️ 234</span>
                                                <span>💬 45</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Car Card 2 -->
                                <div
                                    class="bg-gradient-to-r from-slate-700/50 to-slate-600/50 backdrop-blur-lg border border-white/10 rounded-2xl p-6 transform hover:scale-105 transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/20 ml-8">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-2xl">
                                            🏁
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-purple-400">Porsche 911 GT3</h3>
                                            <p class="text-slate-300">Por @trackmaster</p>
                                            <div class="flex space-x-4 text-sm text-slate-400 mt-2">
                                                <span>❤️ 189</span>
                                                <span>💬 32</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Car Card 3 -->
                                <div
                                    class="bg-gradient-to-r from-slate-700/50 to-slate-600/50 backdrop-blur-lg border border-white/10 rounded-2xl p-6 transform hover:scale-105 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/20">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center text-2xl">
                                            ⚡
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-green-400">Tesla Model S Plaid</h3>
                                            <p class="text-slate-300">Por @electricfan</p>
                                            <div class="flex space-x-4 text-sm text-slate-400 mt-2">
                                                <span>❤️ 156</span>
                                                <span>💬 28</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Elements -->
                            <div
                                class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-cyan-400/20 to-purple-600/20 rounded-full blur-xl animate-bounce">
                            </div>
                            <div
                                class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-purple-400/20 to-pink-600/20 rounded-full blur-xl animate-bounce delay-1000">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="py-20 bg-gradient-to-br from-slate-800/50 to-purple-800/30 backdrop-blur-lg">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-black mb-6">
                            <span class="bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">
                                Por que CarConnect?
                            </span>
                        </h2>
                        <p class="text-xl text-slate-300 max-w-3xl mx-auto">
                            A plataforma definitiva para entusiastas automotivos compartilharem sua paixão
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div
                            class="group bg-gradient-to-br from-slate-800/40 to-slate-700/40 backdrop-blur-lg border border-white/10 rounded-2xl p-8 hover:border-cyan-400/50 transition-all duration-300 hover:transform hover:scale-105">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                📸
                            </div>
                            <h3 class="text-2xl font-bold text-cyan-400 mb-4">Galeria Personalizada</h3>
                            <p class="text-slate-300 leading-relaxed">
                                Crie sua garagem virtual e exiba seus carros com fotos profissionais e detalhes técnicos
                                completos.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div
                            class="group bg-gradient-to-br from-slate-800/40 to-slate-700/40 backdrop-blur-lg border border-white/10 rounded-2xl p-8 hover:border-purple-400/50 transition-all duration-300 hover:transform hover:scale-105">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                👥
                            </div>
                            <h3 class="text-2xl font-bold text-purple-400 mb-4">Comunidade Ativa</h3>
                            <p class="text-slate-300 leading-relaxed">
                                Conecte-se com milhares de entusiastas, participe de discussões e descubra eventos
                                próximos.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div
                            class="group bg-gradient-to-br from-slate-800/40 to-slate-700/40 backdrop-blur-lg border border-white/10 rounded-2xl p-8 hover:border-green-400/50 transition-all duration-300 hover:transform hover:scale-105">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                ⚡
                            </div>
                            <h3 class="text-2xl font-bold text-green-400 mb-4">Reviews Detalhados</h3>
                            <p class="text-slate-300 leading-relaxed">
                                Leia e compartilhe avaliações completas de desempenho, design e experiência de condução.
                            </p>
                        </div>

                        <!-- Feature 4 -->
                        <div
                            class="group bg-gradient-to-br from-slate-800/40 to-slate-700/40 backdrop-blur-lg border border-white/10 rounded-2xl p-8 hover:border-yellow-400/50 transition-all duration-300 hover:transform hover:scale-105">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                🏆
                            </div>
                            <h3 class="text-2xl font-bold text-yellow-400 mb-4">Competições</h3>
                            <p class="text-slate-300 leading-relaxed">
                                Participe de competições de fotos, acelere sua reputação e ganhe prêmios exclusivos.
                            </p>
                        </div>

                        <!-- Feature 5 -->
                        <div
                            class="group bg-gradient-to-br from-slate-800/40 to-slate-700/40 backdrop-blur-lg border border-white/10 rounded-2xl p-8 hover:border-red-400/50 transition-all duration-300 hover:transform hover:scale-105">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-red-400 to-rose-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                🔧
                            </div>
                            <h3 class="text-2xl font-bold text-red-400 mb-4">Marketplace</h3>
                            <p class="text-slate-300 leading-relaxed">
                                Compre, venda e troque peças, acessórios e até mesmo veículos completos com segurança.
                            </p>
                        </div>

                        <!-- Feature 6 -->
                        <div
                            class="group bg-gradient-to-br from-slate-800/40 to-slate-700/40 backdrop-blur-lg border border-white/10 rounded-2xl p-8 hover:border-indigo-400/50 transition-all duration-300 hover:transform hover:scale-105">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                🎯
                            </div>
                            <h3 class="text-2xl font-bold text-indigo-400 mb-4">Eventos Exclusivos</h3>
                            <p class="text-slate-300 leading-relaxed">
                                Acesso VIP a eventos automotivos, test drives exclusivos e encontros da comunidade.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-20 bg-gradient-to-r from-slate-900 to-purple-900">
                <div class="max-w-4xl mx-auto px-6 text-center">
                    <h2 class="text-4xl lg:text-5xl font-black mb-6">
                        <span class="bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">
                            Pronto para acelerar?
                        </span>
                    </h2>
                    <p class="text-xl text-slate-300 mb-10 leading-relaxed">
                        Junte-se a mais de 50.000 entusiastas automotivos e comece a compartilhar sua paixão hoje mesmo.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <Link v-if="canRegister" :href="route('register')"
                            class="px-10 py-4 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full text-xl font-bold hover:shadow-2xl hover:shadow-cyan-500/25 transform hover:scale-105 transition-all duration-300">
                        Criar Conta Gratuita
                        </Link>
                        <button
                            class="px-10 py-4 border-2 border-cyan-400 text-cyan-400 rounded-full text-xl font-bold hover:bg-cyan-400 hover:text-slate-900 transition-all duration-300">
                            Ver Demonstração
                        </button>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-slate-900 border-t border-white/10 py-12">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div
                            class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent mb-4">
                            CarConnect
                        </div>
                        <p class="text-slate-400 leading-relaxed">
                            A rede social que conecta apaixonados por carros ao redor do mundo.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-4">Recursos</h3>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Galeria</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Comunidade</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Marketplace</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Eventos</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-4">Suporte</h3>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Central de Ajuda</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Contato</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">FAQ</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Status</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-4">Legal</h3>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Privacidade</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Termos</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition-colors">Cookies</a></li>
                        </ul>
                    </div>
                </div>
                <div class="pt-8 border-t border-white/10 text-center text-slate-400">
                    <p>&copy; 2025 CarConnect. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</template>