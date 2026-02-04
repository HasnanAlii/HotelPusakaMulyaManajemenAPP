@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 'border border-2 border-slate-400 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'
    ]) }} 
>
