from antares_http import antares

data = {
    'h': 1
}
antares.setAccessKey('d2a4e28b0c316687:41fd4960fcee58c8')
antares.send(data, 'EarthquakeDetector', 'output')
