@extends('layouts.app')

@section('title', $evento->titulo . ' — FalaQ')

@section('content')
<div class="mx-auto grid max-w-6xl grid-cols-1 gap-8 px-4 md:grid-cols-5">
    <section class="md:col-span-2">
        <div class="rounded-xl border border-gray-700 bg-gray-800 p-6 shadow-lg">
            <h2 class="mb-5 text-xl font-bold text-white">Faça sua pergunta</h2>

            <form action="{{ route('eventos.perguntas.store', $evento->id) }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="texto" class="mb-2 block text-sm font-medium text-gray-200">Texto da pergunta</label>
                    <textarea
                        name="texto"
                        id="texto"
                        rows="5"
                        class="block w-full rounded-md border bg-gray-900 px-3 py-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('texto') border-red-500 focus:border-red-500 @else border-gray-600 focus:border-blue-500 @enderror"
                        placeholder="Digite sua dúvida ou comentário para o palestrante..."
                        aria-describedby="texto-error"
                    >{{ old('texto') }}</textarea>
                    @error('texto')
                        <p id="texto-error" class="mt-2 text-sm font-medium text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full rounded-md bg-blue-600 px-4 py-2 font-semibold text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-gray-800">
                    Enviar pergunta
                </button>
            </form>
        </div>
    </section>

    <section class="md:col-span-3" aria-labelledby="perguntas-heading">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-2">
            <h2 id="perguntas-heading" class="text-xl font-bold text-white">Perguntas do evento</h2>
            <span class="text-sm text-gray-400">Total: {{ $perguntas->count() }}</span>
        </div>

        @forelse($perguntas as $pergunta)
            <article class="mb-4 rounded-xl border border-gray-700 bg-gray-800 p-5 shadow-md">
                <p class="mb-3 whitespace-pre-line break-words text-lg text-gray-100">{{ $pergunta->texto }}</p>
                <div class="flex flex-wrap items-center justify-between gap-2 border-t border-gray-700 pt-3 text-sm text-gray-400">
                    <span>Status: <span class="font-medium text-blue-300">{{ $pergunta->status }}</span></span>
                    <time datetime="{{ $pergunta->created_at->toIso8601String() }}">{{ $pergunta->created_at->format('d/m/Y H:i') }}</time>
                </div>
            </article>
        @empty
            <div class="rounded-xl border border-gray-700 bg-gray-800 p-6 text-center text-gray-300">
                Nenhuma pergunta enviada ainda. Seja o primeiro!
            </div>
        @endforelse

        @if(method_exists($perguntas, 'links'))
            <div class="mt-6 flex justify-center">
                {{ $perguntas->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
