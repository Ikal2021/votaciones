<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Crear nuevo candidato</h2>
        <form action="#">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <div class="flex justify-start">
                        <label for="dni" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DNI</label>
                        <span class="text-slate-400 text-xs mt-1 ml-2 font-light">(Sin guiones)</span>
                    </div>
                    <input type="text" name="dni" id="dni" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="0801000000000" required maxlength="13" minlength="13">
                </div>
                <div class="w-full">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
                    <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="nombres" required="">
                </div>
                <div class="w-full">
                    <label for="apellidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="apellidos" required="">
                </div>
                <div class="w-full">
                    <label for="fechanacimiento_persona" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de nacimiento</label>
                    <input id="fechanacimiento_persona" class="block mt-1 w-full" type="date" name="fechanacimiento_persona" required />
                </div>           
                <div class="w-full">
                    <label for="sexo_persona" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Género</label>  
                    <div class="flex items-center mb-4">
                        <input id="genero" type="radio" name="genero" value="Masculino" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                        <label for="genero" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            Masculino
                        </label>
                    </div>
                
                    <div class="flex items-center mb-4">
                        <input id="country-option-2" type="radio" name="genero" value="Femenino" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="country-option-2" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Femenino
                        </label>
                    </div>
                </div>
  

                
                {{-- <div class="w-full">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                </div> --}}
                {{-- <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Select category</option>
                        <option value="TV">TV/Monitors</option>
                        <option value="PC">PC</option>
                        <option value="GA">Gaming/Console</option>
                        <option value="PH">Phones</option>
                    </select>
                </div> --}}

                <div class="w-full">
                    <label for="lugar_nacimiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lugar de Nacimiento</label>
                    <input type="text" name="lugar_nacimiento" id="lugar_nacimiento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="lugar de nacimiento" required="">
                </div>

                <div class="w-full">
                    <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Partido político</label>
                    <select id="id" wire:model="id" required  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled selected>Seleccione un partido</option>
                        @foreach($partidos as $partido)
                            <option value="{{$partido->id}}">{{$partido->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full">
                    <label for="formula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fórmula?</label>
                    <select id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">  
                        <option value="" disabled selected>Seleccione una fórmula</option>
                        @foreach($tipo_candidatos as $formula)
                            <option value="{{$formula->id}}">{{$formula->tipo}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full">
                    <label for="movimiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movimiento</label>
                    <select id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">  
                        <option value="" disabled selected>Seleccione un movimiento</option>
                        @foreach ($movimientos as $movimiento)
                            <option value="{{$movimiento->id}}">{{$movimiento->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full">
                    <label for="candidato" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Candidato</label>
                    <input type="text" name="tipo_candidato" id="tipo_candidato" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="ingrese su tipo">
                </div>
                
            
                {{-- <div>
                    <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Weight (kg)</label>
                    <input type="number" name="item-weight" id="item-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
                </div>  --}}
                {{-- <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                </div> --}}
            </div>
            <button type="submit" class="bg-violet-700 text-white px-2 py-2 rounded-md hover:bg-purple-500 my-6">
                Crear Candidato
            </button>
        </form>
    </div>
  </section>