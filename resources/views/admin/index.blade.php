 @vite(['resources/css/reset.css'])
 @vite(['resources/css/app.css', 'resources/js/app.js'])

 <x-app-layout>
     <h1>Административная панель</h1>

     <div class="flex flex-col gap-4 items-start p-3 bg-slate-400">

         <table class="table-auto w-full border-collapse border border-gray-300">
             <thead>
                 <tr>
                     <th class="px-4 py-2 bg-gray-200 text-left text-gray-700 uppercase font-semibold border border-gray-300">Фио</th>
                     <th class="px-4 py-2 bg-gray-200 text-left text-gray-700 uppercase font-semibold border border-gray-300">Текст заявления</th>
                     <th class="px-4 py-2 bg-gray-200 text-left text-gray-700 uppercase font-semibold border border-gray-300">Номер автомобиля</th>
                     <th class="px-4 py-2 bg-gray-200 text-left text-gray-700 uppercase font-semibold border border-gray-300">Статус</th>
                 </tr>
             </thead>
             <tbody>

                 @foreach($reports as $report)
                 <tr class="odd:bg-gray-50 hover:bg-gray-100">

                     <td class="px-4 py-2 border border-gray-300">{{$report->user->name}} {{$report->user->middlename}} {{$report->user->lastname}}</td>
                     <td class="px-4 py-2 border border-gray-300">{{$report->description}}</td>
                     <td class="px-4 py-2 border border-gray-300">{{$report->number}}</td>
                     <td class="px-4 py-2 border border-gray-300">
                         <div>
                             <form class="status-form" action="{{route('report.status.update', $report->id)}}" method="POST">
                                 @method('patch')
                                 @csrf
                                 <select name="status_id" id="status_id" data-current-status="{{ $report->status_id }}">
                                     @foreach($statuses as $status)
                                     <option value="{{$status->id}}" {{$status->id === $report->status_id ? 'selected': ''}}>
                                         {{$status->name}}
                                     </option>
                                     @endforeach
                                 </select>
                             </form>
                         </div>

                     </td>
                 </tr>

                 @endforeach


             </tbody>
         </table>

     </div>
 </x-app-layout>