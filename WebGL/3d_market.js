//import * as THREE from 'three.js-master/build/three.module.js';
import * as THREE from 'three';
import { Capsule } from './three.js-master/examples/jsm/math/Capsule.js';
//import { Capsule } from 'three.js-master/examples/jsm/math/Capsule.js';
import { FontLoader } from './three.js-master/examples//jsm/loaders/FontLoader.js';

let camera, scene, renderer;
let productImg;
let mouseTime = 0;

let button;

const raycaster = new THREE.Raycaster();
const pointer = new THREE.Vector2();

const objects = [];


//Déclaration des paramètres de l'utilisateur

const playerCollider = new Capsule( new THREE.Vector3( 0, 1, 0 ), new THREE.Vector3( 0, 10, 0 ), 1 );
const playerVelocity = new THREE.Vector3();
const playerDirection = new THREE.Vector3();

const keyStates = {};

const STEPS_PER_FRAME = 5;
let floorSpeed = 100;

const clock = new THREE.Clock();

let video;
const container = document.getElementById('container');
const coinSound = new Audio('video/coin_sound.mp3');

document.addEventListener( 'mouseup', onPointerMove );



init();
animate();

function init(){
  let wall;

  //Video setup
  video = document.getElementById( 'video' );


  camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 1000 );
  camera.position.set( 0, 3, - 6 );
  camera.rotation.order = 'YXZ';
  camera.lookAt( 0, 1, 0 );
  //console.log(camera.position.y);


  scene = new THREE.Scene();

  scene.background = new THREE.Color( 0x057dc2 );

  /*
  const texture = new THREE.TextureLoader().load( 'textures/grass.png' );

  const geometry = new THREE.BoxGeometry( 200, 200, 200 );
  const material = new THREE.MeshBasicMaterial( { map: texture } );
  */
  setupLights();

  setupMap();

  setupKeys();




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
  let material = setMaterial(20, 40, 'wood.jpg');
  let geometry = new THREE.PlaneGeometry( 80, 80 );
  const ground = new THREE.Mesh( geometry, material );
  ground.rotation.x = - Math.PI / 2;
  ground.receiveShadow = true;
  scene.add( ground );

  //console.log("oui");
  spawnProduct();
  spawnWalls();
  spawnButton();


}

function spawnButton(){
  let material = new THREE.MeshPhongMaterial( { color: 0xa50909, depthWrite: false } )
  let geometry = new THREE.BoxGeometry( 2, 1, 1 );
  button = new THREE.Mesh( geometry, material );
  button.position.y = 7;
  button.position.z = 9;
  //ground.receiveShadow = true;
  objects.push(button);
  scene.add(button);
  //console.log("bouton");
}

function onPointerMove( event ) {

  pointer.set( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1 );

  raycaster.setFromCamera( pointer, camera );

  const intersects = raycaster.intersectObjects( objects, false );

  if (intersects.length > 0){
      //console.log("YEEEEEEEEEEEEEES");
      playVideo();
  }

}

function playVideo(){
  container.style.display = 'none';
  video.style.display = 'block';
  video.play();
  coinSound.play();
  coinSound.volume = .2;
  setTimeout( stopVideo, 10000 );
}

function stopVideo(){
  video.style.display = 'none';
  container.style.display = 'block';
}


function spawntext(){
  const loader = new FontLoader();
	loader.load( 'three.js-master/examples/fonts/helvetiker_regular.typeface.json', function ( font ) {
	   const color = 0xc5d11a;
     const matDark = new THREE.LineBasicMaterial( {
		     color: color,
	        side: THREE.DoubleSide
					} );

          const matLite = new THREE.MeshBasicMaterial( {
            color: color,
            transparent: true,
            opacity: 0.6,
            side: THREE.DoubleSide
          } );


					const message = '300€';
					const shapes = font.generateShapes( message, 100 );
					const geometry = new THREE.ShapeGeometry( shapes );
					geometry.computeBoundingBox();
					const xMid = - 0.5 * ( geometry.boundingBox.max.x - geometry.boundingBox.min.x );
					geometry.translate( xMid, 0, 0 );


					const text = new THREE.Mesh( geometry, matLite );
					text.position.z = 10;
          text.position.y = 8;
					scene.add( text );

				} );
}

function spawnWalls(){
  let loyaltyGroup = new THREE.Group();
  let hwdGroup = new THREE.Group();
  let hwdGroup2 = new THREE.Group();
  let wallPosY = 12.5;

  //LW1
  let material = setMaterial(10, 20, 'logo_loyaltycard.png');
  let geometry = new THREE.BoxGeometry( 80, 25, 0.01 );
  let loyaltyWall = new THREE.Mesh( geometry, material );
  loyaltyWall.position.y = wallPosY;
  loyaltyWall.position.z = 40;

  scene.add( loyaltyWall );


  //LW2
  material = setMaterial(10, 20, 'logo_loyaltycard.png');
  geometry = new THREE.BoxGeometry( 80, 25, 0.01 );
  let loyaltyWall2 = new THREE.Mesh( geometry, material );
  loyaltyWall2.position.y = wallPosY;
  loyaltyWall2.position.z = 40;
  loyaltyGroup.add(loyaltyWall2);
  loyaltyGroup.rotation.y = - Math.PI;

  scene.add( loyaltyGroup );



  //HWD1
  material = setMaterial(10, 5, 'here_we_dev_logo.jpg');
  geometry = new THREE.BoxGeometry( 80, 25, 0.01 );
  let hwdWall = new THREE.Mesh( geometry, material );
  hwdWall.position.y = wallPosY;
  hwdWall.position.z = 40;
  hwdGroup.add(hwdWall);
  hwdGroup.rotation.y = - Math.PI/2;

  scene.add( hwdGroup );



  //HWD2
  material = setMaterial(10, 5, 'here_we_dev_logo.jpg');
  geometry = new THREE.BoxGeometry( 80, 25, 0.01 );
  let hwdWall2 = new THREE.Mesh( geometry, material );
  hwdWall2.position.y = wallPosY;
  hwdWall2.position.z = 40;
  hwdGroup2.add(hwdWall2);
  hwdGroup2.rotation.y = Math.PI/2;

  scene.add( hwdGroup2 );


}


//

function spawnProduct(){
  let texture = new THREE.TextureLoader().load( 'textures/carte_graphique.jpg' );

	let geometry = new THREE.BoxGeometry( 5, 5, 0.01 );
	let material = new THREE.MeshBasicMaterial( { map: texture } );

	productImg = new THREE.Mesh( geometry, material );

  productImg.position.y = 9.5;
  productImg.position.z = 10;
  //console.log(product.position.x);

  scene.add( productImg );


  material = setMaterial(2, 4, 'Carbon.png');
  geometry = new THREE.BoxGeometry( 5, 12, 2 );

  let productCore = new THREE.Mesh( geometry, material );
  productCore.position.y = 6;
  productCore.position.z = 11;
  scene.add( productCore );


  geometry = new THREE.BoxGeometry( 5, 8, 2 );
  let buttonSupport = new THREE.Mesh( geometry, material );
  buttonSupport.position.y = 3;
  buttonSupport.position.z = 9;
  scene.add( buttonSupport );


}

function setMaterial(UV_x, UV_y, textureName){
  //Texture
  const objectTexture = new THREE.TextureLoader().load('textures/' + textureName);

  //Texture scale
  objectTexture.wrapS = THREE.RepeatWrapping; // Texture is wrapped horizontally
  objectTexture.wrapT = THREE.RepeatWrapping; // Texture is wrapped vertically
  objectTexture.repeat.set( UV_x, UV_y ); // Number of times the texture is repeated

  //Material
  const material = new THREE.MeshPhongMaterial( { map: objectTexture } );
  return material;
}

function teleportPlayerIfOob(){
  if(camera.position.x > 38 || camera.position.x < -38 || camera.position.z > 38 || camera.position.z < -38){
    playerCollider.start.set( 0, 1, 0 );
    playerCollider.end.set( 0, 10, 0 );
    camera.position.copy( playerCollider.end );
    camera.rotation.set( 0, 0, 0 );
  }
}

function updatePlayer( deltaTime ) {

	let damping = Math.exp( - 4 * deltaTime ) - 1;

	playerVelocity.addScaledVector( playerVelocity, damping );

	const deltaPosition = playerVelocity.clone().multiplyScalar( deltaTime );
	playerCollider.translate( deltaPosition );

	camera.position.copy( playerCollider.end );

}


function setupKeys(){
  document.addEventListener( 'keydown', ( event ) => {

    keyStates[ event.code ] = true;

  } );

  document.addEventListener( 'keyup', ( event ) => {

    keyStates[ event.code ] = false;

  } );

  document.addEventListener( 'mousedown', () => {

    document.body.requestPointerLock();

    mouseTime = performance.now();

  } );

  document.body.addEventListener( 'mousemove', ( event ) => {

    if ( document.pointerLockElement === document.body ) {

      camera.rotation.y -= event.movementX / 500;
      camera.rotation.x -= event.movementY / 500;

    }

  } );

}

function getForwardVector() {

  camera.getWorldDirection( playerDirection );
  playerDirection.y = 0;
  playerDirection.normalize();

  return playerDirection;

}

function getSideVector() {

  camera.getWorldDirection( playerDirection );
  playerDirection.y = 0;
  playerDirection.normalize();
  playerDirection.cross( camera.up );

  return playerDirection;

}

function controls( deltaTime ) {

  const speedDelta = deltaTime * floorSpeed;

  if ( keyStates[ 'KeyW' ] ) {
    playerVelocity.add( getForwardVector().multiplyScalar( speedDelta ) );

  }

  if ( keyStates[ 'KeyS' ] ) {
    playerVelocity.add( getForwardVector().multiplyScalar( - speedDelta ) );

  }

  if ( keyStates[ 'KeyA' ] ) {
    playerVelocity.add( getSideVector().multiplyScalar( - speedDelta ) );

  }

  if ( keyStates[ 'KeyD' ] ) {
    playerVelocity.add( getSideVector().multiplyScalar( speedDelta ) );

  }


}

function onWindowResize() {

  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();

  renderer.setSize( window.innerWidth, window.innerHeight );

}

//

function animate() {

  requestAnimationFrame( animate );
  //wall.rotation.x +=  0.01;
  //console.log(wall.rotation.x);

  const delta = clock.getDelta();
  const deltaTime = Math.min( 0.05, delta ) / STEPS_PER_FRAME;

  for ( let i = 0; i < STEPS_PER_FRAME; i ++ ) {

    controls( deltaTime );

    updatePlayer( deltaTime );

  }

  teleportPlayerIfOob();

  renderer.render( scene, camera );

  //console.log(camera.position.x);

}
