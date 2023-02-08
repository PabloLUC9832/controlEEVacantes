        <div class="col-span-6">
            <label for="numMateria-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">NRC</label>
            <select  id="numMateria-dropdown" name="numMateria" class="estiloSelect">
            <option value="{{$vacante->numMateria}}~{{$vacante->nombreMateria}}">{{$vacante->numMateria}}~{{$vacante->nombreMateria}}</option>
                @foreach ($experienciasEducativas as $data)
                    <option value="{{$data->nrc}}~{{$data->nombre}}">
                            {{$data->nrc}}~{{$data->nombre}}
                    </option>
                @endforeach
            </select>
        </div>

