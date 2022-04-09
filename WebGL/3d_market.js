//import * as THREE from 'three.js-master/build/three.module.js';
import * as THREE from 'three';
//import { Capsule } from 'three.js-master/examples/jsm/math/Capsule.js';

let camera, scene, renderer;
let wall;


//Déclaration des paramètres de l'utilisateur
/*
const playerCollider = new Capsule( new THREE.Vector3( 0, 100, 0 ), new THREE.Vector3( 0, 100, 0 ), 100 );
const playerVelocity = new THREE.Vector3();
const playerDirection = new THREE.Vector3();*/


init();
animate();

function init(){
  let wall;

  camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 1000 );
  camera.position.set( 2, 3, - 6 );
  camera.lookAt( 0, 1, 0 );

  scene = new THREE.Scene();

  scene.background = new THREE.Color( 0xa0a0a0 );

  /*
  const texture = new THREE.TextureLoader().load( 'textures/grass.png' );

  const geometry = new THREE.BoxGeometry( 200, 200, 200 );
  const material = new THREE.MeshBasicMaterial( { map: texture } );
  */

  setupLights();

  setupMap();




  renderer = new THREE.WebGLRenderer( { antialias: true } );
  renderer.setPixelRatio( window.devicePixelRatio );
  renderer.setSize( window.innerWidth, window.innerHeight );
  document.body.appendChild( renderer.domElement );

  //

  window.addEventListener( 'resize', onWindowResize );

  }

function setupLights(){

  const hemiLight = new THREE.HemisphereLight( 0xffffff, 0x444444 );
	hemiLight.position.set( 0, 20, 0 );
  scene.add( hemiLight );

  const dirLight = new THREE.DirectionalLight( 0xffffff );
	dirLight.position.set( - 3, 10, - 10 );
	dirLight.castShadow = true;
	dirLight.shadow.camera.top = 4;
	dirLight.shadow.camera.bottom = - 4;
	dirLight.shadow.camera.left = - 4;
	dirLight.shadow.camera.right = 4;
	dirLight.shadow.camera.near = 0.1;
	dirLight.shadow.camera.far = 40;
	scene.add( dirLight );

}

function setupMap(){
  const ground = new THREE.Mesh( new THREE.PlaneGeometry( 200, 200 ), new THREE.MeshPhongMaterial( { color: 0x999999, depthWrite: false } ) );
  ground.rotation.x = - Math.PI / 2;
  ground.receiveShadow = true;
  scene.add( ground );

  wall = new THREE.Mesh( new THREE.PlaneGeometry( 5, 2 ), new THREE.MeshPhongMaterial( { color: 0x049ef4, depthWrite: false } ) );
  //wall.rotation.x =  3;
  wall.rotation.x = - Math.PI;
  //wall.position.x = ground.position.x -20;
  wall.receiveShadow = true;
  scene.add( wall );


}


function onWindowResize() {

  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();

  renderer.setSize( window.innerWidth, window.innerHeight );

}

function animate() {

  requestAnimationFrame( animate );
  //wall.rotation.x +=  0.01;
  //console.log(wall.rotation.x);

  renderer.render( scene, camera );


}
