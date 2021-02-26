<?xml version="1.0" encoding="UTF-8"?>
<tileset version="1.4" tiledversion="1.4.3" name="basic-tile-terrain" tilewidth="32" tileheight="32" tilecount="4" columns="4">
 <image source="tileSet/door_32x32.png" width="128" height="32"/>
 <terraintypes>
  <terrain name="terrain1" tile="0"/>
  <terrain name="terrain2" tile="1"/>
  <terrain name="terrain3" tile="2"/>
  <terrain name="terrain4" tile="3"/>
 </terraintypes>
 <tile id="0" type="Blah" terrain="0,0,0,0" probability="1.123"/>
 <tile id="1" terrain="1,2,1,2" probability="4"/>
 <tile id="2" type="Test" terrain="1,3,1,3"/>
 <tile id="3" terrain="2,,1,0" probability="0"/>
</tileset>
