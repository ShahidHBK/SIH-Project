import folium
import pandas as pd
import os

states = os.path.join('DataSets', 'BMC_wards.json')
Crime_data = os.path.join('DataSets', 'Mumbai_Ward.csv')
state_data = pd.read_csv(Crime_data)

m = folium.Map(location=[19.0760, 72.8777], zoom_start=10)

m.choropleth(
    geo_data=states,
    name='choropleth',
    data=state_data,
    columns=['wards', 'crime_rate'],
    key_on='feature.gid',
    fill_color='YlGn',
    fill_opacity=0.7,
    line_opacity=0.2,
    legend_name='Crime Rate'
)

folium.LayerControl().add_to(m)

m.save('map1.html')
