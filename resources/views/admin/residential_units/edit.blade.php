<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/residential" class="btn btn-primary">Back</a>
    @foreach ($data['r_unit'] as $item)
    <form action="/admin/residential/edit/{{ $item['id'] }}" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Property</label>     
            <select name="property_id">
                @foreach ($data['properties'] as $property)
                    <option value="{{ $property->id }}" {{ $property->id == $item['property_id'] ? "selected" : "" }}>{{ $property->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="">Unit ID</label>     
            <input type="text" name="unit_id" value="{{ $item['unit_id'] }}">
        </div>

        <div>
            <label for="">Building</label>     
            <input type="text" name="building" value="{{ $item['building'] }}">
        </div>

        <div>
            <label for="">Unit Type</label>     
            <select name="type">
                <option value="1 BR" {{ $item['type'] == '1 BR' ? "selected" : "" }}>1 Bedroom</option>
                <option value="2 BR" {{ $item['type'] == '2 BR' ? "selected" : "" }}>2 Bedrooms</option>
                <option value="3 BR" {{ $item['type'] == '3 BR' ? "selected" : "" }}>3 Bedrooms</option>
                <option value="PH" {{ $item['type'] == 'PH' ? "selected" : "" }}>Penthouse</option>
                <option value="Studio" {{ $item['type'] == 'Studio' ? "selected" : "" }}>Studio</option>
            </select>
        </div>

        <div>
            <label for="">Area</label>     
            <input type="text" name="area" value="{{ $item['area'] }}">
        </div>

        <div>
            <label for="">Monthly Rate</label>     
            <input type="text" name="rate" value="{{ $item['rate'] }}">
        </div>

        <div>
            <label for="">Unit Status</label>     
            <select name="status">
                <option value="not-furnished" {{ $item['status'] == 'not-furnished' ? "selected='selected'" : "" }}>Not Furnished</option>
                <option value="semi-furnished" {{ $item['status'] == 'semi-furnished' ? "selected='selected'" : "" }}>Semi-furnished</option>
                <option value="fully-furnished" {{ $item['status'] == 'fully-furnished' ? "selected='selected'" : "" }}>Fully-furnished</option>
            </select>
        </div>

        <div>
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
    @endforeach
</body>
</html>