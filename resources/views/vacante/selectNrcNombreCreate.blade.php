<div class="col-span-6">
            <label for="numMateria-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Experiencia Educativa</label>
            <select  id="numMateria-dropdown" name="numMateria" class="estiloSelect" required>
            <option value="">Selecciona la experiencia educativa</option>
                @foreach ($experienciasEducativas as $data)
                    <option value="{{$data->nrc}}~{{$data->nombre}}">
                            {{$data->nrc}}~{{$data->nombre}}
                    </option>
                @endforeach
            </select>
        </div>


